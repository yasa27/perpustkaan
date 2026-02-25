<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman - Perpustakaan Digital</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .gradient-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 24px;
        }
        .gradient-header h1 {
            margin: 0;
            font-size: 28px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .gradient-header p {
            margin: 8px 0 0 0;
            opacity: 0.95;
            font-size: 14px;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .stat-number {
            font-size: 32px;
            font-weight: bold;
            color: #667eea;
            margin: 8px 0;
        }
        .stat-label {
            font-size: 14px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .loan-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 16px;
            transition: box-shadow 0.3s;
        }
        .loan-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }
        .loan-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 16px;
            display: flex;
            justify-content: space-between;
            align-items: start;
        }
        .loan-header h3 {
            margin: 0;
            font-size: 18px;
            flex: 1;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }
        .status-dipinjam {
            background: #fef3c7;
            color: #92400e;
        }
        .status-dikembalikan {
            background: #d1fae5;
            color: #065f46;
        }
        .loan-body {
            padding: 20px;
        }
        .loan-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 16px;
            margin-bottom: 16px;
        }
        .detail-item {
            border-left: 3px solid #667eea;
            padding-left: 12px;
        }
        .detail-label {
            font-size: 12px;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }
        .detail-value {
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
        }
        .detail-value.date {
            font-size: 14px;
        }
        .book-info {
            background: #f9fafb;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 16px;
            border-left: 3px solid #667eea;
        }
        .book-info p {
            margin: 0;
            font-size: 14px;
            color: #4b5563;
        }
        .book-info strong {
            display: block;
            font-size: 16px;
            color: #1f2937;
            margin-bottom: 4px;
        }
        .loan-actions {
            display: flex;
            gap: 12px;
            padding-top: 16px;
            border-top: 1px solid #e5e7eb;
        }
        .btn {
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            flex: 1;
            text-align: center;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(102, 126, 234, 0.4);
        }
        .btn:disabled {
            background: #d1d5db;
            cursor: not-allowed;
            opacity: 0.6;
            transform: none;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }
        .empty-state-icon {
            font-size: 64px;
            margin-bottom: 16px;
        }
        .empty-state h3 {
            font-size: 20px;
            color: #1f2937;
            margin-bottom: 8px;
        }
        .empty-state p {
            color: #6b7280;
            margin-bottom: 24px;
        }
        .filter-tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }
        .filter-tab {
            padding: 8px 16px;
            border: 2px solid #e5e7eb;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
            color: #6b7280;
        }
        .filter-tab:hover {
            border-color: #667eea;
            color: #667eea;
        }
        .filter-tab.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: #667eea;
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
        .days-left {
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 4px;
            display: inline-block;
            margin-top: 4px;
        }
        .days-left.danger {
            background: #fee2e2;
            color: #991b1b;
        }
        .days-left.warning {
            background: #fef3c7;
            color: #92400e;
        }
        .days-left.success {
            background: #d1fae5;
            color: #065f46;
        }
    </style>
</head>
<body class="bg-gray-50">

<!-- Header -->
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="gradient-header">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <h1>📚 Riwayat Peminjaman</h1>
                <p>Kelola dan pantau semua peminjaman buku Anda</p>
            </div>
            <a href="/dashboard" style="color: white; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 8px;">
                ← Kembali
            </a>
        </div>
    </div>
</div>

