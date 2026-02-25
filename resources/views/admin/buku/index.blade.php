@extends('admin.layout')

@section('title', 'Kelola Buku')

@section('content')
<div style="margin-bottom: 20px; display: flex; gap: 12px; align-items: center;">
    <a href="/admin/buku/create" class="btn btn-primary">➕ Tambah Buku Baru</a>
    
    <form action="/admin/buku" method="GET" style="margin-left: auto; display: flex; gap: 8px;">
        <input type="text" name="search" placeholder="Cari buku..." value="{{ $search ?? '' }}" style="padding: 8px 12px; border: 1px solid #cbd5e0; border-radius: 4px; width: 200px;">
        <button type="submit" class="btn btn-secondary" style="white-space: nowrap;">🔍 Cari</button>
        @if($search)
            <a href="/admin/buku" class="btn btn-secondary" style="white-space: nowrap;">✕ Reset</a>
        @endif
    </form>
</div>

<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 4%;">No</th>
                <th style="width: 6%;">Gambar</th>
                <th style="width: 18%;">Judul</th>
                <th style="width: 10%;">Kategori</th>
                <th style="width: 10%;">Pengarang</th>
                <th style="width: 10%;">Penerbit</th>
                <th style="width: 7%;">ISBN</th>
                <th style="width: 6%;">Stok</th>
                <th style="width: 6%;">Tersedia</th>
                <th style="width: 12%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bukus as $buku)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($buku->cover_image)
                            <img src="/{{ $buku->cover_image }}" alt="{{ $buku->judul }}" style="width: 45px; height: 60px; object-fit: cover; border-radius: 4px;">
                        @else
                            <div style="width: 45px; height: 60px; background: #e2e8f0; border-radius: 4px; display: flex; align-items: center; justify-content: center; font-size: 24px;">📕</div>
                        @endif
                    </td>
                    <td><strong>{{ $buku->judul }}</strong></td>
                    <td>
                        @if($buku->kategori)
                            <span class="badge" style="background: #667eea; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px;">{{ $buku->kategori->nama }}</span>
                        @else
                            <span style="color: #94a3b8; font-size: 12px;">-</span>
                        @endif
                    </td>
                    <td>{{ $buku->pengarang }}</td>
                    <td>{{ $buku->penerbit }}</td>
                    <td><code style="background: #f1f5f9; padding: 3px 6px; border-radius: 4px; font-size: 12px;">{{ $buku->isbn }}</code></td>
                    <td>{{ $buku->jumlah_total }}</td>
                    <td>
                        <span class="badge @if($buku->jumlah_tersedia > 0) badge-success @else badge-danger @endif">
                            {{ $buku->jumlah_tersedia }}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="/admin/buku/{{ $buku->id }}/edit" class="btn btn-secondary btn-sm">✏️ Edit</a>
                            <form action="/admin/buku/{{ $buku->id }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">🗑️ Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="text-align: center; padding: 40px; color: #94a3b8;">
                        <div style="font-size: 32px; margin-bottom: 8px;">📭</div>
                        Belum ada buku
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($bukus->hasPages())
        <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #e2e8f0;">
            {{ $bukus->links() }}
        </div>
    @endif
</div>
@endsection
