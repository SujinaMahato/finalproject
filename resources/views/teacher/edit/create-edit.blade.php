@extends('teacher.dashboard')

@section('content')
<div class="container mt-5">
    <h1>Edit Question</h1>

    <form action="{{ route('creates.update', $question->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="question_text" class="form-label">Question:</label>
            <textarea class="form-control" id="question_text" name="question_text" required>{{ old('question_text', $question->question_text) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="difficulty" class="form-label">Difficulty:</label>
            <div>
                @foreach (['easy', 'medium', 'hard', 'mix'] as $level)
                    <div class="form-check">
                        <input 
                            type="radio" 
                            name="difficulty" 
                            id="difficulty-{{ $level }}" 
                            value="{{ $level }}" 
                            class="form-check-input"
                            @if (old('difficulty', $question->difficulty) == $level) checked @endif
                        >
                        <label for="difficulty-{{ $level }}" class="form-check-label">{{ ucfirst($level) }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-3">
            <label for="subject" class="form-label">Subject:</label>
            <select class="form-control" id="subject" name="subject" required>
                <option value="bca" @if (old('subject', $question->subject) == 'bca') selected @endif>BCA</option>
                <option value="csit" @if (old('subject', $question->subject) == 'csit') selected @endif>CSIT</option>
                <option value="bit" @if (old('subject', $question->subject) == 'bit') selected @endif>BIT</option>
                <option value="bhm" @if (old('subject', $question->subject) == 'bhm') selected @endif>BHM</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="question_image" class="form-label">Upload Question Image</label>
            @if ($question->question_image)
                <div>
                    <img src="{{ asset('storage/' . $question->question_image) }}" alt="Current Image" style="max-width: 100px;">
                </div>
            @endif
            <input type="file" class="form-control" id="question_image" name="question_image" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="question_sound" class="form-label">Upload Question Sound</label>
            @if ($question->question_sound)
                <div>
                    <audio controls>
                        <source src="{{ asset('storage/' . $question->question_sound) }}" type="audio/mpeg">
                    </audio>
                </div>
            @endif
            <input type="file" class="form-control" id="question_sound" name="question_sound" accept="audio/*">
        </div>

        <div class="mb-3">
            <label for="correct_option" class="form-label">Select Correct Option</label>
            <select class="form-select" id="correct_option" name="correct_option" required>
                <option value="option1" @if (old('correct_option', $question->correct_option) == 'option1') selected @endif>Option 1</option>
                <option value="option2" @if (old('correct_option', $question->correct_option) == 'option2') selected @endif>Option 2</option>
                <option value="option3" @if (old('correct_option', $question->correct_option) == 'option3') selected @endif>Option 3</option>
                <option value="option4" @if (old('correct_option', $question->correct_option) == 'option4') selected @endif>Option 4</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Question</button>
    </form>
</div>
@endsection
