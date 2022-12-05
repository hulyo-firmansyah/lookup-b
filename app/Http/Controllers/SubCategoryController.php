<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Http\Requests\Data\SubCategory\StoreSubCategoryRequest;
use App\Http\Requests\Data\SubCategory\UpdateSubCategoryRequest;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_categories = SubCategory::all();

        return response(['status' => 'OK', 'data' => [
            'sub_categories' => $sub_categories
        ]]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubCategoryRequest $request)
    {
        $sub_category = SubCategory::create($request->all());

        return response(['status' => 'OK', 'message' => 'Create sub category success', 'data' => [
            'sub_category' => $sub_category
        ]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = intval($request->sub_category);
        $subCategory = SubCategory::find($id);
        if (!$subCategory) {
            return response([
                'status' => false,
                'message' => 'Sub category not found',
                'data' => null
            ], 404);
        }

        return response([
            'status' => 'OK',
            'data' => [
                'sub_category' => $subCategory
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubCategoryRequest  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubCategoryRequest $request)
    {
        $id = intval($request->sub_category);
        $sub_category = SubCategory::find($id);
        $sub_category->update($request->all());

        return response(['status' => 'OK', 'message' => 'Update sub category success', 'data' => [
            'sub_category' => $sub_category
        ]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = intval($request->sub_category);
        $sub_category = SubCategory::find($id);
        if (!$sub_category) {
            return response(['status' => false, 'message' => 'Sub category not found'], 404);
        }
        $sub_category->delete();

        return response(['status' => 'OK', 'message' => 'Delete sub category success', 'data' => $sub_category], 200);
    }
}
