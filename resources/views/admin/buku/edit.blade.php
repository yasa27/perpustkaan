@extends('admin.layout')

@section('title', 'Edit Buku')

@section('content')
<div class="card" style="max-width: 550px;">
    <form action="/admin/buku/{{ $buku->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="cover_image">📸 Gambar Cover</label>
            @if($buku->cover_image)
                <div style="margin-bottom: 12px;">
                    <img src="/{{ $buku->cover_image }}" alt="{{ $buku->judul }}" style="max-width: 150px; border-radius: 8px; border: 1px solid #e2e8f0;">
                </div>
            @endif
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
                    <option value="{{ $kategori->id }}" {{ old('kategori_id', $buku->kategori_id) == $kategori->id ? 'selected' : '' }}>
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
            <input type="text" id="judul" name="judul" placeholder="Masukkan judul buku" required value="{{ old('judul', $buku->judul) }}">
            @error('judul')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="pengarang">Pengarang</label>
            <input type="text" id="pengarang" name="pengarang" placeholder="Masukkan nama pengarang" required value="{{ old('pengarang', $buku->pengarang) }}">
            @error('pengarang')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="penerbit">Penerbit</label>
            <input type="text" id="penerbit" name="penerbit" placeholder="Masukkan nama penerbit" required value="{{ old('penerbit', $buku->penerbit) }}">
            @error('penerbit')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" id="isbn" name="isbn" placeholder="Masukkan ISBN" required value="{{ old('isbn', $buku->isbn) }}">
            @error('isbn')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="tahun_terbit">Tahun Terbit</label>
            <input type="number" id="tahun_terbit" name="tahun_terbit" placeholder="Tahun" required min="1900" max="{{ date('Y') }}" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}">
            @error('tahun_terbit')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="jumlah_total">Jumlah Total</label>
            <input type="number" id="jumlah_total" name="jumlah_total" placeholder="Berapa buku yang tersedia?" required min="1" value="{{ old('jumlah_total', $buku->jumlah_total) }}">
            <small style="color: #64748b; display: block; margin-top: 6px;">Tersedia saat ini: <strong>{{ $buku->jumlah_tersedia }}</strong> | Dipinjam: <strong>{{ $buku->jumlah_total - $buku->jumlah_tersedia }}</strong></small>
            @error('jumlah_total')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" placeholder="Tuliskan deskripsi buku..." required>{{ old('deskripsi', $buku->deskripsi) }}</textarea>
            @error('deskripsi')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 12px; margin-top: 28px;">
            <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
            <a href="/admin/buku" class="btn btn-secondary">❌ Batal</a>
        </div>
    </form>
</div>
@endsection
