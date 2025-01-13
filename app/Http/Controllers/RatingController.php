<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request, $quizId)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'review' => 'nullable|string|max:500',
        ]);

        $existingRating = Rating::where('user_id', Auth::id())
            ->where('quiz_id', $quizId)
            ->first();

        if ($existingRating) {
            return back()->with('error', 'You have already rated this quiz.');
        }

        Rating::create([
            'user_id' => Auth::id(),
            'quiz_id' => $quizId,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return back()->with('success', 'Thank you for your rating!');
    }
}
