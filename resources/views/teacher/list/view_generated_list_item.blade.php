@extends('teacher.dashboard')

@section('content')
<div class="container mt-5">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- List of Question Papers -->
    <h3 class="text-center mb-4">Generated Question Papers</h3>

    @foreach ($questionPapers as $questionPaper)
    <div class="question-paper mt-4 p-3 border rounded shadow-sm">
        <h4 class="text-center">{{ $questionPaper->title }}</h4>
        <hr>
        <p><strong>Subject:</strong> {{ $questionPaper->subject }}</p>

        <div class="section-header mt-3">
            <h5 class="text-center">Section A</h5>
            <p>Answer all questions</p>
        </div>

        <!-- Questions -->
        @if(!empty($questionPaper->questions))
        <ol class="mt-3">
            @foreach ($questionPaper->questions as $index => $question)
                <li class="border p-2 mb-2 rounded">
                    <p class="mb-1">{{ $question['question_text'] }}</p>
                </li>
            @endforeach
        </ol>
        @else
            <p>No questions available.</p>
        @endif

        <!-- Footer -->
        <div class="text-center mt-4">
            <button class="btn btn-primary" onclick="window.print()">Print</button>
        </div>
    </div>
    @endforeach

</div>
@endsection