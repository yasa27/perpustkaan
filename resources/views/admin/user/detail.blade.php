@extends('admin.layout')

@section('title', 'Detail User')

@section('content')
<a href="/admin/user" class="btn btn-secondary" style="margin-bottom: 20px;">← Kembali</a>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 28px;">
    <div class="card" style="border-left: 4px solid #667eea;">
        <div style="color: #94a3b8; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; font-weight: 600;">👤 Nama</div>
        <div style="font-size: 18px; font-weight: 700; color: #1e293b;">{{ $user->name }}</div>
    </div>

    <div class="card" style="border-left: 4px solid #10b981;">
        <div style="color: #94a3b8; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; font-weight: 600;">📧 Email</div>
        <div style="font-size: 13px; color: #1e293b; word-break: break-all;"><code style="background: #f1f5f9; padding: 3px 6px; border-radius: 4px;">{{ $user->email }}</code></div>
    </div>

    <div class="card" style="border-left: 4px solid #f59e0b;">
        <div style="color: #94a3b8; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; font-weight: 600;">📅 Terdaftar</div>
        <div style="font-size: 16px; font-weight: 600; color: #1e293b;">{{ $user->created_at->format('d M Y') }}</div>
    </div>
</div>

<div class="card" style="margin-bottom: 28px;">
    <h3>📖 Riwayat Peminjaman</h3>
    <table class="table">
        <thead>
            <tr>
                <th style="width: 40%;">Buku</th>
                <th style="width: 20%;">Tanggal Pinjam</th>
                <th style="width: 15%;">Status</th>
                <th style="width: 25%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pinjamans as $pinjaman)
                <tr>
                    <td>{{ $pinjaman->buku->judul }}</td>
                    <td><small>{{ $pinjaman->tanggal_pinjam->format('d M Y') }}</small></td>
                    <td>
                        @if($pinjaman->status === 'dipinjam')
                            <span class="badge badge-warning">⏳ Dipinjam</span>
                        @else
                            <span class="badge badge-success">✓ Dikembalikan</span>
                        @endif
                    </td>
                    <td>
                        <a href="/admin/pinjaman/{{ $pinjaman->id }}" class="btn btn-secondary btn-sm">👁️ Lihat</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; padding: 30px; color: #94a3b8;">
                        <div style="font-size: 32px; margin-bottom: 8px;">📭</div>
                        Belum ada peminjaman
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($pinjamans->hasPages())
        <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid #e2e8f0;">
            {{ $pinjamans->links() }}
        </div>
    @endif
</div>

<div class="card">
    <h3>⭐ Ulasan Pengguna</h3>
    <table class="table">
        <thead>
            <tr>
                <th style="width: 30%;">Buku</th>
                <th style="width: 15%;">Rating</th>
                <th style="width: 40%;">Komentar</th>
                <th style="width: 15%;">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reviews as $review)
                <tr>
                    <td>{{ $review->buku->judul }}</td>
                    <td>
                        <span style="color: #f59e0b;">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</span>
                        <span style="font-weight: 600;">{{ $review->rating }}/5</span>
                    </td>
                    <td><small>{{ Str::limit($review->review_text, 50) ?? '-' }}</small></td>
                    <td><small>{{ $review->created_at->format('d M Y') }}</small></td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; padding: 30px; color: #94a3b8;">
                        <div style="font-size: 32px; margin-bottom: 8px;">⭐</div>
                        Belum ada ulasan
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($reviews->hasPages())
        <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid #e2e8f0;">
            {{ $reviews->links() }}
        </div>
    @endif
</div>
@endsection
