<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Create extends Model
{
    protected $fillable = [
    'difficulty',
        'question_text',
        'subject',
        'question_table',
        'question_image',
        'question_sound',
    ];
}
