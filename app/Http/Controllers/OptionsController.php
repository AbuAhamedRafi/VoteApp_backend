<?php

namespace App\Http\Controllers;

use App\Models\Options;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\OptionsResource;
use Illuminate\Support\Facades\Validator;

class OptionsController extends Controller
{
    public function index(Category $category)
    {
        return OptionsResource::collection($category->options);
    }

    public function store(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Name field is mandatory'], 400);
        }

        // Create the option directly in the specified category
        $option = $category->options()->create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Option created successfully',
            'data' => new OptionsResource($option),
        ], 201);
    }

    public function show(Category $category, Options $option)
    {
        // Ensure the option belongs to the specified category
        if ($option->category_id !== $category->id) {
            return response()->json(['error' => 'Option not found in this category'], 404);
        }

        return new OptionsResource($option);
    }

    public function update(Request $request, Category $category, Options $option)
    {
        if ($option->category_id !== $category->id) {
            return response()->json(['error' => 'Option not found in this category'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Name field is mandatory'], 400);
        }

        // Update the option
        $option->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Option updated successfully',
            'data' => new OptionsResource($option),
        ]);
    }

    public function destroy(Category $category, Options $option)
    {
        if ($option->category_id !== $category->id) {
            return response()->json(['error' => 'Option not found in this category'], 404);
        }

        // Delete the option
        $option->delete();

        return response()->json([
            'message' => 'Option deleted successfully',
        ]);
    }
}
