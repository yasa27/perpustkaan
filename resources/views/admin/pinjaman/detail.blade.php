@extends('admin.layout')

@section('title', 'Detail Peminjaman')

@section('content')
<a href="/admin/pinjaman" class="btn btn-secondary" style="margin-bottom: 20px;">← Kembali</a>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 28px;">
    <div class="card" style="border-left: 4px solid #667eea;">
        <div style="color: #94a3b8; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; font-weight: 600;">👤 User</div>
        <div style="font-size: 18px; font-weight: 700; color: #1e293b; margin-bottom: 4px;">{{ $pinjaman->user->name }}</div>
        <div style="font-size: 13px; color: #64748b;"><code style="background: #f1f5f9; padding: 2px 4px; border-radius: 3px;">{{ $pinjaman->user->email }}</code></div>
    </div>

    <div class="card" style="border-left: 4px solid #10b981;">
        <div style="color: #94a3b8; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; font-weight: 600;">📚 Buku</div>
        <div style="font-size: 18px; font-weight: 700; color: #1e293b; margin-bottom: 4px;">{{ $pinjaman->buku->judul }}</div>
        <div style="font-size: 13px; color: #64748b;">{{ $pinjaman->buku->pengarang }}</div>
    </div>

    <div class="card" style="border-left: 4px solid #f59e0b;">
        <div style="color: #94a3b8; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; font-weight: 600;">📅 Status</div>
        @if($pinjaman->status === 'dipinjam')
            <span class="badge badge-warning" style="font-size: 13px;">⏳ Sedang Dipinjam</span>
            <div style="margin-top:10px;">
                <form action="/admin/pinjaman/{{ $pinjaman->id }}/kembalikan" method="POST" onsubmit="return confirm('Tandai peminjaman ini sudah dikembalikan?');">
                    @csrf
                    <button type="submit" class="btn btn-primary" style="margin-top:8px;">✓ Tandai Dikembalikan</button>
                </form>
            </div>
        @else
            <span class="badge badge-success" style="font-size: 13px;">✓ Dikembalikan</span>
        @endif
    </div>
</div>

<div class="card">
    <h3>📋 Detail Peminjaman</h3>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        <div>
            <div style="color: #94a3b8; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; font-weight: 600;">Tanggal Pinjam</div>
            <div style="font-size: 16px; font-weight: 600; color: #1e293b;">{{ $pinjaman->tanggal_pinjam->format('d M Y H:i') }}</div>
        </div>
        <div>
            <div style="color: #94a3b8; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; font-weight: 600;">Target Kembali</div>
            <div style="font-size: 16px; font-weight: 600; color: #1e293b;">{{ $pinjaman->tanggal_kembali_target->format('d M Y') }}</div>
        </div>
        @if($pinjaman->status === 'dikembalikan')
            <div>
                <div style="color: #94a3b8; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; font-weight: 600;">Tanggal Kembali Aktual</div>
                <div style="font-size: 16px; font-weight: 600; color: #10b981;">{{ $pinjaman->tanggal_kembali_aktual->format('d M Y H:i') }}</div>
            </div>
        @endif
    </div>
</div>

@if($pinjaman->review)
    <div class="card">
        <h3>⭐ Ulasan Pengguna</h3>
        <div style="background: linear-gradient(135deg, #fef3c7 0%, #fcd34d 100%); padding: 20px; border-radius: 10px; border-left: 4px solid #f59e0b;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                <span style="font-size: 24px;">{{ str_repeat('★', $pinjaman->review->rating) }}{{ str_repeat('☆', 5 - $pinjaman->review->rating) }}</span>
                <span style="font-weight: 600; color: #92400e; font-size: 16px;">{{ $pinjaman->review->rating }}/5 bintang</span>
            </div>
            @if($pinjaman->review->review_text)
                <p style="color: #78350f; margin: 0; font-style: italic; line-height: 1.6;">{{ $pinjaman->review->review_text }}</p>
            @endif
        </div>
    </div>
@else
    <div class="card">
        <p style="color: #94a3b8; margin: 0; text-align: center; padding: 20px;">
            <span style="font-size: 32px; display: block; margin-bottom: 8px;">📭</span>
            Belum ada ulasan untuk peminjaman ini
        </p>
    </div>
@endif
@endsection
