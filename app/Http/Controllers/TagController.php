<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Support\Facades\Auth; 

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::with('creator', 'updater')->paginate(10);  
        
        if (Auth::user() && Auth::user()->role === 'admin') { 
            return view('admin.list.tag-list', compact('tags')); 
        } else {
            return view('teacher.list.tag-list', compact('tags'));
        }
    }
    
    public function create()
    {
        $studentName = Auth::user()->name; 
        
        
        $quizzes = Quiz::with('tags')->get();
        
        if (Auth::user() && Auth::user()->role === 'admin') {
            return view('admin.create.tag', compact('quizzes')); 
        } else {
            return view('teacher.create.tag', compact('quizzes', 'studentName')); // Pass quizzes and student's name
        }
    }
    
    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', 
        ]);
        Tag::create(['name' => $request->name, 'created_by' => Auth::id()]); 

        return redirect()->route('tags.index')->with('success', 'Tag created successfully');
    }

    public function edit(Tag $tag)
    {
        if (Auth::user() && Auth::user()->role === 'admin') { 
            return view('admin.edit.tag-edit', compact('tag'));
        } else {
            return view('teacher.edit.tag-edit', compact('tag'));
        }
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tag->name = $request->input('name');
        $tag->updated_by = Auth::id(); 
        $tag->save();

        return redirect()->route('tags.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully');
    }
}
