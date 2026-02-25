@extends('admin.layout')

@section('title', 'Kelola Kategori')

@section('content')
<div style="margin-bottom: 20px; display: flex; gap: 12px; align-items: center;">
    <a href="/admin/kategori/create" class="btn btn-primary">➕ Tambah Kategori Baru</a>
    
    <form action="/admin/kategori" method="GET" style="margin-left: auto; display: flex; gap: 8px;">
        <input type="text" name="search" placeholder="Cari kategori..." value="{{ $search ?? '' }}" style="padding: 8px 12px; border: 1px solid #cbd5e0; border-radius: 4px; width: 200px;">
        <button type="submit" class="btn btn-secondary" style="white-space: nowrap;">🔍 Cari</button>
        @if($search)
            <a href="/admin/kategori" class="btn btn-secondary" style="white-space: nowrap;">✕ Reset</a>
        @endif
    </form>
</div>

<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 10%;">No</th>
                <th style="width: 90%;">Nama Kategori</th>
                <th style="width: 50%;">Jumlah Buku</th>
                <th style="width: 15%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kategoris as $kategori)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $kategori->nama }}</strong></td>
                    <td>
                        <span class="badge badge-info">{{ $kategori->bukus()->count() }} buku</span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="/admin/kategori/{{ $kategori->id }}/edit" class="btn btn-secondary btn-sm">✏️ Edit</a>
                            <form action="/admin/kategori/{{ $kategori->id }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">🗑️ Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 40px; color: #94a3b8;">
                        <div style="font-size: 32px; margin-bottom: 8px;">📭</div>
                        Belum ada kategori
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($kategoris->hasPages())
        <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #e2e8f0;">
            {{ $kategoris->links() }}
        </div>
    @endif
</div>
@endsection
