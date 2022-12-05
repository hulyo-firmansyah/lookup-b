<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Http\Requests\Data\Unit\StoreUnitRequest;
use App\Http\Requests\Data\Unit\UpdateUnitRequest;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::all();

        return response(['status' => 'OK', 'data' => [
            'units' => $units
        ]]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUnitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUnitRequest $request)
    {
        $unit = Unit::create($request->all());

        return response([
            'status' => 'OK',
            'message' => 'Input unit data success',
            'data' => [
                'unit' => $unit
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = intval($request->unit);
        $unit = Unit::find($id);
        if (!$unit) {
            return response(['status' => false, 'message' => 'Unit not found', 'data' => null], 404);
        }

        return response(['status' => 'OK', 'data' => [
            'unit' => $unit
        ]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUnitRequest  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUnitRequest $request)
    {
        $id = intval($request->unit);
        $unit = Unit::find($id);
        $unit->update($request->all());

        return response([
            'status' => 'OK', 'message' => 'Update unit success', 'data' =>
            [
                'unit' => $unit
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = intval($request->unit);
        $unit = Unit::find($id);
        if (!$unit) {
            return response(['status' => false, 'message' => 'Unit not found'], 404);
        }
        $unit->delete();

        return response(['status' => 'OK', 'message' => 'Delete unit success', 'data' => [
            'unit' => $unit
        ]], 200);
    }
}
