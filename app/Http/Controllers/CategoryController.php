<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        if ($categories) {
            return CategoryResource::collection($categories);
        } else {
            return response()->json(['message' => 'No categories found'], 200);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'nullable',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors('Name Field is Mendatory'), 400);
        }
        $category = category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return response()->json([
            'message' => 'Category created successfully',
            'data' => new CategoryResource($category)
        ]);
    }
    public function show(category $category)
    {
        return new CategoryResource($category);
    }
    public function update(Request $request, category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'nullable',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors('Name Field is Mendatory'), 400);
        }
        $category -> update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return response()->json([
            'message' => 'Category updated successfully',
            'data' => new CategoryResource($category)
        ]);
    }
    public function destroy(category $category) {
        $category->delete();
        return response()->json([
           'message' => 'Category deleted successfully'
        ]);
    }
}
