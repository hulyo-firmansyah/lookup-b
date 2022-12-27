<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\Data\Product\StoreProductRequest;
use App\Http\Requests\Data\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\ProductImage;
use App\Models\ProductSpec;
use App\Models\Spec;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ProductResource::collection(Product::all()->load(['sub_category', 'sub_category.category']));

        return response()->json(['status' => 'OK', 'data' => compact('products')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());
        if (!$product) {
            return response(['status' => false, 'message' => 'Create product failed'], 500);
        }

        // Insert and link images
        $images = $request->get('images');
        if ($images) {
            foreach ($images as $img) {
                $this->storeImage($product->id, $img);
            }
        }
        // Insert specs
        if ($request->specs) {
            $specs = $request->specs;
            foreach ($specs as $spec) {
                if (is_int($spec->spec)) {
                    ProductSpec::create([
                        "spec_id" => $spec->spec,
                        "product_id" => $product->id,
                        "value" => $spec->value
                    ]);
                } else {
                    $newSpec = Spec::create([
                        'spec' => $spec->spec,
                        'details' => $spec->desc
                    ]);

                    ProductSpec::create([
                        "spec_id" => $newSpec->id,
                        "product_id" => $product->id,
                        "value" => $spec->value
                    ]);
                }
            }
        }

        $newProduct = new ProductResource(Product::find($product->id));

        return response(['status' => 'OK', 'message' => 'Create product success', 'data' => [
            'product' => $newProduct
        ]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = intval($request->product);
        $productModel = Product::find($id);
        if (!$productModel) {
            return response([
                'status' => false,
                'message' => 'Product not found',
                'data' => [
                    'product' => null
                ]
            ], 404);
        }

        $product = new ProductResource($productModel->load(['sub_category', 'sub_category.category']));

        return response([
            'status' => 'OK',
            'data' => compact('product')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request)
    {
        $id = intval($request->product);
        $product = Product::find($id);
        $data = $request->all();
        // unset serial_number key from $request if exist
        // because this can make serial numeber editable
        unset($data['serial_number']);
        $product->update($data);

        //Unlink old image
        if ($request->has('del_img_id')) {
            $deletedImages = $request->get('del_img_id');
            foreach ($deletedImages as $idToDelete) {
                //Find related images
                $productImg = ProductImage::find($idToDelete);
                if ($productImg) {
                    //delete file
                    Storage::delete('upload/images/product/' . $productImg->filename . '.' . $productImg->ext);
                    //delete image record
                    $productImg->delete();
                }
            }
        }
        //Put new image
        if ($request->has('images')) {
            $images = $request->get('images');
            if ($images) {
                foreach ($images as $img) {
                    $this->storeImage($id, $img);
                }
            }
        }

        $specs = $request->specs;
        if ($specs) {
            //delete old specs
            $oldSpecs = $product->pivotSpec();
            $oldSpecs->delete();

            //assign new specs
            foreach ($specs as $spec) {
                if (is_int($spec->spec)) {
                    ProductSpec::create([
                        "spec_id" => $spec->spec,
                        "product_id" => $product->id,
                        "value" => $spec->value
                    ]);
                } else {
                    $newSpec = Spec::create([
                        'spec' => $spec->spec,
                        'details' => $spec->desc
                    ]);

                    ProductSpec::create([
                        "spec_id" => $newSpec->id,
                        "product_id" => $product->id,
                        "value" => $spec->value
                    ]);
                }
            }
        }

        $newProduct = new ProductResource(Product::find($id));

        return response(['status' => 'OK', 'message' => 'Update product success', 'data' => [
            'product' => $newProduct
        ]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $id = intval($request->product);
            $product = Product::find($id);
            if (!$product) {
                return response(['status' => false, 'message' => 'Product not found', 'data' => [
                    'product' => null
                ]], 404);
            }

            $product->pivotSpec()->delete();
            $productRes = new ProductResource($product->load('pivotSpec'));

            $oldImages = $productRes->images;
            foreach ($oldImages as $image) {
                //Unlink related images
                Storage::delete('upload/images/product/' . $image->filename . '.' . $image->ext);
            }
            $product->images()->delete();
            $product->delete();

            return response(['status' => 'OK', 'message' => 'Delete product success', 'data' => [
                'product' => $productRes
            ]], 200);
        } catch (QueryException $e) {
            return response(['status' => false, 'message' => 'Delete product failed.'], 500);
        }
    }

    /**
     * Store single image file to disk and to record
     * @param $id Product id
     * @param $image Image file
     */
    private function storeImage(Int $id, String $image)
    {
        $image = base64_decode($image);
        $imageName = uniqid() . md5(time());

        $f = finfo_open();
        $mime = finfo_buffer($f, $image, FILEINFO_MIME_TYPE);
        $ext = explode("/", $mime)[1];

        $fullPath = 'upload/images/product/' . $imageName . "." . $ext;
        Storage::put($fullPath, $image);

        ProductImage::create([
            'path' => $fullPath,
            'filename' => $imageName,
            'ext' => $ext,
            'product_id' => $id
        ]);
    }
}
