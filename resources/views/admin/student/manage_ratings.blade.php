@extends('admin.layouts.layout')
@section('admin_page_title', 'Institute Rating Moderation')
@section('content')

<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Institute Rating Moderation</h1>

    @foreach ($ratings as $rating)
        <div class="bg-white p-4 rounded shadow mb-4">
            <p class="text-gray-800 font-semibold">{{ $rating->user->name }} rated <strong>{{ $rating->rating }}/5</strong></p>
            <p class="text-sm text-gray-600 mb-2">{{ $rating->review }}</p>
            <div class="flex space-x-4">
                <form action="{{ route('admin.ratings.approve', $rating->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">Approve</button>
                </form>
                <form action="{{ route('admin.ratings.reject', $rating->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Reject</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
