<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\Data\Product\StoreProductRequest;
use App\Http\Requests\Data\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

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

        return response()->json(['status' => 'OK', 'data' => [
            'products' => $products
        ]]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        //
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
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
