<x-layouts.app title="Register">
    <div class="container">
        <h2>Register</h2>
        <p class="muted">Buat akun baru untuk menggunakan aplikasi notepad.</p>

        @if ($errors->any())
            <div class="errors">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="field">
                <label>Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="field">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="field">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="field">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <button type="submit">Register</button>
        </form>

        <p class="muted" style="margin-top: 1rem;">
            Sudah punya akun? <a href="{{ route('login') }}">Login</a>
        </p>
    </div>
</x-layouts.app>
