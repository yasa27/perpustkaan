@extends('admin.layout')

@section('title', 'Kelola User')

@section('content')
<div class="card">
    <div style="display:flex; justify-content: flex-end; margin-bottom: 12px;">
        <a href="/admin/user/create" class="btn btn-primary">➕ Tambah User</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 20%;">Nama</th>
                <th style="width: 25%;">Email</th>
                <th style="width: 12%;">Pinjaman</th>
                <th style="width: 10%;">Ulasan</th>
                <th style="width: 15%;">Terdaftar</th>
                <th style="width: 13%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $user->name }}</strong></td>
                    <td><code style="background: #f1f5f9; padding: 3px 6px; border-radius: 4px; font-size: 12px;">{{ $user->email }}</code></td>
                    <td><span class="badge badge-success">{{ $user->pinjaman()->count() }}</span></td>
                    <td><span class="badge badge-warning">{{ $user->reviews()->count() }}</span></td>
                    <td><small>{{ $user->created_at->format('d M Y') }}</small></td>
                    <td>
                        <div class="action-buttons">
                            <a href="/admin/user/{{ $user->id }}" class="btn btn-secondary btn-sm">👁️ Detail</a>
                            <form action="/admin/user/{{ $user->id }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">🗑️ Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 40px; color: #94a3b8;">
                        <div style="font-size: 32px; margin-bottom: 8px;">👫</div>
                        Belum ada user
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($users->hasPages())
        <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #e2e8f0;">
            {{ $users->links() }}
        </div>
    @endif
</div>
@endsection
