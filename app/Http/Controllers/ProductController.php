<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\Data\Product\StoreProductRequest;
use App\Http\Requests\Data\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\ProductImage;
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
        $products = ProductResource::collection(Product::all());

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

        $images = $request->file('images');
        if ($images) {
            foreach ($images as $img) {
                $this->storeImage($product->id, $img);
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

        $product = new ProductResource($productModel);

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
        //unset serial_number key from $request if exist
        //because this can make serial numeber editable
        unset($data['serial_number']);
        $product->update($data);

        //Unlink old image
        foreach ($product->images as $image) {
            //delete file
            Storage::delete('upload/images/product/' . $image->filename . '.' . $image->ext);
        }
        //delete all image record
        $product->images()->delete();
        //Put new image
        $images = $request->file('images');
        if ($images) {
            foreach ($images as $img) {
                $this->storeImage($id, $img);
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
        $id = intval($request->product);
        $product = Product::find($id);
        if (!$product) {
            return response(['status' => false, 'message' => 'Product not found', 'data' => [
                'product' => null
            ]], 404);
        }
        $productRes = new ProductResource($product);

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
    }

    /**
     * Store single image file to disk and to record
     * @param $id Product id
     * @param $image Image file
     */
    private function storeImage(Int $id, UploadedFile $image)
    {
        $path = Storage::putFile('upload/images/product', $image);
        $base = explode('.', basename($path));
        $filename = $base[0];
        $ext = $base[1];

        ProductImage::create([
            'path' => $path,
            'filename' => $filename,
            'ext' => $ext,
            'product_id' => $id
        ]);
    }
}
