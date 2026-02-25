<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }
        
        .collection-section h2 {
            font-size: 16px;
            margin-bottom: 14px;
            color: #333;
        }

        /* Compact grid for many cards per row */
        .compact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 12px;
            align-items: start;
        }

        .compact-grid .book-card {
            border-radius: 8px;
            overflow: hidden;
        }

        .compact-grid .book-cover {
            aspect-ratio: 2 / 3;
            max-height: 180px;
        }

        .compact-grid .book-card-content {
            padding: 6px;
        }

        .compact-grid .book-title { font-size: 11px; }

        @media (min-width: 1600px) {
            .compact-grid { grid-template-columns: repeat(auto-fill, minmax(130px, 1fr)); }
        }
        
        .category-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            color: white;
            margin-bottom: 8px;
        }
        
        .category-badge.fiksi { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .category-badge.nonfiksi { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .category-badge.teknologi { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .category-badge.sejarah { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }
        .category-badge.biografi { background: linear-gradient(135deg, #30cfd0 0%, #330867 100%); }
        .category-badge.default { background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); color: #333; }
        
        .quick-filter {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 16px;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        
        .quick-filter-btn {
            padding: 6px 14px;
            border: 2px solid #e0e0e0;
            background: white;
            border-radius: 20px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .quick-filter-btn:hover {
            border-color: #667eea;
            color: #667eea;
        }
        
        .quick-filter-btn.active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }
        
        .featured-section {
            background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 16px;
            border-left: 4px solid #667eea;
        }
        
        .featured-section h3 {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #333;
        }

        /* Flashy ring & ribbon */
        .cover-ring { position: absolute; inset: 8px; border-radius: 10px; pointer-events: none; }
        .cover-ring::after { content: ''; position: absolute; inset: 0; border-radius: 8px; padding: 3px; background: linear-gradient(45deg, rgba(255,255,255,0.06), rgba(102,126,234,0.08)); box-shadow: 0 6px 18px rgba(102,126,234,0.08) inset; }
        .ribbon-new { position: absolute; left: 8px; top: 8px; background: linear-gradient(90deg,#ff8a00,#e52e71); color: white; padding: 6px 8px; border-radius: 6px; font-size: 11px; font-weight: 700; box-shadow: 0 6px 12px rgba(0,0,0,0.12); }

        .star-row { display:flex; gap:4px; align-items:center; margin-bottom:6px; }
        .star { color: #f6c23e; font-size: 12px; opacity: .95; }
        .meta-row { display:flex; justify-content:space-between; align-items:center; gap:8px; }
        
        .featured-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
        }
        
        .book-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .book-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(102, 126, 234, 0.2);
        }
        
        .book-card-content {
            padding: 8px;
            background: white;
            backdrop-filter: blur(6px);
            background: linear-gradient(180deg, rgba(255,255,255,0.65), rgba(255,255,255,0.5));
            border-radius: 0 0 8px 8px;
        }
        
        .book-title {
            font-weight: bold;
            font-size: 11px;
            margin-bottom: 4px;
            line-height: 1.2;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .book-author {
            color: #666;
            font-size: 11px;
            margin-bottom: 2px;
        }
        
        .book-publisher {
            color: #999;
            font-size: 10px;
            margin-bottom: 6px;
        }
        
        .book-status {
            font-weight: 600;
            font-size: 11px;
            margin-bottom: 8px;
        }
        
        .book-status.available {
            color: #28a745;
        }
        
        .book-status.unavailable {
            color: #dc3545;
        }
        
        .book-btn {
            width: 100%;
            padding: 8px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .book-btn-available {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .book-btn-available:hover {
            background: linear-gradient(135deg, #5568d3 0%, #6a3d8a 100%);
        }
        
        .book-btn-disabled {
            background: #e9ecef;
            color: #6c757d;
            cursor: not-allowed;
        }
        
        .book-cover {
            width: 100%;
            aspect-ratio: 2 / 3; /* lebih tinggi (portrait) untuk tampilan pinjam */
            max-height: 480px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 8px;
            display: block;
            position: relative;
            overflow: hidden;
        }

        .book-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* ensures image fills and crops nicely */
            display: block;
        }

        .cover-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
            background: linear-gradient(180deg, rgba(0,0,0,0.15) 20%, rgba(0,0,0,0.45) 100%);
            opacity: 0;
            transition: opacity 0.16s ease-in-out, transform 0.18s ease-in-out;
            transform: translateY(6px);
        }

        .book-cover:hover .cover-overlay {
            opacity: 1;
            transform: translateY(0);
        }

        .overlay-title {
            color: #fff;
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 4px;
            line-height: 1.2;
        }

        .overlay-sub {
            color: #e6e6e6;
            font-size: 11px;
            margin-bottom: 8px;
        }

        .overlay-btn {
            background: rgba(255,255,255,0.12);
            color: #fff;
            border: 1px solid rgba(255,255,255,0.18);
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 12px;
            text-decoration: none;
            display: inline-block;
        }

        .overlay-btn.primary {
            background: linear-gradient(90deg,#4f46e5,#7c3aed);
            border: none;
            color: #fff;
        }

        .overlay-btn.outline {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.18);
            color: #fff;
        }

        .book-btn-outline {
            padding: 6px 8px;
            border-radius: 6px;
            border: 1px solid #e6e6e6;
            background: #fff;
            color: #333;
            text-decoration: none;
            font-size: 12px;
        }

        .compact-card {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 6px 18px rgba(15,23,42,0.04);
            transition: transform 0.18s ease, box-shadow 0.18s ease;
        }

        .compact-card:hover { box-shadow: 0 14px 32px rgba(15,23,42,0.08); transform: translateY(-6px); }
        
        .book-cover-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        
        .header-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            padding: 20px;
            color: white;
            box-shadow: 0 8px 16px rgba(102, 126, 234, 0.3);
            margin-bottom: 20px;
        }
        
        .header-card h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        
        .header-card .user-info {
            font-size: 13px;
            opacity: 0.95;
            margin-bottom: 12px;
        }
        
        .stats-row {
            display: flex;
            gap: 16px;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        
        .stat-item {
            background: rgba(255, 255, 255, 0.15);
            padding: 20px 55px;
            border-radius: 6px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
            min-width: fit-content;
        }
        
        .stat-item .stat-number {
            font-size: 16px;
            font-weight: bold;
            display: block;
            line-height: 1;
        }
        
        .stat-item .stat-label {
            font-size: 10px;
            opacity: 0.85;
            margin-top: 2px;
            white-space: nowrap;
        }
        
        .search-section {
            background: white;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 14px;
        }
        
        .search-controls {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            align-items: center;
        }
        
        .search-controls input {
            flex: 1;
            min-width: 200px;
            padding: 8px 12px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            font-size: 13px;
        }
        
        .search-controls button,
        .search-controls a,
        .search-controls select {
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 13px;
            border: none;
            cursor: pointer;
            white-space: nowrap;
        }
        
        .search-controls button {
            background: #667eea;
            color: white;
            font-weight: 600;
        }
        
        .search-controls button:hover {
            background: #5568d3;
        }
        
        .search-controls a {
            background: #f0f0f0;
            color: #333;
            text-decoration: none;
            display: inline-block;
        }
        
        .search-controls select {
            background: white;
            border: 1px solid #e0e0e0;
            color: #333;
        }
        
        .logout-btn {
            background: white;
            color: #667eea;
            font-weight: 600;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 13px;
        }
        
        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .nav-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            position: relative;
        }
        
        .profile-dropdown {
            position: relative;
        }
        
        .profile-btn {
            padding: 8px 14px;
            background: white;
            color: #667eea;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 13px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .profile-btn:hover {
            background: #f0f0f0;
        }
        
        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            min-width: 180px;
            z-index: 1000;
            margin-top: 8px;
            display: none;
            overflow: hidden;
        }
        
        .dropdown-menu.active {
            display: block;
        }
        
        .dropdown-menu a,
        .dropdown-menu form {
            display: block;
            width: 100%;
            margin: 0;
            padding: 0;
            text-align: left;
        }
        
        .dropdown-menu a {
            padding: 12px 16px;
            color: #333;
            text-decoration: none;
            transition: all 0.2s;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .dropdown-menu a:hover {
            background: #f8f9fa;
            color: #667eea;
        }
        
        .dropdown-menu a:last-child {
            border-bottom: none;
        }
        
        .dropdown-logout {
            padding: 12px 16px;
            color: #dc3545;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
            background: none;
            cursor: pointer;
            width: 100%;
            text-align: left;
            font-size: 13px;
            font-weight: 500;
        }
        
        .dropdown-logout:hover {
            background: #f8f9fa;
            color: #c82333;
        }
        
        .nav-buttons a {
            padding: 8px 14px;
            background: white;
            color: #667eea;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 13px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .nav-buttons a:hover {
            background: #f0f0f0;
        }
        
        .collection-section {
            background: white;
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        
        .collection-section h2 {
            font-size: 16px;
            margin-bottom: 14px;
            color: #333;
        }
        
        .alert {
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 14px;
            font-size: 13px;
            border-left: 4px solid;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left-color: #28a745;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-left-color: #dc3545;
        }
    </style>
</head>
<body class="bg-gray-50">

<!-- Header Premium Card -->
<div class="max-w-7xl mx-auto px-4" style="padding-top: 12px; padding-bottom: 12px;">
    <div class="header-card">
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 16px;">
            <div style="flex: 0 0 auto;">
                <h1>📚 Perpustakaan Digital</h1>
                <div class="user-info">Selamat datang, <strong>{{ auth()->user()->name }}</strong></div>
            </div>

            <div class="stats-row">
                <div class="stat-item">
                    <span class="stat-number">{{ $pinjaman->count() }}</span>
                    <span class="stat-label">📖 Dipinjam</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $pinjaman->where('tanggal_kembali_target', '<', now())->count() }}</span>
                    <span class="stat-label">⏰ Belum Kembali</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $bukus->where('jumlah_tersedia', '>', 0)->count() }}</span>
                    <span class="stat-label">✅ Tersedia</span>
                </div>
            </div>

            <div class="nav-buttons">
                <a href="{{ route('my.pinjaman') }}" style="padding: 8px 14px; background: white; color: #667eea; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 13px; border: none; cursor: pointer; transition: all 0.3s;">📚 Pinjaman</a>
                <div class="profile-dropdown">
                    <button class="profile-btn" onclick="toggleProfileMenu()">👤 {{ auth()->user()->name }} ▼</button>
                    <div class="dropdown-menu" id="profileMenu">
                        <a href="{{ route('profile.edit') }}">⚙️ Edit Profil</a>
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="dropdown-logout">🚪 Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Alert Messages -->
@if (session('success'))
    <div class="max-w-7xl mx-auto px-4">
        <div class="alert alert-success">
            ✓ {{ session('success') }}
        </div>
    </div>
@endif

@if (session('error'))
    <div class="max-w-7xl mx-auto px-4">
        <div class="alert alert-error">
            ✗ {{ session('error') }}
        </div>
    </div>
@endif

<!-- Search & Filter Section -->
<div class="max-w-7xl mx-auto px-4">
    <div class="search-section">
        <form method="GET" action="{{ route('dashboard') }}" id="filterForm">
            <div class="search-controls">
                <input type="text" name="q" value="{{ $q ?? request('q') }}" placeholder="🔍 Cari judul, pengarang, penerbit..." />
                <button type="submit">Cari</button>
                @if((isset($q) && $q) || request('q'))
                    <a href="{{ route('dashboard') }}">Reset</a>
                @endif
                
                <select name="kategori_id" onchange="document.getElementById('filterForm').submit()">
                    <option value="">📚 Semua Kategori</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}" {{ (isset($kategori_id) && $kategori_id == $kat->id) || request('kategori_id') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- Quick Filter Buttons -->
            <div class="quick-filter">
                <a href="{{ route('dashboard') }}" class="quick-filter-btn {{ !request('kategori_id') ? 'active' : '' }}">
                    📚 Semua
                </a>
                @foreach($kategoris->take(4) as $kat)
                    <a href="{{ route('dashboard', ['kategori_id' => $kat->id]) }}" 
                       class="quick-filter-btn {{ request('kategori_id') == $kat->id ? 'active' : '' }}">
                        {{ $kat->nama }}
                    </a>
                @endforeach
            </div>
        </form>
    </div>
</div>

<!-- Koleksi Buku Perpustakaan -->
<div class="max-w-7xl mx-auto px-4" style="padding-top: 12px; padding-bottom: 24px;">
    <div class="collection-section">
        <!-- Featured Books Section -->
        
        <!-- All Books Section -->
        <h2>📚 SEMUA KOLEKSI BUKU</h2>
        
        @if ($bukus->count() > 0)
            <div class="compact-grid">
                @forelse($bukus->take(4) as $buku)
                    <div class="book-card compact-card">
                        <div class="book-cover">
                            @if($buku->cover_image)
                                <img src="/{{ $buku->cover_image }}" alt="{{ $buku->judul }}">
                            @else
                                <div class="book-cover-placeholder">
                                    <div style="font-size: 20px;">📖</div>
                                </div>
                            @endif

                            @if(isset($buku->created_at) && $buku->created_at->gt(\Carbon\Carbon::now()->subDays(30)))
                                <div class="ribbon-new">BARU</div>
                            @endif

                            <div style="position:absolute; left:8px; bottom:8px;">
                                @if($buku->kategori)
                                    <div class="category-badge {{ strtolower(str_replace([' ', '-', '&'], '', $buku->kategori->nama)) }}">
                                        {{ $buku->kategori->nama }}
                                    </div>
                                @endif
                            </div>

                            <div class="cover-overlay">
                                <div style="text-align:center; width:100%;">
                                    <div class="overlay-title ">{{ \Illuminate\Support\Str::limit($buku->judul, 40) }}</div>
                                    <div class="overlay-sub">{{ $buku->pengarang }}</div>
                                    <div style="display:flex; gap:8px; justify-content:center; margin-top:8px;">
                                        @if ($buku->jumlah_tersedia > 0)
                                            <a href="{{ route('pinjam-page', $buku->id) }}" class="overlay-btn primary">Pinjam</a>
                                        @else
                                            <button class="overlay-btn" disabled style="opacity:0.8; cursor:not-allowed;">Tidak tersedia</button>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="book-card-content">
                            <h3 class="book-title">{{ \Illuminate\Support\Str::limit($buku->judul, 60) }}</h3>
                            <div class="meta-row" style="margin-top:6px;">
                                <div class="book-author">{{ $buku->pengarang }}</div>
                                <div class="star-row"><span class="star">★ ★ ★ ★ ☆</span></div>
                            </div>

                            <div style="margin-top:8px; display:flex; justify-content:space-between; align-items:center; gap:8px;">
                                <div class="book-status {{ $buku->jumlah_tersedia>0 ? 'available' : 'unavailable' }}" style="font-size:12px;">
                                    {{ $buku->jumlah_tersedia>0 ? '✓ Tersedia' : '✗ Tidak tersedia' }}
                                </div>
                                <a href="{{ route('pinjam-page', $buku->id) }}" class="book-btn-outline">Detail</a>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        @else
            <p style="color: #999; text-align: center; padding: 32px 0; font-size: 14px;">Belum ada buku dalam koleksi perpustakaan.</p>
        @endif
    </div>
</div>

<script>
    function toggleProfileMenu() {
        const menu = document.getElementById('profileMenu');
        menu.classList.toggle('active');
    }

    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        const profileDropdown = document.querySelector('.profile-dropdown');
        if (!profileDropdown.contains(event.target)) {
            document.getElementById('profileMenu').classList.remove('active');
        }
    });
</script>

</body>
</html>
