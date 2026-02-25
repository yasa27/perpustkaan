<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam Buku - {{ $buku->judul }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .gradient-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 24px;
            border-radius: 12px;
        }
        .book-detail {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .book-cover {
            width: 100%;
            height: 300px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            text-align: center;
            margin-bottom: 24px;
        }
        .info-group {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
        }
        .info-group:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .info-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .info-value {
            color: #4b5563;
            font-size: 16px;
            line-height: 1.6;
        }
        .availability-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
        }
        .availability-available {
            background: #d1fae5;
            color: #065f46;
        }
        .availability-unavailable {
            background: #fee2e2;
            color: #991b1b;
        }
        .terms-section {
            background: #f3f4f6;
            border-left: 4px solid #667eea;
            padding: 16px;
            border-radius: 8px;
            margin: 24px 0;
        }
        .terms-section h4 {
            margin-top: 0;
            color: #667eea;
            font-weight: 600;
        }
        .terms-section ul {
            margin: 0;
            padding-left: 20px;
        }
        .terms-section li {
            margin-bottom: 8px;
            color: #4b5563;
            font-size: 14px;
        }
        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            flex: 1;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(102, 126, 234, 0.4);
        }
        .btn-primary:disabled {
            background: #cbd5e1;
            cursor: not-allowed;
            transform: none;
        }
        .btn-secondary {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }
        .btn-secondary:hover {
            background: #f3f4f6;
        }
        .alert {
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }
        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        .alert-warning {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fcd34d;
        }
        .modal-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 40;
            align-items: center;
            justify-content: center;
        }
        .modal-backdrop.active {
            display: flex;
        }
        .modal {
            background: white;
            border-radius: 12px;
            padding: 32px;
            max-width: 500px;
            width: 90%;
            text-align: center;
        }
        .modal h3 {
            color: #667eea;
            margin-bottom: 16px;
        }
        .modal p {
            color: #4b5563;
            margin-bottom: 24px;
            line-height: 1.6;
        }
        .modal-buttons {
            display: flex;
            gap: 12px;
        }
        .modal-buttons button {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        .modal-btn-confirm {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .modal-btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(102, 126, 234, 0.4);
        }
        .modal-btn-cancel {
            background: #e5e7eb;
            color: #374151;
        }
        .modal-btn-cancel:hover {
            background: #d1d5db;
        }
    </style>
</head>
<body class="bg-gray-50">

<!-- Header -->
<div class="max-w-4xl mx-auto px-4 py-6">
    <div class="gradient-header">
        <a href="/dashboard" style="color: white; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; margin-bottom: 16px;">
            <span>←</span> Kembali ke Dashboard
        </a>
        <h1 style="margin: 0; font-size: 28px;">📚 Detail Buku & Peminjaman</h1>
    </div>
</div>

<!-- Alerts -->
@if ($errors->any())
    <div class="max-w-4xl mx-auto px-4 mt-6">
        @foreach ($errors->all() as $error)
            <div class="alert alert-error">
                <span>⚠️</span>
                <div>{{ $error }}</div>
            </div>
        @endforeach
    </div>
@endif

@if (session('success'))
    <div class="max-w-4xl mx-auto px-4 mt-6">
        <div class="alert alert-success">
            <span>✓</span>
            <div>{{ session('success') }}</div>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="max-w-4xl mx-auto px-4 mt-6">
        <div class="alert alert-error">
            <span>✗</span>
            <div>{{ session('error') }}</div>
        </div>
    </div>
@endif

<!-- Main Content -->
<div class="max-w-5xl mx-auto px-4 pb-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <!-- Book Cover & Quick Info -->
        <div>
            <div class="book-cover">
                <div class="text-center">
                    <div class="text-6xl mb-4">📖</div>
                    <div style="font-size: 18px; line-height: 1.4;">{{ $buku->judul }}</div>
                </div>
            </div>
            <div class="book-detail" style="margin-top: 16px;">
                <div class="info-group">
                    <div class="info-label">Ketersediaan</div>
                    @if ($buku->jumlah_tersedia > 0)
                        <span class="availability-badge availability-available">
                            ✓ Tersedia ({{ $buku->jumlah_tersedia }}/{{ $buku->jumlah_total }})
                        </span>
                    @else
                        <span class="availability-badge availability-unavailable">
                            ✗ Tidak Tersedia
                        </span>
                    @endif
                </div>
            </div>

            <!-- Review Summary -->
            <div class="book-detail" style="margin-top: 16px;">
                <div class="info-label" style="color: #0c4a6e; margin-bottom: 12px;">⭐ Rating & Ulasan</div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 16px; padding-bottom: 16px; border-bottom: 1px solid #e5e7eb;">
                    <div>
                        <div style="font-size: 32px; font-weight: bold; color: #0284c7;">{{ $buku->averageRating() ? round($buku->averageRating(), 1) : '-' }}</div>
                        <div style="font-size: 12px; color: #0c4a6e;">dari 5 bintang</div>
                    </div>
                    <div>
                        <div style="font-size: 32px; font-weight: bold; color: #0284c7;">{{ $buku->reviewCount() }}</div>
                        <div style="font-size: 12px; color: #0c4a6e;">total ulasan</div>
                    </div>
                </div>
                
                @if ($buku->reviewCount() > 0)
                    <div style="font-size: 13px; color: #0c4a6e; margin-bottom: 12px;">
                        <strong>Ulasan dari:</strong>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 8px; max-height: 300px; overflow-y: auto;">
                        @foreach($buku->reviews()->with('user')->get() as $review)
                            <div style="background: #ecf0ff; padding: 10px; border-radius: 6px; font-size: 12px;">
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                                    <strong style="color: #0c4a6e;">{{ $review->user->name }}</strong>
                                    <span style="color: #f59e0b;">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</span>
                                </div>
                                @if($review->review_text)
                                    <div style="color: #4b5563; font-style: italic;">"{{ Str::limit($review->review_text, 80) }}"</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="font-size: 13px; color: #0c4a6e; font-style: italic;">
                        Belum ada ulasan untuk buku ini
                    </div>
                @endif
            </div>
        </div>

        <!-- Book Details & Borrowing Form -->
        <div>
            <div class="book-detail">
                <!-- Title -->
                <h2 style="margin: 0 0 16px 0; color: #667eea; font-size: 22px; font-weight: 600;">
                    {{ $buku->judul }}
                </h2>

                <!-- Quick Info Grid -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #e5e7eb;">
                    <div>
                        <div class="info-label">Pengarang</div>
                        <div class="info-value" style="font-size: 14px;">{{ $buku->pengarang }}</div>
                    </div>
                    <div>
                        <div class="info-label">Penerbit</div>
                        <div class="info-value" style="font-size: 14px;">{{ $buku->penerbit }}</div>
                    </div>
                    <div>
                        <div class="info-label">Tahun Terbit</div>
                        <div class="info-value" style="font-size: 14px;">{{ $buku->tahun_terbit }}</div>
                    </div>
                    <div>
                        <div class="info-label">ISBN</div>
                        <div class="info-value" style="font-size: 14px;">{{ $buku->isbn }}</div>
                    </div>
                </div>

                <!-- Deskripsi Ringkas -->
                <div style="margin-bottom: 20px;">
                    <div class="info-label">Deskripsi</div>
                    <div class="info-value" style="font-size: 14px; line-height: 1.5;">{{ Str::limit($buku->deskripsi, 150) }}</div>
                </div>

                <!-- Stok Info -->
                <div style="background: #f9fafb; padding: 12px; border-radius: 8px; margin-bottom: 20px; border-left: 3px solid #667eea;">
                    <div class="info-label" style="margin-bottom: 6px;">Informasi Stok</div>
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; font-size: 13px;">
                        <div>Total: <strong>{{ $buku->jumlah_total }}</strong></div>
                        <div>Tersedia: <strong style="color: #10b981;">{{ $buku->jumlah_tersedia }}</strong></div>
                        <div>Dipinjam: <strong style="color: #f59e0b;">{{ $buku->jumlah_total - $buku->jumlah_tersedia }}</strong></div>
                    </div>
                </div>

                <!-- Duration Selector -->
                @if ($buku->jumlah_tersedia > 0)
                    <form id="borrowForm" method="POST" action="/pinjam/{{ $buku->id }}">
                        @csrf
                        <div style="margin-bottom: 20px;">
                            <label class="info-label" for="tanggal_kembali_target">📅 Tentukan Tanggal Pengembalian</label>
                            <input type="date" name="tanggal_kembali_target" id="tanggal_kembali_target" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" onchange="updateDurationInfo()" />
                        </div>

                        <!-- Duration Info -->
                        <div style="background: #f0f4ff; padding: 12px; border-radius: 8px; margin-bottom: 20px; border-left: 3px solid #667eea;">
                            <div class="info-label" style="margin-bottom: 6px;">ℹ️ Informasi Peminjaman</div>
                            <div style="font-size: 14px; color: #667eea;">
                                <div style="margin-bottom: 6px;">📅 Tanggal Pinjam: <strong>{{ now()->format('d M Y') }}</strong></div>
                                <div>📅 Tanggal Kembali: <strong id="returnDateDisplay">Pilih tanggal</strong></div>
                                <div style="margin-top: 8px; padding-top: 8px; border-top: 1px solid #d0d8ff; font-weight: 600;">
                                    Durasi: <strong id="durationDisplay">-</strong> hari
                                </div>
                            </div>
                        </div>

                        <!-- Ketentuan Singkat -->
                        <div style="background: #fef3c7; padding: 12px; border-radius: 8px; margin-bottom: 20px; border-left: 3px solid #f59e0b;">
                            <div class="info-label" style="margin-bottom: 6px; color: #92400e;">⚠️ Perhatian</div>
                            <ul style="margin: 0; padding-left: 16px; font-size: 13px; color: #92400e;">
                                <li>Jika terlambat, status akan berubah overdue</li>
                                <li>Hanya 1 eksemplar per buku</li>
                            </ul>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <a href="/dashboard" class="btn btn-secondary">Batal</a>
                            <button type="submit" id="submitBtn" class="btn btn-primary">
                                ✓ Pinjam Buku
                            </button>
                        </div>
                    </form>
                @else
                    <div class="action-buttons">
                        <a href="/dashboard" class="btn btn-secondary">Kembali</a>
                        <button class="btn btn-primary" disabled>
                            ✗ Tidak Tersedia
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Return Confirmation Modal -->
<div class="modal-backdrop" id="returnModal">
    <div class="modal">
        <h3>Konfirmasi Peminjaman</h3>
        <p>
            Anda akan meminjam buku <strong id="confirmBookTitle"></strong><br>
            <span id="confirmDuration"></span>
        </p>
        <div class="modal-buttons">
            <button class="modal-btn-cancel" onclick="closeConfirmModal()">Batal</button>
            <button id="confirmSubmitBtn" class="modal-btn-confirm" onclick="document.getElementById('borrowForm').submit()">
                Ya, Pinjam Buku
            </button>
        </div>
    </div>
</div>

<script>
    function updateDurationInfo() {
        const tanggalKembali = document.getElementById('tanggal_kembali_target').value;
        const returnDateDisplay = document.getElementById('returnDateDisplay');
        const durationDisplay = document.getElementById('durationDisplay');
        const submitBtn = document.getElementById('submitBtn');
        
        if (!tanggalKembali) {
            returnDateDisplay.textContent = 'Pilih tanggal';
            durationDisplay.textContent = '-';
            submitBtn.disabled = true;
            return;
        }

        submitBtn.disabled = false;
        
        // Parse tanggal
        const returnDate = new Date(tanggalKembali + 'T00:00:00');
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        
        // Validasi: tanggal kembali harus lebih besar dari hari ini
        if (returnDate <= today) {
            returnDateDisplay.textContent = '⚠️ Tanggal harus lebih besar dari hari ini';
            returnDateDisplay.style.color = '#dc2626';
            durationDisplay.textContent = '-';
            submitBtn.disabled = true;
            return;
        }

        returnDateDisplay.style.color = '#667eea';
        
        // Format tanggal
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        const formattedDate = returnDate.toLocaleDateString('id-ID', options);
        returnDateDisplay.textContent = formattedDate;
        
        // Hitung durasi
        const duration = Math.ceil((returnDate - today) / (1000 * 60 * 60 * 24));
        durationDisplay.textContent = duration;
    }

    // Set minimum date to tomorrow
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date();
        today.setDate(today.getDate() + 1);
        const minDate = today.toISOString().split('T')[0];
        document.getElementById('tanggal_kembali_target').min = minDate;
    });

    // Form submission handling
    document.getElementById('borrowForm').addEventListener('submit', function(e) {
        const tanggalKembali = document.getElementById('tanggal_kembali_target').value;
        if (!tanggalKembali) {
            e.preventDefault();
            alert('Silakan pilih tanggal pengembalian');
        }
    });
</script>

</body>
</html>
