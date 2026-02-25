@extends('admin.layout')

@section('title', 'Tambah Buku Baru')

@section('content')
<div class="card" style="max-width: 550px;">
    <form action="/admin/buku" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="cover_image">📸 Gambar Cover (Opsional)</label>
            <input type="file" id="cover_image" name="cover_image" accept="image/*">
            <small style="color: #94a3b8;">Format: JPG, PNG, GIF. Maksimal 2MB</small>
            @error('cover_image')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="kategori_id">📚 Kategori</label>
            <select id="kategori_id" name="kategori_id">
                <option value="">-- Pilih Kategori --</option>
                @forelse($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @empty
                    <option value="" disabled>Tidak ada kategori</option>
                @endforelse
            </select>
            <small style="color: #94a3b8;">Pilih kategori untuk buku ini</small>
            @error('kategori_id')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="judul">Judul Buku</label>
            <input type="text" id="judul" name="judul" placeholder="Masukkan judul buku" required value="{{ old('judul') }}">
            @error('judul')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="pengarang">Pengarang</label>
            <input type="text" id="pengarang" name="pengarang" placeholder="Masukkan nama pengarang" required value="{{ old('pengarang') }}">
            @error('pengarang')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="penerbit">Penerbit</label>
            <input type="text" id="penerbit" name="penerbit" placeholder="Masukkan nama penerbit" required value="{{ old('penerbit') }}">
            @error('penerbit')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" id="isbn" name="isbn" placeholder="Masukkan ISBN" required value="{{ old('isbn') }}">
            @error('isbn')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="tahun_terbit">Tahun Terbit</label>
            <input type="number" id="tahun_terbit" name="tahun_terbit" placeholder="Tahun" required min="1900" max="{{ date('Y') }}" value="{{ old('tahun_terbit') }}">
            @error('tahun_terbit')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="jumlah_total">Jumlah Total</label>
            <input type="number" id="jumlah_total" name="jumlah_total" placeholder="Berapa buku yang tersedia?" required min="1" value="{{ old('jumlah_total') }}">
            @error('jumlah_total')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" placeholder="Tuliskan deskripsi buku..." required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 12px; margin-top: 28px;">
            <button type="submit" class="btn btn-primary">💾 Simpan Buku</button>
            <a href="/admin/buku" class="btn btn-secondary">❌ Batal</a>
        </div>
    </form>
</div>
@endsection
