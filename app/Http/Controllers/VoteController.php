<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;

class VoteController extends Controller
{
    public function index()
    {
        $votes = Vote::with(['category', 'option'])->get();
        return response()->json(['votes' => $votes]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'option_id' => 'required|exists:options,id',
        ]);

        // Check if a vote from this user already exists for the given category
        $vote = Vote::where('user_id', $validated['user_id'])
            ->where('category_id', $validated['category_id'])
            ->first();

        if ($vote) {
            return response()->json(['message' => 'Vote already exists. Use the update to modify it.'], 409);
        } else {
            // Create a new vote
            $vote = Vote::create($validated);
            return response()->json(['message' => 'Vote submitted successfully', 'vote' => $vote]);
        }
    }
    public function update(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'option_id' => 'required|exists:options,id',
        ]);

        // Find the existing vote
        $vote = Vote::where('user_id', $validated['user_id'])
            ->where('category_id', $validated['category_id'])
            ->first();

        if ($vote) {
            // Update existing vote
            $vote->update(['option_id' => $validated['option_id']]);
            return response()->json(['message' => 'Vote updated successfully', 'vote' => $vote]);
        } else {
            return response()->json(['message' => 'Vote not found.'], 404);
        }
    }
}
