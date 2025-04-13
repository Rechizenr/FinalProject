@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4 color-white">Create New Note</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('notes.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" id="title" class="w-full border-gray-300 rounded mt-1" required>
        </div>
        <div>
            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
            <textarea name="content" id="content" rows="5" class="w-full border-gray-300 rounded mt-1" required></textarea>
        </div>
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save Note</button>
            <a href="{{ route('notes.index') }}" class="ml-2 text-gray-600">Cancel</a>
        </div>
    </form>
</div>
@endsection
