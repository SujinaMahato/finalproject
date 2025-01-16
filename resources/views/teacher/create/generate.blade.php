@extends('teacher.dashboard')

@section('content')
<div class="container mt-5">
    <h1>Generate Question Paper</h1>
    <form action="{{ route('creates.generateQuestionPaper') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Question Paper Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="mb-3">
            <label for="difficulty" class="form-label">Difficulty:</label>
            <select class="form-control" id="difficulty" name="difficulty" required>
                <option value="easy">Easy</option>
                <option value="medium">Medium</option>
                <option value="hard">Hard</option>
                <option value="mix">Mix</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="number_of_questions" class="form-label">Number of Questions:</label>
            <input type="number" class="form-control" id="number_of_questions" name="number_of_questions" required>
        </div>

        <button type="submit" class="btn btn-primary">Generate</button>
    </form>
</div>
@endsection
