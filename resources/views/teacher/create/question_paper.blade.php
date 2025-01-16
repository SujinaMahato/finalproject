@extends('teacher.dashboard')

@section('content')
<div class="container mt-5">
    <!-- Question Paper Header -->
    <div class="text-center">
        <h2><strong>COMPUTER APPLICATIONS</strong></h2>
        <h4><em>(Theory)</em></h4>
        <p>
            Answers to this Paper must be written on the paper provided separately.<br>
            This will not be allowed to write during the first 15 minutes.<br>
            You will only be allowed to read the question paper.<br>
            The time given at the head of this Paper is the time allowed for writing the answers.
        </p>
    </div>

    <!-- Question Paper Body -->
    <div class="mt-4">
        <h3 class="text-center">{{ $questionPaper['title'] }}</h3>
        <hr>
        <p><strong>Subject:</strong> {{ $subject  }}</p>

        <div>
            <h4 class="text-center">Section A</h4>
            <p >Answer all questions</p>
        </div>

        <!-- Questions -->
        <ol>
            @foreach ($questionPaper['questions'] as $index => $question)
                <li>
                    <p>{{ $question['question_text'] }}</p>
                    <p><strong>Difficulty:</strong> {{ ucfirst($question['difficulty']) }}</p>
                </li>
            @endforeach
        </ol>
    </div>

    <!-- Footer -->
    <div class="text-center mt-4">
        <a href="{{ asset('storage/question_papers/' . $fileName) }}" class="btn btn-success" download>Download Question Paper</a>
        <button class="btn btn-primary" onclick="window.print()">Print</button>
    </div>
</div>
@endsection
