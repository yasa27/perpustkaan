@extends('admin.layout')

@section('title', 'Tambah Admin Baru')

@section('content')
<div class="card" style="max-width: 500px;">
    <form action="/admin/admin" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap" required value="{{ old('name') }}">
            @error('name')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Masukkan email" required value="{{ old('email') }}">
            @error('email')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan password" required>
            <small style="color: #64748b; display: block; margin-top: 6px;">Minimal 8 karakter</small>
            @error('password')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password" required>
            @error('password_confirmation')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 12px; margin-top: 28px;">
            <button type="submit" class="btn btn-primary">💾 Buat Admin</button>
            <a href="/admin/admin" class="btn btn-secondary">❌ Batal</a>
        </div>
    </form>
</div>
@endsection
