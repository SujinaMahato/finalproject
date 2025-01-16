@extends('teacher.dashboard')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Generated Question Lists</h2>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Title</th>
                <th>Subject</th>
                <th>Generated On</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($generatedList as $listItem)
                <tr>
                    <td>{{ $listItem->title }}</td>
                    <td>{{ $listItem->subject }}</td>
                    <td>{{ $listItem->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        
                        <a href="{{ route('generated.list.item', $listItem->id) }}" class="btn btn-primary btn-sm">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No question lists found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
