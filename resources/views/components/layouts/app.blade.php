<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Simple Notes' }}</title>
    <style>
        :root { font-family: Arial, sans-serif; }
        body { margin: 0; background: #f5f7fb; color: #222; }
        .container { max-width: 420px; margin: 4rem auto; background: #fff; border-radius: 10px; padding: 1.5rem; box-shadow: 0 8px 24px rgba(0,0,0,0.08); }
        .page { display: flex; min-height: 100vh; }
        .sidebar { width: 290px; background: #111827; color: #f9fafb; padding: 1rem; }
        .content { flex: 1; padding: 1.5rem; }
        h1, h2, h3 { margin-top: 0; }
        .field { display: flex; flex-direction: column; margin-bottom: 0.9rem; }
        input, textarea { padding: .6rem; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; }
        textarea { min-height: 250px; resize: vertical; }
        button, .btn { border: 0; background: #2563eb; color: #fff; padding: .55rem .9rem; border-radius: 8px; cursor: pointer; text-decoration: none; display: inline-block; }
        button.secondary, .btn.secondary { background: #6b7280; }
        button.danger { background: #dc2626; }
        .note-list a { display: block; padding: .65rem; border-radius: 8px; color: #e5e7eb; text-decoration: none; margin-bottom: .5rem; background: rgba(255,255,255,0.08); }
        .note-list a.active { background: #2563eb; color: #fff; }
        .alert { background: #dcfce7; color: #166534; border: 1px solid #86efac; padding: .65rem; border-radius: 8px; margin-bottom: 1rem; }
        .errors { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; padding: .65rem; border-radius: 8px; margin-bottom: 1rem; }
        .muted { color: #94a3b8; font-size: 13px; }
        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
    </style>
</head>
<body>
{{ $slot }}
</body>
</html>
