@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-blue-800">Your Notes</h1>
            <a href="{{ route('notes.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Create New Note
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        @forelse ($notes as $note)
            <div class="bg-white shadow-md rounded p-4 mb-4">
                <h2 class="text-lg font-semibold text-gray-900">{{ $note->title }}</h2>
                <p class="text-gray-700">{{ $note->content }}</p>
                <div class="mt-4 flex gap-4">
                    <a href="{{ route('notes.show', $note->id) }}" class="text-blue-600 hover:underline">View</a>
                    <a href="{{ route('notes.edit', $note->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                    <form action="{{ route('notes.destroy', $note->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-600">No notes available.</p>
        @endforelse
    </div>
@endsection
