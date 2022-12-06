<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\Data\Product\StoreProductRequest;
use App\Http\Requests\Data\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\ProductImage;
use Illuminate\Http\Request;
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

        if ($request->file('image')) {
            $path = Storage::putFile('upload/images/product', $request->file('image'));
            $base = explode('.', basename($path));
            $filename = $base[0];
            $ext = $base[1];

            ProductImage::create([
                'path' => $path,
                'filename' => $filename,
                'ext' => $ext,
                'product_id' => $product->id
            ]);
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
        unset($data['serial_number']);
        $product->update($data);

        $newProduct = new ProductResource($product);

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
        $product->delete();

        return response(['status' => 'OK', 'message' => 'Delete product success', 'data' => [
            'product' => $productRes
        ]], 200);
    }
}
