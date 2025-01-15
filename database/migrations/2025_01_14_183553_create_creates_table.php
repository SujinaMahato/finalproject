<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('creates', function (Blueprint $table) {
            $table->id();
            $table->text('question_text'); 
            $table->enum('difficulty', ['easy', 'medium', 'hard', 'mix']); 
            $table->string('subject'); 
            $table->string('question_image')->nullable(); 
            $table->string('question_sound')->nullable(); 
            $table->enum('input_type', ['text', 'image', 'audio']); 
            $table->text('option1')->nullable(); 
            $table->text('option2')->nullable(); 
            $table->text('option3')->nullable(); 
            $table->text('option4')->nullable(); 
            $table->string('correct_option')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creates');
    }
};
