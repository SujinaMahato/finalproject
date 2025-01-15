<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Create;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\user;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $questions = Create::when($search, function ($query, $search) {
            return $query->where('question_text', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('teacher.list.create-list', compact('questions'));
    }

    /**
     * Show the form for creating a new question.
     */
    public function create()
    {
        return view('teacher.create.create');
    }

    /**
     * Store a newly created question in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'question_text' => 'required|string',
            'difficulty' => 'required|in:easy,medium,hard,mix',
            'subject' => 'required|string',
            'question_image' => 'nullable|image',
            'question_sound' => 'nullable|mimes:mp3,wav',
            'input_type' => 'required|in:text,image,audio',
            'option1' => 'nullable|string',
            'option2' => 'nullable|string',
            'option3' => 'nullable|string',
            'option4' => 'nullable|string',
            'correct_option' => 'required|in:option1,option2,option3,option4',
        ]);

        if ($request->hasFile('question_image')) {
            $validatedData['question_image'] = $request->file('question_image')->store('question_images', 'public');
        }

        if ($request->hasFile('question_sound')) {
            $validatedData['question_sound'] = $request->file('question_sound')->store('question_sounds', 'public');
        }

        Create::create($validatedData);

        return redirect()->route('creates.index')->with('success', 'Question created successfully!');
    }
}