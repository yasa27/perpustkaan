@extends('admin.layout')

@section('title', 'Laporan Perpustakaan')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
        .report-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 24px;
            box-shadow: 0 8px 16px rgba(102, 126, 234, 0.3);
        }
        .report-header h1 {
            margin: 0 0 8px 0;
            font-size: 28px;
        }
        .report-header p {
            margin: 0;
            opacity: 0.95;
        }
        .stats-overview {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }
        .stat-box {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .stat-box .stat-label {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 8px;
            font-weight: 600;
        }
        .stat-box .stat-value {
            font-size: 32px;
            font-weight: bold;
            color: #667eea;
        }
        .stat-box .stat-subtitle {
            color: #9ca3af;
            font-size: 12px;
            margin-top: 8px;
        }
        .chart-container {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .chart-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 16px;
            color: #1f2937;
        }
        .chart-wrapper {
            position: relative;
            height: 300px;
            margin-bottom: 20px;
        }
        .grid-2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 24px;
            margin-bottom: 24px;
        }
        .month-stats {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .month-stats-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 16px;
            color: #1f2937;
            border-bottom: 2px solid #667eea;
            padding-bottom: 12px;
        }
        .month-stat-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f3f4f6;
        }
        .month-stat-row:last-child {
            border-bottom: none;
        }
        .month-stat-label {
            color: #6b7280;
            font-size: 14px;
        }
        .month-stat-value {
            font-size: 18px;
            font-weight: bold;
            color: #667eea;
        }
        .top-books {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .top-books-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 16px;
            color: #1f2937;
            border-bottom: 2px solid #667eea;
            padding-bottom: 12px;
        }
        .book-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f3f4f6;
        }
        .book-item:last-child {
            border-bottom: none;
        }
        .book-info {
            flex: 1;
        }
        .book-title {
            font-weight: 600;
            color: #1f2937;
            font-size: 14px;
        }
        .book-author {
            color: #9ca3af;
            font-size: 12px;
            margin-top: 4px;
        }
        .book-count {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 12px;
        }
        .return-status {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        .status-item {
            padding: 12px;
            border-radius: 8px;
            text-align: center;
        }
        .status-item.on-time {
            background: #d1fae5;
            color: #065f46;
        }
        .status-item.late {
            background: #fee2e2;
            color: #991b1b;
        }
        .status-number {
            font-size: 24px;
            font-weight: bold;
        }
        .status-label {
            font-size: 12px;
            margin-top: 4px;
        }
    </style>

<!-- Laporan Content -->
<div style="max-width: 1200px;">
    <!-- Overall Stats -->
    <div class="stats-overview">
        <div class="stat-box">
            <div class="stat-label">📚 Total Buku</div>
            <div class="stat-value">{{ $totalBooks }}</div>
            <div class="stat-subtitle">{{ $availableBooks }} tersedia</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">👥 Total User</div>
            <div class="stat-value">{{ $totalUsers }}</div>
            <div class="stat-subtitle">Member aktif</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">📖 Total Peminjaman</div>
            <div class="stat-value">{{ $totalLoans }}</div>
            <div class="stat-subtitle">Sepanjang masa</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">📅 Bulan Ini</div>
            <div class="stat-value">{{ $thisMonthLoans }}</div>
            <div class="stat-subtitle">{{ $thisMonthUsers }} pengguna</div>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid-2">
        <!-- Peminjaman per Bulan -->
        <div class="chart-container">
            <div class="chart-title">📈 Grafik Peminjaman Per Bulan</div>
            <div class="chart-wrapper">
                <canvas id="monthlyLoansChart"></canvas>
            </div>
        </div>

        <!-- Pengguna per Bulan -->
        <div class="chart-container">
            <div class="chart-title">👥 Grafik Pengguna Aktif Per Bulan</div>
            <div class="chart-wrapper">
                <canvas id="monthlyUsersChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Statistik Bulan Ini -->
    <div class="grid-2">
        <!-- Bulan Ini Stats -->
        <div class="month-stats">
            <div class="month-stats-title">📅 Statistik Bulan Ini</div>
            <div class="month-stat-row">
                <span class="month-stat-label">Total Peminjaman</span>
                <span class="month-stat-value">{{ $thisMonthLoans }}</span>
            </div>
            <div class="month-stat-row">
                <span class="month-stat-label">Pengguna Unik</span>
                <span class="month-stat-value">{{ $thisMonthUsers }}</span>
            </div>
            <div class="month-stat-row">
                <span class="month-stat-label">Rata-rata per User</span>
                <span class="month-stat-value">
                    @if($thisMonthUsers > 0)
                        {{ number_format($thisMonthLoans / $thisMonthUsers, 1) }}
                    @else
                        0
                    @endif
                </span>
            </div>
        </div>

        <!-- Status Pengembalian -->
        <div class="month-stats">
            <div class="month-stats-title">✓ Status Pengembalian Bulan Ini</div>
            <div class="return-status">
                <div class="status-item on-time">
                    <div class="status-number">{{ $onTimeReturns }}</div>
                    <div class="status-label">Tepat Waktu</div>
                </div>
                <div class="status-item late">
                    <div class="status-number">{{ $lateReturns }}</div>
                    <div class="status-label">Terlambat</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Books -->
    @if($topBooks->count() > 0)
        <div class="top-books">
            <div class="top-books-title">⭐ 5 Buku Paling Sering Dipinjam</div>
            @foreach($topBooks as $book)
                <div class="book-item">
                    <div class="book-info">
                        <div class="book-title">{{ $book->buku->judul }}</div>
                        <div class="book-author">{{ $book->buku->pengarang }} • {{ $book->buku->penerbit }}</div>
                    </div>
                    <div class="book-count">{{ $book->total_pinjam }}x</div>
                </div>
            @endforeach
        </div>
    @endif

</div>

<script>
    // Chart 1: Peminjaman per Bulan
    const ctx1 = document.getElementById('monthlyLoansChart').getContext('2d');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: {!! json_encode($monthLabels) !!},
            datasets: [{
                label: 'Jumlah Peminjaman',
                data: {!! json_encode($monthlyLoans) !!},
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#667eea',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        font: { size: 12 }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Chart 2: Pengguna per Bulan
    const ctx2 = document.getElementById('monthlyUsersChart').getContext('2d');
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: {!! json_encode($monthLabels) !!},
            datasets: [{
                label: 'Pengguna Aktif',
                data: {!! json_encode($monthlyUsers) !!},
                backgroundColor: 'rgba(118, 75, 162, 0.8)',
                borderColor: '#764ba2',
                borderWidth: 1,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        font: { size: 12 }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
</div>
@endsection
