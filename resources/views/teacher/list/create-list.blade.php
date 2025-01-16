@extends('teacher.dashboard')

@section('content')
<div class="container mt-5">
    <h1>Questions</h1>
    <div class="row mb-4">
    <form action="{{ route('creates.index') }}" method="GET" class="mb-4">
        <input type="text" name="search" class="form-control w-50 d-inline-block" placeholder="Search questions..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-success">Search</button>
    </form>
    
    <div class="row mb-2">
        <div class="col-md-12 text-end">
            <a href="{{ route('creates.create') }}" class="btn btn-success mb-4">Create New Question</a>
            <a href="{{ route('creates.generate') }}" class="btn btn-success mb-4">Generate Question Paper</a>
        </div>
    </div>
</div>

    @foreach ($questions as $question)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $question->question_text }}</h5><br><br>
                <p><strong>Difficulty:</strong> {{ ucfirst($question->difficulty) }}</p>
                <p><strong>Subject:</strong> {{ $question->subject }}</p>
                @if ($question->question_image)
                    <img src="{{ asset('storage/' . $question->question_image) }}" alt="Question Image" style="max-width: 100px;">
                @endif
                @if ($question->question_sound)
                    <audio controls>
                        <source src="{{ asset('storage/' . $question->question_sound) }}" type="audio/mpeg">
                    </audio>
                @endif
                <td>
                    <a href="{{ route('creates.edit', $question->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('creates.destroy', $question->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this question?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </div>
        </div>
    @endforeach

    {{ $questions->links() }}
</div>
@endsection
