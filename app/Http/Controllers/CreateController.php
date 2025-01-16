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
    public function edit($id)
    {
        $question = Create::findOrFail($id);
        return view('teacher.edit.create-edit', compact('question'));
    }

    /**
     * Update the specified question in storage.
     */
    public function update(Request $request, $id)
    {
        $question = Create::findOrFail($id);

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
            if ($question->question_image) {
                Storage::disk('public')->delete($question->question_image);
            }
            $validatedData['question_image'] = $request->file('question_image')->store('question_images', 'public');
        }

        if ($request->hasFile('question_sound')) {
            if ($question->question_sound) {
                Storage::disk('public')->delete($question->question_sound);
            }
            $validatedData['question_sound'] = $request->file('question_sound')->store('question_sounds', 'public');
        }

        $question->update($validatedData);

        return redirect()->route('creates.index')->with('success', 'Question updated successfully!');
    }

    /**
     * Remove the specified question from storage.
     */
    public function destroy($id)
    {
        $question = Create::findOrFail($id);

        if ($question->question_image) {
            Storage::disk('public')->delete($question->question_image);
        }

        if ($question->question_sound) {
            Storage::disk('public')->delete($question->question_sound);
        }

        $question->delete();

        return redirect()->route('creates.index')->with('success', 'Question deleted successfully!');
    }
    public function generate()
{
    return view('teacher.create.generate');
}


public function generateQuestionPaper(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|string',
        'difficulty' => 'required|in:easy,medium,hard,mix',
        'number_of_questions' => 'required|integer|min:1',
    ]);

    $number = $validatedData['number_of_questions'];
    $difficulty = $validatedData['difficulty'];

    $questions = collect();

    if ($difficulty === 'mix') {
        $easyCount = floor($number * (2 / 5));
        $mediumCount = floor($number * (2 / 5));
        $hardCount = $number - ($easyCount + $mediumCount);

        $easyQuestions = Create::where('difficulty', 'easy')->inRandomOrder()->take($easyCount)->get();
        $mediumQuestions = Create::where('difficulty', 'medium')->inRandomOrder()->take($mediumCount)->get();
        $hardQuestions = Create::where('difficulty', 'hard')->inRandomOrder()->take($hardCount)->get();

        $questions = $easyQuestions->merge($mediumQuestions)->merge($hardQuestions);
    } else {
        $questions = Create::where('difficulty', $difficulty)->inRandomOrder()->take($number)->get();
    }

    $questions = $questions->shuffle();

    $questionPaper = [
        'title' => $validatedData['title'],
        'questions' => $questions,
    ];

    $fileName = 'question_paper_' . time() . '.json';
    Storage::put('public/question_papers/' . $fileName, json_encode($questionPaper));

    $subject = $questions->first()->subject ?? 'N/A';
    return view('teacher.create.question_paper', compact('questionPaper', 'subject', 'fileName'));
}


}