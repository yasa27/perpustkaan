@extends('admin.layout')

@section('title', 'Dashboard Admin')

@section('content')
<div style="background: linear-gradient(135deg, #fef3c7 0%, #fcd34d 100%); border-left: 5px solid #f59e0b; border-radius: 12px; padding: 24px; margin-bottom: 28px; border: 1px solid #e2e8f0; display: flex; gap: 16px; align-items: flex-start;">
    <div style="font-size: 48px; flex-shrink: 0;">🔐</div>
    <div>
        <h3 style="color: #92400e; margin: 0 0 8px 0; font-size: 18px; font-weight: 700;">Akun Admin Terdaftar</h3>
        <p style="color: #92400e; margin: 0; font-size: 14px;">Sistem hanya memiliki 1 akun admin. Anda memiliki akses penuh untuk mengelola seluruh perpustakaan digital.</p>
    </div>
</div>

<div style="display: flex; gap: 20px; margin-bottom: 28px; flex-wrap: wrap;">
    <div style="flex: 1; min-width: 150px; background: white; border-radius: 12px; padding: 24px; border: 1px solid #e2e8f0; text-align: center;">
        <div style="font-size: 40px; margin-bottom: 12px;">📚</div>
        <div style="font-size: 11px; color: #94a3b8; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">Total Buku</div>
        <div style="font-size: 36px; font-weight: 700; color: #667eea;">{{ $totalBuku }}</div>
    </div>
    
    <div style="flex: 1; min-width: 150px; background: white; border-radius: 12px; padding: 24px; border: 1px solid #e2e8f0; text-align: center;">
        <div style="font-size: 40px; margin-bottom: 12px;">👥</div>
        <div style="font-size: 11px; color: #94a3b8; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">Total User</div>
        <div style="font-size: 36px; font-weight: 700; color: #10b981;">{{ $totalUser }}</div>
    </div>
    
    <div style="flex: 1; min-width: 150px; background: white; border-radius: 12px; padding: 24px; border: 1px solid #e2e8f0; text-align: center;">
        <div style="font-size: 40px; margin-bottom: 12px;">📖</div>
        <div style="font-size: 11px; color: #94a3b8; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">Total Peminjaman</div>
        <div style="font-size: 36px; font-weight: 700; color: #f59e0b;">{{ $totalPinjaman }}</div>
    </div>
</div>

<div style="display: flex; gap: 20px; margin-bottom: 28px; flex-wrap: wrap;">
    <div style="flex: 1; min-width: 150px; background: white; border-radius: 12px; padding: 24px; border: 1px solid #e2e8f0; text-align: center;">
        <div style="font-size: 40px; margin-bottom: 12px;">⏳</div>
        <div style="font-size: 11px; color: #94a3b8; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">Sedang Dipinjam</div>
        <div style="font-size: 36px; font-weight: 700; color: #ef4444;">{{ $pinjamanAktif }}</div>
    </div>
    
    <div style="flex: 1; min-width: 150px; background: white; border-radius: 12px; padding: 24px; border: 1px solid #e2e8f0; text-align: center;">
        <div style="font-size: 40px; margin-bottom: 12px;">⭐</div>
        <div style="font-size: 11px; color: #94a3b8; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">Total Ulasan</div>
        <div style="font-size: 36px; font-weight: 700; color: #8b5cf6;">{{ $totalReview }}</div>
    </div>
    
    <div style="flex: 1; min-width: 150px; background: white; border-radius: 12px; padding: 24px; border: 1px solid #e2e8f0; text-align: center;">
        <div style="font-size: 40px; margin-bottom: 12px;">🔑</div>
        <div style="font-size: 11px; color: #94a3b8; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">Total Admin</div>
        <div style="font-size: 36px; font-weight: 700; color: #06b6d4;">{{ $totalAdmin }}</div>
    </div>
</div>

<div style="background: white; border-radius: 12px; padding: 24px; border: 1px solid #e2e8f0;">
    <h3 style="margin-bottom: 20px; color: #1e293b; font-size: 16px; font-weight: 700;">🎯 Akses Cepat</h3>
    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
        <a href="/admin/buku/create" style="background: #667eea; color: white; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.25s; flex: 1; text-align: center; min-width: 140px;">➕ Tambah Buku</a>
        <a href="/admin/admin/create" style="background: #667eea; color: white; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.25s; flex: 1; text-align: center; min-width: 140px;">➕ Tambah Admin</a>
        <a href="/admin/buku" style="background: #64748b; color: white; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.25s; flex: 1; text-align: center; min-width: 140px;">📚 Lihat Buku</a>
        <a href="/admin/pinjaman" style="background: #64748b; color: white; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.25s; flex: 1; text-align: center; min-width: 140px;">📖 Peminjaman</a>
        <a href="{{ route('report.index') }}" style="background: #64748b; color: white; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.25s; flex: 1; text-align: center; min-width: 140px;">📊 Laporan</a>
    </div>
</div>
@endsection
