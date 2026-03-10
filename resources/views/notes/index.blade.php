<x-layouts.app title="Simple Notes">
    <div class="page">
        <aside class="sidebar">
            <div class="topbar">
                <h3>Simple Notes</h3>
            </div>
            <p class="muted" style="color:#93c5fd;">Halo, {{ auth()->user()->name }}</p>

            <a href="{{ route('notes.index') }}" class="btn secondary" style="width: 100%; text-align: center; margin-bottom: .8rem;">+ Buat Note Baru</a>

            <div class="note-list">
                @forelse ($notes as $note)
                    <a href="{{ route('notes.index', ['note' => $note->id]) }}"
                       class="{{ optional($selectedNote)->id === $note->id ? 'active' : '' }}">
                        <strong>{{ $note->title }}</strong><br>
                        <span class="muted" style="color:#cbd5e1;">{{ $note->updated_at->diffForHumans() }}</span>
                    </a>
                @empty
                    <p class="muted">Belum ada note tersimpan.</p>
                @endforelse
            </div>

            <form method="POST" action="{{ route('logout') }}" style="margin-top: 1rem;">
                @csrf
                <button type="submit" class="secondary" style="width:100%;">Logout</button>
            </form>
        </aside>

        <main class="content">
            @if (session('status'))
                <div class="alert">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="errors">{{ $errors->first() }}</div>
            @endif

            <h2>{{ $selectedNote ? 'Edit Note' : 'Buat Note Baru' }}</h2>

            <form method="POST" action="{{ $selectedNote ? route('notes.update', $selectedNote) : route('notes.store') }}">
                @csrf
                @if ($selectedNote)
                    @method('PUT')
                @endif

                <div class="field">
                    <label>Judul</label>
                    <input type="text" name="title" value="{{ old('title', $selectedNote->title ?? '') }}" required>
                </div>

                <div class="field">
                    <label>Isi Note</label>
                    <textarea name="content" placeholder="Tulis catatan Anda di sini...">{{ old('content', $selectedNote->content ?? '') }}</textarea>
                </div>

                <button type="submit">{{ $selectedNote ? 'Update Note' : 'Simpan Note' }}</button>
            </form>

            @if ($selectedNote)
                <form method="POST" action="{{ route('notes.destroy', $selectedNote) }}" style="margin-top: .75rem;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="danger" onclick="return confirm('Yakin ingin menghapus note ini?')">Delete Note</button>
                </form>
            @endif
        </main>
    </div>
</x-layouts.app>
