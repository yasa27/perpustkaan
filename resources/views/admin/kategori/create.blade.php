@extends('admin.layout')

@section('title', 'Tambah Kategori')

@section('content')
<div class="card" style="max-width: 550px;">
    <form action="/admin/kategori" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="nama">Nama Kategori</label>
            <input type="text" id="nama" name="nama" placeholder="Contoh: Fiksi, Non-Fiksi, Teknologi" required value="{{ old('nama') }}">
            @error('nama')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 12px; margin-top: 28px;">
            <button type="submit" class="btn btn-primary">💾 Simpan Kategori</button>
            <a href="/admin/kategori" class="btn btn-secondary">❌ Batal</a>
        </div>
    </form>
</div>
@endsection
