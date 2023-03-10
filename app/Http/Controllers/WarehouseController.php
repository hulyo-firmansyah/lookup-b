<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Http\Requests\Data\Warehouse\StoreWarehouseRequest;
use App\Http\Requests\Data\Warehouse\UpdateWarehouseRequest;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses = Warehouse::all();

        return response(['status' => 'OK', 'data' => [
            'warehouses' => $warehouses
        ]], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWarehouseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWarehouseRequest $request)
    {
        $warehouse = Warehouse::create($request->all());

        return response(['status' => 'OK', 'message' => 'Success', 'data' => [
            'warehouse' => $warehouse
        ]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = intval($request->warehouse);
        $warehouse = Warehouse::find($id);
        if (!$warehouse) {
            return response(['status' => false, 'message' => 'Warehouse not found', 'data' => [
                'warehouse' => null
            ]]);
        }

        return response(['status' => 'OK', 'data' => [
            'warehouse' => $warehouse
        ]], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWarehouseRequest  $request
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWarehouseRequest $request)
    {
        $id = intval($request->warehouse);
        $warehouse = Warehouse::find($id);
        $warehouse->update($request->all());

        return response(['status' => 'OK', 'message' => 'Update warehouse success', 'data' => [
            'warehouse' => $warehouse
        ]], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = intval($request->warehouse);
        $warehouse = Warehouse::find($id);
        if (!$warehouse) {
            return response(['status' => false, 'message' => 'Warehouse not found', 'data' => [
                'warehouse' => null
            ]], 404);
        }
        $warehouse->delete();

        return response(['status' => 'OK', 'message' => 'Delete warehouse success', 'data' => [
            'warehouse' => $warehouse
        ]], 200);
    }
}
