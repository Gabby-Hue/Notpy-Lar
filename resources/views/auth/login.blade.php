<x-layouts.app title="Login">
    <div class="container">
        <h2>Login</h2>
        <p class="muted">Masuk untuk mengakses notepad online Anda.</p>

        @if ($errors->any())
            <div class="errors">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="field">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="field">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="field" style="flex-direction: row; align-items: center; gap: .5rem;">
                <input type="checkbox" name="remember" id="remember" style="width: 16px; height: 16px;">
                <label for="remember">Ingat saya</label>
            </div>

            <button type="submit">Login</button>
        </form>

        <p class="muted" style="margin-top: 1rem;">
            Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
        </p>
    </div>
</x-layouts.app>
