@extends('admin.layout')

@section('title', 'Edit Kategori')

@section('content')
<div class="card" style="max-width: 550px;">
    <form action="/admin/kategori/{{ $kategori->id }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="nama">Nama Kategori</label>
            <input type="text" id="nama" name="nama" placeholder="Contoh: Fiksi, Non-Fiksi, Teknologi" required value="{{ old('nama', $kategori->nama) }}">
            @error('nama')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin: 16px 0; padding: 12px; background: #f0fdf4; border-left: 4px solid #10b981; border-radius: 6px; font-size: 14px; color: #166534;">
            📊 Buku dalam kategori ini: <strong>{{ $kategori->bukus()->count() }}</strong>
        </div>

        <div style="display: flex; gap: 12px; margin-top: 28px;">
            <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
            <a href="/admin/kategori" class="btn btn-secondary">❌ Batal</a>
        </div>
    </form>
</div>
@endsection
