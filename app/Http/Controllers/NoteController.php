<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'image' => ['nullable', 'image', 'max:5120'],
            'video' => ['nullable', 'file', 'mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/x-matroska,video/webm', 'max:51200'],
        ]);

        $note = $request->user()->notes()->create([
            'title' => $validated['title'],
            'content' => $validated['content'] ?? null,
            'image_path' => $request->file('image')?->store('note-media/images', 'public'),
            'video_path' => $request->file('video')?->store('note-media/videos', 'public'),
        ]);

        return redirect()->route('notes.index', ['note' => $note->id])
            ->with('status', 'Note berhasil disimpan.');
    }

    public function update(Request $request, Note $note): RedirectResponse
    {
        abort_unless($note->user_id === $request->user()->id, 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
            'video' => ['nullable', 'file', 'mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/x-matroska,video/webm', 'max:51200'],
            'remove_image' => ['nullable', 'boolean'],
            'remove_video' => ['nullable', 'boolean'],
        ]);

        $imagePath = $note->image_path;
        $videoPath = $note->video_path;

        if ($request->boolean('remove_image') || $request->hasFile('image')) {
            $this->deleteFromPublicDisk($imagePath);
            $imagePath = null;
        }

        if ($request->boolean('remove_video') || $request->hasFile('video')) {
            $this->deleteFromPublicDisk($videoPath);
            $videoPath = null;
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('note-media/images', 'public');
        }

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('note-media/videos', 'public');
        }

        $note->update([
            'title' => $validated['title'],
            'content' => $validated['content'] ?? null,
            'image_path' => $imagePath,
            'video_path' => $videoPath,
        ]);

        return redirect()->route('notes.index', ['note' => $note->id])
            ->with('status', 'Note berhasil diperbarui.');
    }

    public function destroy(Request $request, Note $note): RedirectResponse
    {
        abort_unless($note->user_id === $request->user()->id, 403);

        $this->deleteFromPublicDisk($note->image_path);
        $this->deleteFromPublicDisk($note->video_path);

        $note->delete();

        return redirect()->route('notes.index')
            ->with('status', 'Note berhasil dihapus.');
    }

    private function deleteFromPublicDisk(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
