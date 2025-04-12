<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = auth()->user()->notes;
        return view('notes.index', compact('notes'));
    }
    
    public function create()
    {
        return view('notes.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
    
        auth()->user()->notes()->create($validated);
    
        return redirect()->route('notes.index')->with('success', 'Note created successfully!');
    }
    
    public function edit(Note $note)
    {
        $this->authorize('update', $note); // Ensure only the owner can edit
        return view('notes.edit', compact('note'));
    }
    
    public function update(Request $request, Note $note)
    {
        $this->authorize('update', $note);
    
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
    
        $note->update($validated);
    
        return redirect()->route('notes.index')->with('success', 'Note updated successfully!');
    }
    
    public function destroy(Note $note)
    {
        $this->authorize('delete', $note);
    
        $note->delete();
    
        return redirect()->route('notes.index')->with('success', 'Note deleted successfully!');
    }
    
}