<!-- Stats -->
<div class="max-w-7xl mx-auto px-4 mt-6">
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">📖 Total Pinjaman</div>
            <div class="stat-number">{{ count($loans) }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">⏳ Sedang Dipinjam</div>
            <div class="stat-number">{{ count($loans->where('status', 'dipinjam')) }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">✓ Sudah Dikembalikan</div>
            <div class="stat-number">{{ count($loans->where('status', 'dikembalikan')) }}</div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 pb-12">
    @if (count($loans) > 0)
        <!-- Filter Tabs -->
        <div class="filter-tabs">
            <button class="filter-tab active" onclick="filterLoans('all')">Semua</button>
            <button class="filter-tab" onclick="filterLoans('dipinjam')">Sedang Dipinjam</button>
            <button class="filter-tab" onclick="filterLoans('dikembalikan')">Sudah Dikembalikan</button>
        </div>

        <!-- Loans List -->
        <div id="loansContainer">
            @foreach ($loans as $loan)
                <div class="loan-card" data-status="{{ $loan->status }}">
                    <div class="loan-header">
                        <h3>{{ $loan->buku->judul }}</h3>
                        <span class="status-badge status-{{ $loan->status }}">
                            @if ($loan->status === 'dipinjam')
                                ⏳ Sedang Dipinjam
                            @else
                                ✓ Dikembalikan
                            @endif
                        </span>
                    </div>

                    <div class="loan-body">
                        <!-- Book Info - Kompak -->
                        <div class="book-info">
                            <strong>{{ $loan->buku->judul }}</strong>
                            <p>{{ $loan->buku->pengarang }} • {{ $loan->buku->penerbit }} ({{ $loan->buku->tahun_terbit }})</p>
                        </div>

                        <!-- Loan Details -->
                        <div class="loan-details">
                            <div class="detail-item">
                                <div class="detail-label">📅 Tanggal Pinjam</div>
                                <div class="detail-value date">{{ $loan->tanggal_pinjam->format('d M Y') }}</div>
                            </div>

                            @if ($loan->status === 'dipinjam')
                                <div class="detail-item">
                                    <div class="detail-label">🗓️ Target Kembali</div>
                                    <div class="detail-value date">{{ $loan->tanggal_kembali_target->format('d M Y') }}</div>
                                    @php
                                        $days = (int)now()->diffInDays($loan->tanggal_kembali_target);
                                        $statusClass = $loan->tanggal_kembali_target->isPast()
                                            ? 'danger'
                                            : ($days <= 2 ? 'warning' : 'success');
                                    @endphp
                                    @if ($loan->tanggal_kembali_target->isPast())
                                        <span class="days-left danger">⚠️ Terlambat {{ abs($days) }} hari</span>
                                    @else
                                        <span class="days-left {{ $statusClass }}">✓ {{ $days }} hari lagi</span>
                                    @endif
                                </div>
                            @endif

                            @if ($loan->status === 'dikembalikan')
                                <div class="detail-item">
                                    <div class="detail-label">✓ Tanggal Kembali</div>
                                    <div class="detail-value date">{{ $loan->tanggal_kembali_aktual->format('d M Y') }}</div>
                                </div>
                            @endif
                        </div>

                        <!-- Actions -->
                        @if ($loan->status === 'dipinjam')
                            <div class="loan-actions">
                                <button class="btn btn-primary" onclick="openReturnModal({{ $loan->id }}, '{{ $loan->buku->judul }}')">
                                    ✓ Kembalikan Buku
                                </button>
                            </div>
                        @else
                            @php
                                $userReview = $loan->review;
                            @endphp
                            <div style="padding-top: 16px; border-top: 1px solid #e5e7eb;">
                                <p style="color: #6b7280; margin: 0 0 12px 0; font-size: 14px;">
                                    ✓ Buku telah dikembalikan pada {{ $loan->tanggal_kembali_aktual->format('d M Y H:i') }}
                                </p>
                                @if($userReview)
                                    <div style="background: #fef3c7; border: 1px solid #fcd34d; border-radius: 8px; padding: 12px; margin-bottom: 12px;">
                                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                                            <span style="font-size: 16px;">{{ str_repeat('★', $userReview->rating) }}{{ str_repeat('☆', 5 - $userReview->rating) }}</span>
                                            <span style="font-weight: 600; color: #92400e;">{{ $userReview->rating }}/5</span>
                                        </div>
                                        @if($userReview->review_text)
                                            <p style="color: #78350f; margin: 0; font-size: 14px; font-style: italic;">\"{{ $userReview->review_text }}\"</p>
                                        @endif
                                    </div>
                                    <button class="btn btn-primary" onclick="openReviewModal({{ $loan->buku->id }}, '{{ $loan->buku->judul }}', {{ $loan->id }})" title="Anda bisa memberikan ulasan baru untuk peminjaman ini">
                                        ✏️ Edit Ulasan
                                    </button>
                                @else
                                    <button class="btn btn-primary" onclick="openReviewModal({{ $loan->buku->id }}, '{{ $loan->buku->judul }}', {{ $loan->id }})">
                                        ⭐ Berikan Ulasan
                                    </button>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="empty-state-icon">📚</div>
            <h3>Belum Ada Riwayat Peminjaman</h3>
            <p>Anda belum meminjam buku apapun dari perpustakaan kami</p>
            <a href="/dashboard" style="display: inline-block; padding: 12px 24px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 8px; text-decoration: none; font-weight: 600;">
                Jelajahi Koleksi Buku
            </a>
        </div>
    @endif
</div>

<!-- Review Modal -->
<div class="modal-backdrop" id="reviewModal">
    <div class="modal" style="max-width: 500px;">
        <h3>⭐ Berikan Ulasan untuk Buku</h3>
        <p id="modalReviewBookTitle" style="color: #667eea; font-weight: 600; margin-bottom: 16px;"></p>
        
        <form id="reviewForm" method="POST" action="{{ route('submit.review') }}" style="display: flex; flex-direction: column; gap: 16px;">
            @csrf
            <input type="hidden" id="bukuIdInput" name="buku_id">
            <input type="hidden" id="pinjamanIdInput" name="pinjaman_id">
            
            <!-- Rating Stars -->
            <div style="text-align: center;">
                <label style="display: block; margin-bottom: 12px; font-weight: 600; color: #374151;">Rating</label>
                <div id="ratingStars" style="font-size: 40px; letter-spacing: 8px; cursor: pointer;">
                    <span class="star" data-rating="1">☆</span>
                    <span class="star" data-rating="2">☆</span>
                    <span class="star" data-rating="3">☆</span>
                    <span class="star" data-rating="4">☆</span>
                    <span class="star" data-rating="5">☆</span>
                </div>
                <input type="hidden" id="ratingInput" name="rating" value="0">
                <p id="ratingText" style="color: #6b7280; font-size: 14px; margin-top: 8px;">Pilih rating</p>
            </div>

            <!-- Review Text -->
            <div>
                <label for="reviewText" style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Ulasan (Opsional)</label>
                <textarea id="reviewText" name="review_text" placeholder="Berikan ulasan Anda tentang buku ini..." 
                    style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-family: inherit; resize: vertical; min-height: 100px;">
                </textarea>
            </div>

            <!-- Actions -->
            <div class="modal-buttons">
                <button type="button" class="modal-btn-cancel" onclick="closeReviewModal()">Batal</button>
                <button type="submit" class="modal-btn-confirm" id="submitReviewBtn" disabled>Kirim Ulasan</button>
            </div>
        </form>
    </div>
</div>

<style>
.star {
    transition: all 0.2s;
    display: inline-block;
    color: #d1d5db;
}
.star:hover, .star.active {
    color: #fbbf24;
    transform: scale(1.1);
}
</style>
<div class="modal-backdrop" id="returnModal">
    <div class="modal">
        <h3>Konfirmasi Pengembalian Buku</h3>
        <p>
            Anda akan mengembalikan buku <strong id="modalBookTitle"></strong>
        </p>
        <div class="modal-buttons">
            <button type="button" class="modal-btn-cancel" onclick="closeReturnModal()">Batal</button>
            <button type="button" class="modal-btn-confirm" onclick="submitReturnForm()">
                Ya, Kembalikan Buku
            </button>
        </div>
    </div>
</div>

<form id="returnForm" method="POST" style="display: none;">
    @csrf
</form>

<script>
    function openReviewModal(bukuId, bookTitle, pinjamanId) {
        document.getElementById('modalReviewBookTitle').textContent = bookTitle;
        document.getElementById('bukuIdInput').value = bukuId;
        document.getElementById('pinjamanIdInput').value = pinjamanId;
        document.getElementById('reviewModal').classList.add('active');
        
        // Reset form
        document.querySelectorAll('.star').forEach(s => s.classList.remove('active'));
        document.getElementById('ratingInput').value = 0;
        document.getElementById('ratingText').textContent = 'Pilih rating';
        document.getElementById('reviewText').value = '';
        document.getElementById('submitReviewBtn').disabled = true;
    }

    function closeReviewModal() {
        document.getElementById('reviewModal').classList.remove('active');
    }

    // Star rating logic
    document.querySelectorAll('.star').forEach(star => {
        star.addEventListener('click', function() {
            const rating = this.dataset.rating;
            document.getElementById('ratingInput').value = rating;
            document.getElementById('ratingText').textContent = rating + ' bintang';
            document.getElementById('submitReviewBtn').disabled = false;
            
            // Update star display
            document.querySelectorAll('.star').forEach(s => {
                if (s.dataset.rating <= rating) {
                    s.textContent = '★';
                    s.classList.add('active');
                } else {
                    s.textContent = '☆';
                    s.classList.remove('active');
                }
            });
        });
        
        star.addEventListener('mouseover', function() {
            const rating = this.dataset.rating;
            document.querySelectorAll('.star').forEach(s => {
                if (s.dataset.rating <= rating) {
                    s.style.color = '#fbbf24';
                } else {
                    s.style.color = '#d1d5db';
                }
            });
        });
    });

    document.getElementById('ratingStars').addEventListener('mouseleave', function() {
        const currentRating = document.getElementById('ratingInput').value;
        document.querySelectorAll('.star').forEach(s => {
            if (s.dataset.rating <= currentRating) {
                s.style.color = '#fbbf24';
            } else {
                s.style.color = '#d1d5db';
            }
        });
    });

    function openReturnModal(pinjamanId, bookTitle) {
        document.getElementById('modalBookTitle').textContent = bookTitle;
        document.getElementById('returnForm').action = `/kembalikan/${pinjamanId}`;
        document.getElementById('returnModal').classList.add('active');
    }

    function closeReturnModal() {
        document.getElementById('returnModal').classList.remove('active');
    }

    function submitReturnForm() {
        document.getElementById('returnForm').submit();
    }

    function filterLoans(status) {
        // Update tab active state
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.classList.remove('active');
        });
        event.target.classList.add('active');

        // Filter loans
        const loans = document.querySelectorAll('.loan-card');
        loans.forEach(loan => {
            if (status === 'all' || loan.dataset.status === status) {
                loan.style.display = '';
            } else {
                loan.style.display = 'none';
            }
        });
    }

    // Close modal when clicking outside
    document.getElementById('returnModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeReturnModal();
        }
    });

    document.getElementById('reviewModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeReviewModal();
        }
    });
</script>

</body>
</html>
