<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Perpustakaan Digital</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html {
            scroll-behavior: smooth;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background: #f8fafc;
            color: #334155;
        }
        .admin-container {
            display: grid;
            grid-template-columns: 260px 1fr;
            min-height: 100vh;
        }
        .sidebar {
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 0;
            position: fixed;
            width: 260px;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 2px 0 12px rgba(0, 0, 0, 0.15);
        }
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }
        .sidebar-header {
            padding: 16px 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            margin-bottom: 20px;
        }
        .sidebar-header h2 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 2px;
            letter-spacing: -0.5px;
        }
        .sidebar-header p {
            font-size: 12px;
            opacity: 0.85;
            font-weight: 500;
        }
        .sidebar-nav {
            padding: 0 8px;
        }
        .sidebar-nav a, .sidebar-nav button {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            margin-bottom: 6px;
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.25s ease;
            border: none;
            background: none;
            cursor: pointer;
            font-size: 14px;
            width: 100%;
            text-align: left;
            font-weight: 500;
        }
        .sidebar-nav a:hover, .sidebar-nav button:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }
        .sidebar-nav a.active {
            background: rgba(255, 255, 255, 0.25);
            color: white;
            font-weight: 600;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.2);
        }
        .sidebar-nav hr {
            border: none;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin: 16px 0;
        }
        .main-content {
            margin-left: 260px;
            padding: 28px;
            width: 79vw;
        }
        .top-bar {
            background: white;
            padding: 20px 24px;
            border-radius: 12px;
            margin-bottom: 28px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #e2e8f0;
        }
        .top-bar h1 {
            font-size: 26px;
            font-weight: 700;
            color: #1e293b;
            letter-spacing: -0.5px;
        }
        .user-menu {
            display: flex;
            align-items: center;
            gap: 16px;
            font-weight: 500;
            color: #64748b;
        }
        .user-menu a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.25s;
            padding: 6px 12px;
            border-radius: 6px;
        }
        .user-menu a:hover {
            color: #764ba2;
            background: #f1f5f9;
        }
        .btn {
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(102, 126, 234, 0.35);
        }
        .btn-primary:active {
            transform: translateY(0);
        }
        .btn-secondary {
            background: #e2e8f0;
            color: #334155;
            border: 1px solid #cbd5e1;
        }
        .btn-secondary:hover {
            background: #cbd5e1;
        }
        .btn-danger {
            background: #fecaca;
            color: #991b1b;
            border: none;
        }
        .btn-danger:hover {
            background: #fca5a5;
            box-shadow: 0 2px 8px rgba(220, 38, 38, 0.2);
        }
        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
        }
        .alert {
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 24px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
            border-left: 4px solid;
        }
        .alert-success {
            background: #f0fdf4;
            color: #166534;
            border-color: #22c55e;
        }
        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            border-color: #ef4444;
        }
        .card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            margin-bottom: 24px;
            border: 1px solid #e2e8f0;
            transition: all 0.25s;
        }
        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .card h3 {
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 16px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th {
            background: #f8fafc;
            padding: 14px 16px;
            text-align: left;
            font-weight: 700;
            color: #334155;
            border-bottom: 2px solid #e2e8f0;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .table td {
            padding: 14px 16px;
            border-bottom: 1px solid #e2e8f0;
            color: #475569;
            font-size: 14px;
        }
        .table tr:hover {
            background: #f8fafc;
        }
        .table tbody tr {
            transition: all 0.15s;
        }
        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }
        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }
        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }
        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="password"],
        textarea,
        select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.25s;
            font-family: inherit;
            background: #f8fafc;
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="number"]:focus,
        input[type="password"]:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        textarea {
            resize: vertical;
            min-height: 120px;
        }
        label {
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
            display: block;
            font-size: 14px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group:last-child {
            margin-bottom: 0;
        }
        .error-text {
            color: #dc2626;
            font-size: 12px;
            margin-top: 4px;
            display: block;
        }
        @media (max-width: 768px) {
            .admin-container {
                grid-template-columns: 1fr;
            }
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }
            .main-content {
                margin-left: 0;
                padding: 16px;
            }
            .top-bar {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="sidebar">
            <div class="sidebar-header">
                <h2>⚙️ Admin Panel</h2>
                <p>Perpustakaan Digital</p>
            </div>
            
            <div class="sidebar-nav">
                <a href="/admin/dashboard" class="@if(request()->is('admin/dashboard')) active @endif">
                    📊 Dashboard
                </a>
                <a href="/admin/buku" class="@if(request()->is('admin/buku*')) active @endif">
                    📚 Kelola Buku
                </a>
                <a href="/admin/kategori" class="@if(request()->is('admin/kategori*')) active @endif">
                    🏷️ Kelola Kategori
                </a>
                <a href="/admin/pinjaman" class="@if(request()->is('admin/pinjaman*')) active @endif">
                    📖 Kelola Peminjaman
                </a>
                <a href="/admin/user" class="@if(request()->is('admin/user*')) active @endif">
                    👥 Kelola User
                </a>
                @php
                    $adminCount = \App\Models\User::where('role', 'admin')->count();
                @endphp
                @if($adminCount === 0 || auth()->user()->id === \App\Models\User::where('role', 'admin')->first()?->id)
                    <a href="/admin/admin" class="@if(request()->is('admin/admin*')) active @endif">
                        🔑 Akun Admin
                    </a>
                @endif
                <a href="{{ route('report.index') }}" class="@if(request()->is('admin/laporan')) active @endif">
                    📊 Laporan
                </a>
                <hr style="border: none; border-top: 1px solid rgba(255, 255, 255, 0.1); margin: 24px 0;">
                <a href="/admin/dashboard">
                    ← Ke Admin Dashboard
                </a>
                <form action="/logout" method="POST" style="padding: 0;">
                    @csrf
                    <button type="submit" style="width: 100%; padding: 12px 16px; text-align: left;">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="main-content">
            <div class="top-bar">
                <h1>@yield('title')</h1>
                <div class="user-menu">
                    <span>{{ auth()->user()->name }}</span>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    <span>✓</span>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">
                    <span>✗</span>
                    <div>{{ session('error') }}</div>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</body>
</html>
