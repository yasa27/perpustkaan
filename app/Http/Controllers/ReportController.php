<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\Buku;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Data peminjaman per bulan (12 bulan terakhir)
        $monthlyLoans = [];
        $monthLabels = [];
        
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthLabels[] = $date->format('M Y');
            
            $count = Pinjaman::whereYear('tanggal_pinjam', $date->year)
                ->whereMonth('tanggal_pinjam', $date->month)
                ->count();
            
            $monthlyLoans[] = $count;
        }

        // Data pengguna unik yang meminjam per bulan
        $monthlyUsers = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            
            $count = Pinjaman::whereYear('tanggal_pinjam', $date->year)
                ->whereMonth('tanggal_pinjam', $date->month)
                ->distinct('user_id')
                ->count('user_id');
            
            $monthlyUsers[] = $count;
        }

        // Buku paling sering dipinjam
        $topBooks = Pinjaman::selectRaw('buku_id, COUNT(*) as total_pinjam')
            ->groupBy('buku_id')
            ->orderByDesc('total_pinjam')
            ->limit(5)
            ->with('buku')
            ->get();

        // Statistik bulan ini
        $thisMonth = Carbon::now();
        $thisMonthLoans = Pinjaman::whereYear('tanggal_pinjam', $thisMonth->year)
            ->whereMonth('tanggal_pinjam', $thisMonth->month)
            ->count();

        $thisMonthUsers = Pinjaman::whereYear('tanggal_pinjam', $thisMonth->year)
            ->whereMonth('tanggal_pinjam', $thisMonth->month)
            ->distinct('user_id')
            ->count('user_id');

        // Status pengembalian bulan ini
        $onTimeReturns = Pinjaman::whereYear('tanggal_pinjam', $thisMonth->year)
            ->whereMonth('tanggal_pinjam', $thisMonth->month)
            ->where('status', 'dikembalikan')
            ->whereRaw('tanggal_kembali_aktual <= tanggal_kembali_target')
            ->count();

        $lateReturns = Pinjaman::whereYear('tanggal_pinjam', $thisMonth->year)
            ->whereMonth('tanggal_pinjam', $thisMonth->month)
            ->where('status', 'dikembalikan')
            ->whereRaw('tanggal_kembali_aktual > tanggal_kembali_target')
            ->count();

        // Total buku dan user
        $totalBooks = Buku::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalLoans = Pinjaman::count();
        $availableBooks = Buku::where('jumlah_tersedia', '>', 0)->count();

        return view('reports.index', compact(
            'monthlyLoans',
            'monthlyUsers',
            'monthLabels',
            'topBooks',
            'thisMonthLoans',
            'thisMonthUsers',
            'onTimeReturns',
            'lateReturns',
            'totalBooks',
            'totalUsers',
            'totalLoans',
            'availableBooks'
        ));
    }
}
