<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Note;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): \Inertia\Response
    {
        $query = $request->get('q');
        $notes = Note::query()->latest()->where('excerpt', 'like', "%$query%")->get();
        $queryParams = $request->query();
        return Inertia::render('Notes/Index', compact(
            'notes',
            'queryParams'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Notes/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoteRequest $request): \Illuminate\Http\RedirectResponse
    {
        $note = new Note();
        $note->excerpt = $request->get('excerpt');
        $note->content = $request->get('content');
        $note->save();
        return to_route('notes.index')->with('message', 'Note successfully stored!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note): \Inertia\Response
    {
        return Inertia::render('Notes/Show', compact(
            'note'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note): \Inertia\Response
    {
        return Inertia::render('Notes/Edit', compact(
            'note'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoteRequest $request, Note $note): \Illuminate\Http\RedirectResponse
    {
        $note->update($request->all());
        return to_route('notes.index')->with('message', 'Note successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note): \Illuminate\Http\RedirectResponse
    {
        $note->delete();

        return to_route('notes.index')->with('message', 'Note successfully deleted!');
    }
}
