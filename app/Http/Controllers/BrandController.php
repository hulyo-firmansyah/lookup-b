<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\Data\Brand\StoreBrandRequest;
use App\Http\Requests\Data\Brand\UpdateBrandRequest;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();

        return response(['status' => 'OK', 'data' => [
            'brands' => $brands
        ]], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = intval($request->brand);
        $brand = Brand::find($id);
        if (!$brand) {
            return response(['status' => 'OK', 'data' => [
                'brand' => null
            ]], 404);
        }

        return response(['status' => 'OK', 'data' => [
            'brand' => $brand
        ]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandRequest  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
