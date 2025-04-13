<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    // Use this trait to allow authorization methods in this controller
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;

    // Show all notes
    public function index()
{
    // Fetch all notes for the logged-in user, paginated with 10 notes per page
    $notes = Note::where('user_id', Auth::id())->paginate(10);

    // Return the view and pass the paginated notes
    return view('notes.index', compact('notes'));
}


public function create()
{
    return view('notes.create');
}

public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        // Create a new note and save it to the database
        $note = new Note();
        $note->title = $validated['title'];
        $note->content = $validated['content'];
        $note->user_id = Auth::id();  // Associate the note with the currently logged-in user
        $note->save();

        // Redirect back with a success message
        return redirect()->route('notes.index')->with('success', 'Note created successfully!');
    }
    // Show the form to edit the note
    public function edit($id)
    {
        $note = Note::findOrFail($id);

        // Authorization check: make sure the note belongs to the logged-in user
        $this->authorize('update', $note);  // Policy method for authorization

        return view('notes.edit', compact('note'));
    }

    // Update the note
    public function update(Request $request, $id)
    {
        $note = Note::findOrFail($id);

        // Validate the form input
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Perform the authorization check before updating
        $this->authorize('update', $note);  // Policy method for authorization

        // Update the note
        $note->update($request->all());

        // Redirect to the notes index after successful update
        return redirect()->route('notes.index')->with('success', 'Note updated successfully');
    }

    public function show($id)
{
    // Retrieve the note with the given id for the logged-in user
    $note = Note::where('user_id', Auth::id())->findOrFail($id);

    // Return the view with the note data
    return view('notes.show', compact('note'));
}


public function destroy($id)
{
    // Find the note by ID for the logged-in user
    $note = Note::where('user_id', Auth::id())->findOrFail($id);

    // Delete the note
    $note->delete();

    // Redirect to the notes index page with a success message
    return redirect()->route('notes.index')->with('success', 'Note deleted successfully.');
}
    // Other methods...
}
