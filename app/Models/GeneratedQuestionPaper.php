<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneratedQuestionPaper extends Model
{
    //
    protected $fillable = ['title', 'subject', 'questions', 'file_name'];
    protected $casts = [
        'questions' => 'array', // Automatically cast JSON to array
    ];

    
}

