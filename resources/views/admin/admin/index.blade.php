@extends('admin.layout')

@section('title', 'Kelola Admin')

@section('content')
<div class="card">
    <h3>🔑 Admin Terdaftar</h3>
    <p style="color: #64748b; margin-bottom: 20px;">Sistem hanya mendukung 1 akun admin untuk mengatur seluruh perpustakaan digital.</p>
    
    @if($admin)
        <div style="background: linear-gradient(135deg, #e0e7ff 0%, #f3e8ff 100%); border: 2px solid #a78bfa; border-radius: 10px; padding: 20px; margin-bottom: 20px;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 16px;">
                <div>
                    <div style="color: #6d28d9; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; font-weight: 600;">👤 Nama</div>
                    <div style="font-size: 18px; font-weight: 700; color: #1e293b;">{{ $admin->name }}</div>
                </div>
                <div>
                    <div style="color: #6d28d9; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; font-weight: 600;">📧 Email</div>
                    <div style="font-size: 14px; color: #1e293b;"><code style="background: white; padding: 3px 6px; border-radius: 4px;">{{ $admin->email }}</code></div>
                </div>
                <div>
                    <div style="color: #6d28d9; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; font-weight: 600;">📅 Terdaftar Sejak</div>
                    <div style="font-size: 14px; font-weight: 600; color: #1e293b;">{{ $admin->created_at->format('d M Y H:i') }}</div>
                </div>
                <div>
                    <div style="color: #6d28d9; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; font-weight: 600;">🔐 Status</div>
                    <span class="badge badge-success">✓ Aktif</span>
                </div>
            </div>
            
            @if(auth()->user()->id === $admin->id)
                <div style="margin-top: 16px; padding-top: 16px; border-top: 2px solid #c4b5fd; background: rgba(255,255,255,0.5); padding: 12px 16px; border-radius: 8px;">
                    <p style="color: #6d28d9; margin: 0; font-size: 14px; font-weight: 600;">
                        ✓ Ini adalah akun Anda saat ini
                    </p>
                </div>
            @endif
        </div>
    @else
        <div style="background: linear-gradient(135deg, #fef3c7 0%, #fcd34d 100%); border: 2px solid #f59e0b; border-radius: 10px; padding: 20px; margin-bottom: 20px;">
            <div style="color: #92400e; margin-bottom: 12px;">
                <strong style="font-size: 16px;">⚠️ Belum Ada Admin</strong>
            </div>
            <p style="color: #92400e; margin: 0; margin-bottom: 16px; line-height: 1.5;">
                Sistem belum memiliki akun admin. Buat akun admin terlebih dahulu untuk mengelola perpustakaan.
            </p>
            <a href="/admin/admin/create" class="btn btn-primary">➕ Buat Admin Pertama</a>
        </div>
    @endif
</div>

<div class="card">
    <h3>ℹ️ Informasi Sistem</h3>
    <ul style="padding-left: 24px; color: #475569; line-height: 2; margin: 0;">
        <li>✓ Hanya ada 1 akun admin dalam sistem</li>
        <li>✓ Admin memiliki akses penuh untuk mengelola buku, user, dan peminjaman</li>
        <li>✓ Tidak bisa menghapus atau menonaktifkan akun admin yang sudah terdaftar</li>
        <li>✓ Untuk mengganti admin, hubungi administrator teknis</li>
    </ul>
</div>
@endsection
