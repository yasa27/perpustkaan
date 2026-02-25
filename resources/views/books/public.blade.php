<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koleksi Buku - Perpustakaan Digital</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .book-card {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .book-cover {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 10px;
        }
        .header-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            padding: 24px;
            color: white;
            box-shadow: 0 8px 16px rgba(102, 126, 234, 0.3);
        }
        .header-card h1 {
            font-size: 28px;
            font-weight: bold;
            margin: 0 0 8px 0;
        }
        .auth-buttons {
            display: flex;
            gap: 12px;
        }
        .btn-login {
            background: white;
            color: #667eea;
            font-weight: 600;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .btn-register {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            font-weight: 600;
            border: 2px solid white;
            padding: 8px 24px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-register:hover {
            background: white;
            color: #667eea;
        }
        .info-banner {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 16px;
            border-radius: 8px;
            margin: 24px auto;
            max-width: 7xl;
        }
        .info-banner strong {
            color: #d97706;
        }
    </style>
</head>
<body class="bg-gray-50">

<!-- Header -->
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="header-card">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <h1>📚 Perpustakaan Digital</h1>
                <p style="font-size: 14px; opacity: 0.95; margin-bottom: 16px;">
                    Jelajahi koleksi buku kami yang lengkap dan menarik
                </p>
            </div>
            <div class="auth-buttons">
                <a href="/login" class="btn-login">🔐 Login</a>
                <a href="/register" class="btn-register">📝 Daftar</a>
            </div>
        </div>
    </div>
</div>

<!-- Search Bar -->
<div class="max-w-7xl mx-auto px-4 mt-6">
    <form method="GET" action="/" class="flex flex-col gap-3">
        <div class="flex gap-2">
            <input type="text" name="q" value="{{ $q ?? request('q') }}" placeholder="Cari judul, pengarang, penerbit, atau ISBN"
                       class="w-full md:w-1/2 px-4 py-2 border rounded hover:bg-white-100" />
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Cari</button>
            @if((isset($q) && $q) || request('q'))
                <a href="/" class="ml-2 px-4 py-2 rounded border text-gray-700">Reset</a>
            @endif
        </div>
        
        <div class="flex gap-2 items-center">
            <label for="kategori_id" class="font-semibold text-gray-700">Filter Kategori:</label>
            <select name="kategori_id" id="kategori_id" class="px-4 py-2 border rounded" onchange="this.form.submit()">
                <option value="">📚 Semua Kategori</option>
                @foreach($kategoris as $kat)
                    <option value="{{ $kat->id }}" {{ (isset($kategori_id) && $kategori_id == $kat->id) || request('kategori_id') == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

        @if((isset($q) && $q) || request('q'))
            <div class="max-w-3xl mx-auto mt-3 text-sm text-gray-600">
                <span>Hasil pencarian untuk: <strong>"{{ $q ?? request('q') }}"</strong></span>
                <span class="ml-3 text-gray-500">• Menampilkan {{ $bukus->count() }} hasil</span>
            </div>
    @endif
</div>

<!-- Info Banner -->
<div class="info-banner">
    <strong>💡 Catatan:</strong> Anda sedang melihat sebagai tamu. Silakan <strong>Login atau Daftar</strong> untuk meminjam buku dari koleksi kami!
</div>

<!-- Koleksi Buku -->
<div class="max-w-7xl mx-auto px-4 pb-12">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">📖 Koleksi Buku Kami</h2>
    
    @if ($bukus->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($bukus as $buku)
                <div class="book-card border rounded overflow-hidden bg-white">
                    <div class="book-cover">
                        <div class="text-center">
                            <div class="text-3xl mb-2">📖</div>
                            <div class="text-xs">{{ $buku->judul }}</div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-sm mb-2 line-clamp-2">{{ $buku->judul }}</h3>
                        <p class="text-gray-600 text-xs mb-1">{{ $buku->pengarang }}</p>
                        <p class="text-gray-600 text-xs mb-3">{{ $buku->penerbit }} ({{ $buku->tahun_terbit }})</p>
                        
                        @if ($buku->jumlah_tersedia > 0)
                            <p class="text-green-600 font-semibold text-sm mb-3">
                                ✓ Tersedia ({{ $buku->jumlah_tersedia }}/{{ $buku->jumlah_total }})
                            </p>
                        @else
                            <p class="text-red-600 font-semibold text-sm mb-3">
                                ✗ Tidak Tersedia
                            </p>
                        @endif
                        
                        <div class="border-t pt-3">
                            <p class="text-gray-600 text-xs mb-3">Untuk meminjam buku ini, Anda perlu:</p>
                            <a href="/login" class="w-full block text-center bg-blue-500 text-white py-2 rounded text-sm hover:bg-blue-600 transition">
                                🔐 Login untuk Pinjam
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600 text-center py-8">Belum ada buku dalam koleksi perpustakaan.</p>
    @endif
</div>

<!-- Footer Info -->
<div class="bg-white border-t">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div>
                <div class="text-3xl mb-2">📚</div>
                <h3 class="font-bold mb-2">Koleksi Lengkap</h3>
                <p class="text-gray-600 text-sm">Ribuan buku dari berbagai genre</p>
            </div>
            <div>
                <div class="text-3xl mb-2">⚡</div>
                <h3 class="font-bold mb-2">Proses Cepat</h3>
                <p class="text-gray-600 text-sm">Daftar dan mulai pinjam dalam hitungan menit</p>
            </div>
            <div>
                <div class="text-3xl mb-2">🎁</div>
                <h3 class="font-bold mb-2">Gratis</h3>
                <p class="text-gray-600 text-sm">Layanan perpustakaan tanpa biaya admin</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
