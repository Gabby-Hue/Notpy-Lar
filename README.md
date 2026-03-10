# Notpy-Lar - Simple Online Notepad (Laravel)

Project ini adalah website notepad online sederhana berbasis Laravel + PHP untuk skala kecil.

## Fitur yang tersedia

- Authentication dengan **register & login** (email + password).
- Halaman utama setelah login dengan **sidebar navbar**.
- Sidebar berisi:
  - Tombol **Buat Note Baru**
  - Daftar note yang sudah tersimpan.
- CRUD Note:
  - **Create** note
  - **Update** note
  - **Delete** note
- Setiap user hanya bisa mengakses note miliknya sendiri.

## Struktur utama

- `routes/web.php` → route auth + note
- `app/Http/Controllers/Auth/*` → login/register/logout
- `app/Http/Controllers/NoteController.php` → CRUD note
- `app/Models/Note.php` → model note
- `database/migrations/2026_03_10_000000_create_notes_table.php` → tabel note
- `resources/views/auth/*` → UI login/register
- `resources/views/notes/index.blade.php` → UI notepad + sidebar

## Setup singkat (Laragon + MySQL)

1. Copy env:

   ```bash
   cp .env.example .env
   ```

2. Atur database di `.env` (contoh Laragon):

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=notpy_lar
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. Install dependency:

   ```bash
   composer install
   ```

4. Generate key app:

   ```bash
   php artisan key:generate
   ```

5. Jalankan migrasi:

   ```bash
   php artisan migrate
   ```

6. Jalankan server lokal:

   ```bash
   php artisan serve
   ```

Buka `http://127.0.0.1:8000`, lalu register akun dan mulai membuat note.
