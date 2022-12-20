<?php

namespace App\Http\Controllers;

use App\Models\Spec;
use App\Http\Requests\StoreSpecRequest;
use App\Http\Requests\UpdateSpecRequest;
use App\Http\Resources\SpecResource;
use Illuminate\Http\Request;

class SpecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specs = SpecResource::collection(Spec::all());

        return response(['status' => 'OK', 'data' => [
            'specs' => $specs
        ]]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSpecRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpecRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spec  $spec
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = intval($request->spec);
        $specModel = Spec::find($id);
        if (!$specModel) {
            return response([
                'status' => false,
                'message' => 'Spec not found',
                'data' => [
                    'spec' => null
                ]
            ], 404);
        }

        $spec = new SpecResource($specModel);

        return response([
            'status' => 'OK',
            'data' => [
                'spec' => $spec
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSpecRequest  $request
     * @param  \App\Models\Spec  $spec
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpecRequest $request, Spec $spec)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spec  $spec
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spec $spec)
    {
        //
    }
}
