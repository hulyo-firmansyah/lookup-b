<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\Data\Supplier\StoreSupplierRequest;
use App\Http\Requests\Data\Supplier\UpdateSupplierRequest;
use App\Http\Resources\SupplierResource;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();

        return response(['status' => 'OK', 'data' => [
            'suppliers' => $suppliers
        ]]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Data\Supplier\StoreSupplierRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplierRequest $request)
    {
        $supplier = Supplier::create($request->all());

        return response([
            'status' => 'OK',
            'message' => 'Input supplier data success',
            'data' => [
                'supplier' => $supplier
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = intval($request->supplier);
        $supplier = new SupplierResource(Supplier::find($id));
        if (!$supplier->resource) {
            return response(['status' => false, 'message' => 'Supplier not found', 'data' => [
                'supplier' => null
            ]], 404);
        }

        return response(['status' => 'OK', 'data' => [
            'supplier' => $supplier
        ]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Data\Supplier\UpdateSupplierRequest  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierRequest $request)
    {
        $id = intval($request->supplier);
        $supplier = Supplier::find($id)->update($request->all());

        return response(['status' => 'OK', 'message' => 'Update supplier success', 'data' => [
            'supplier' => $supplier
        ]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = intval($request->supplier);
        $supplier = Supplier::find($id);
        if (!$supplier) {
            return response(['status' => false, 'message' => 'Supplier not found', 'data' => [
                'supplier' => null
            ]], 404);
        }
        $supplier->delete();

        return response(['status' => 'OK', 'message' => 'Delete supplier success', 'data' => [
            'supplier' => $supplier
        ]], 200);
    }
}
