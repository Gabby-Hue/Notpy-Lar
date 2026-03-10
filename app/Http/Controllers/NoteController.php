<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NoteController extends Controller
{
    public function index(Request $request): View
    {
        $notes = $request->user()->notes()->latest()->get();

        $selectedNote = null;

        if ($request->filled('note')) {
            $selectedNote = $request->user()->notes()->find($request->integer('note'));
        }

        return view('notes.index', [
            'notes' => $notes,
            'selectedNote' => $selectedNote,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
        ]);

        $note = $request->user()->notes()->create($validated);

        return redirect()->route('notes.index', ['note' => $note->id])
            ->with('status', 'Note berhasil disimpan.');
    }

    public function update(Request $request, Note $note): RedirectResponse
    {
        abort_unless($note->user_id === $request->user()->id, 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
        ]);

        $note->update($validated);

        return redirect()->route('notes.index', ['note' => $note->id])
            ->with('status', 'Note berhasil diperbarui.');
    }

    public function destroy(Request $request, Note $note): RedirectResponse
    {
        abort_unless($note->user_id === $request->user()->id, 403);

        $note->delete();

        return redirect()->route('notes.index')
            ->with('status', 'Note berhasil dihapus.');
    }
}
