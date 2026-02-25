@extends('admin.layout')

@section('title', 'Tambah User')

@section('content')
<div class="card" style="max-width: 550px;">
    <form action="/admin/user" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" placeholder="Nama lengkap" required value="{{ old('name') }}">
            @error('name')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="user@example.com" required value="{{ old('email') }}">
            @error('email')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Minimal 8 karakter" required>
            @error('password')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
        </div>

        <div style="display: flex; gap: 12px; margin-top: 28px;">
            <button type="submit" class="btn btn-primary">💾 Tambah User</button>
            <a href="/admin/user" class="btn btn-secondary">❌ Batal</a>
        </div>
    </form>
</div>
@endsection
