@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="bg-white shadow p-6 rounded">
        <h1 class="text-2xl font-bold mb-4">{{ $note->title }}</h1>
        <p class="text-gray-700 whitespace-pre-wrap">{{ $note->content }}</p>
        <div class="mt-6">
            <a href="{{ route('notes.edit', $note) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
            <form action="{{ route('notes.destroy', $note) }}" method="POST" class="inline-block ml-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded" onclick="return confirm('Are you sure you want to delete this note?')">Delete</button>
            </form>
            <a href="{{ route('notes.index') }}" class="ml-4 text-gray-600">Back to Notes</a>
        </div>
    </div>
</div>
@endsection
