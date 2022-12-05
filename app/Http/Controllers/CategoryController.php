<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\Data\Category\StoreCategoryRequest;
use App\Http\Requests\Data\Category\UpdateCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return response(['status' => 'OK', 'data' => [
            'categories' => $categories
        ]]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->all());

        return response(['status' => 'OK', 'message' => 'Create category success', 'data' => [
            'category' => $category
        ]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = intval($request->category);
        $category = Category::find($id);
        if (!$category) {
            return response([
                'status' => false,
                'message' => 'Category not found',
                'data' => null
            ], 404);
        }

        return response([
            'status' => 'OK',
            'data' => [
                'category' => $category
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request)
    {
        $id = intval($request->category);
        $category = Category::find($id);
        $category->update($request->all());

        return response(['status' => 'OK', 'message' => 'Update category success', 'data' => [
            'category' => $category
        ]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = intval($request->category);
        $category = Category::find($id);
        if (!$category) {
            return response(['status' => false, 'message' => 'Category not found'], 404);
        }
        $category->delete();

        return response(['status' => 'OK', 'message' => 'Delete category success', 'data' => $category], 200);
    }
}