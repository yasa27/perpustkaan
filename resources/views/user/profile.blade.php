<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .card { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);} 
        .label { font-weight:600; color:#374151; margin-bottom:6px; display:block; }
        .input { width:100%; padding:10px; border:1px solid #e5e7eb; border-radius:8px; }
        .actions { display:flex; gap:12px; margin-top:16px; }
        .btn { padding:10px 16px; border-radius:8px; font-weight:600; cursor:pointer; }
        .btn-primary { background: linear-gradient(135deg,#667eea 0%,#764ba2 100%); color:white; border:none }
        .btn-secondary { background:white; border:1px solid #d1d5db }
    </style>
</head>
<body class="bg-gray-50">

<div class="max-w-3xl mx-auto p-6">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
        <h1 style="margin:0;">⚙️ Profil Saya</h1>
        <a href="/dashboard" style="text-decoration:none; color:#667eea; font-weight:600">← Kembali</a>
    </div>

    @if ($errors->any())
        <div class="card" style="border-left:4px solid #f87171; margin-bottom:12px;">
            <ul style="margin:0; padding-left:16px;">
                @foreach ($errors->all() as $error)
                    <li style="color:#b91c1c">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="card" style="border-left:4px solid #10b981; margin-bottom:12px; color:#065f46;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div style="margin-bottom:12px;">
                <label class="label">Nama</label>
                <input class="input" type="text" name="name" value="{{ old('name', $user->name) }}" required />
            </div>

            <div style="margin-bottom:12px;">
                <label class="label">Email</label>
                <input class="input" type="email" name="email" value="{{ old('email', $user->email) }}" required />
            </div>

            <div style="margin-bottom:6px;">
                <label class="label">Ubah Password (opsional)</label>
                <input class="input" type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah" />
            </div>

            <div style="margin-bottom:12px;">
                <label class="label">Konfirmasi Password</label>
                <input class="input" type="password" name="password_confirmation" placeholder="Konfirmasi password" />
            </div>

            <!-- avatar removed -->

            <div class="actions">
                <a href="/dashboard" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
