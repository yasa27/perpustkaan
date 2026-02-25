@extends('admin.layout')

@section('title', 'Kelola Peminjaman')

@section('content')
<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 18%;">User</th>
                <th style="width: 22%;">Buku</th>
                <th style="width: 13%;">Tanggal Pinjam</th>
                <th style="width: 13%;">Target Kembali</th>
                <th style="width: 14%;">Status</th>
                <th style="width: 15%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pinjamans as $pinjaman)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $pinjaman->user->name }}</strong></td>
                    <td>{{ $pinjaman->buku->judul }}</td>
                    <td><small>{{ $pinjaman->tanggal_pinjam->format('d M Y') }}</small></td>
                    <td><small>{{ $pinjaman->tanggal_kembali_target->format('d M Y') }}</small></td>
                    <td>
                        @if($pinjaman->status === 'dipinjam')
                            <span class="badge badge-warning">⏳ Dipinjam</span>
                        @else
                            <span class="badge badge-success">✓ Dikembalikan</span>
                        @endif
                    </td>
                    <td>
                        <a href="/admin/pinjaman/{{ $pinjaman->id }}" class="btn btn-secondary btn-sm">👁️ Detail</a>
                        @if($pinjaman->status === 'dipinjam')
                            <form action="/admin/pinjaman/{{ $pinjaman->id }}/kembalikan" method="POST" style="display: inline; margin-left:6px;">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Tandai peminjaman ini sudah dikembalikan?');">✓ Kembalikan</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 40px; color: #94a3b8;">
                        <div style="font-size: 32px; margin-bottom: 8px;">📭</div>
                        Belum ada data peminjaman
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($pinjamans->hasPages())
        <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #e2e8f0;">
            {{ $pinjamans->links() }}
        </div>
    @endif
</div>
@endsection
