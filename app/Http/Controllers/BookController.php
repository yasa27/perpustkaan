<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Review;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookController extends Controller
{
    public function lihatBuku(Request $request)
    {
        $q = $request->input('q');
        $kategori_id = $request->input('kategori_id');

        $bukus = Buku::when($q, function ($query, $q) {
            $like = '%'.trim($q).'%';
            $query->where('judul', 'like', $like)
                ->orWhere('pengarang', 'like', $like)
                ->orWhere('penerbit', 'like', $like)
                ->orWhere('isbn', 'like', $like);
        })
        ->when($kategori_id, function ($query, $kategori_id) {
            $query->where('kategori_id', $kategori_id);
        })
        ->get();
        
        $kategoris = \App\Models\Kategori::all();
        
        if (auth()->check()) {
            return redirect()->route('dashboard', ['q' => $q, 'kategori_id' => $kategori_id]);
        }

        return view('books.public', compact('bukus', 'q', 'kategoris', 'kategori_id'));
    }

    public function index(Request $request)
    {
        $q = $request->input('q');
        $kategori_id = $request->input('kategori_id');

        $bukus = Buku::when($q, function ($query, $q) {
            $like = '%'.trim($q).'%';
            $query->where('judul', 'like', $like)
                ->orWhere('pengarang', 'like', $like)
                ->orWhere('penerbit', 'like', $like)
                ->orWhere('isbn', 'like', $like);
        })
        ->when($kategori_id, function ($query, $kategori_id) {
            $query->where('kategori_id', $kategori_id);
        })
        ->get();

        $pinjaman = auth()->user()->pinjaman()
            ->where('status', 'dipinjam')
            ->with('buku')
            ->get();
        
        $kategoris = \App\Models\Kategori::all();
        
        return view('user.dashboard', compact('bukus', 'pinjaman', 'q', 'kategoris', 'kategori_id'));
    }

    public function showPinjamPage($buku_id)
    {
        $buku = Buku::findOrFail($buku_id);
        return view('books.pinjam', compact('buku'));
    }

    public function pinjam(Request $request, $buku_id)
    {
        $request->validate([
            'tanggal_kembali_target' => 'required|date|after:today',
        ], [
            'tanggal_kembali_target.required' => 'Tanggal pengembalian harus dipilih',
            'tanggal_kembali_target.date' => 'Format tanggal tidak valid',
            'tanggal_kembali_target.after' => 'Tanggal pengembalian harus lebih besar dari hari ini',
        ]);
        
        $buku = Buku::findOrFail($buku_id);

        if ($buku->jumlah_tersedia <= 0) {
            return back()->with('error', 'Buku tidak tersedia');
        }

        // Cek apakah user sudah meminjam buku ini
        $sudahPinjam = Pinjaman::where('user_id', auth()->id())
            ->where('buku_id', $buku_id)
            ->where('status', 'dipinjam')
            ->exists();

        if ($sudahPinjam) {
            return back()->with('error', 'Anda sudah meminjam buku ini');
        }

        $tanggalKembali = \Carbon\Carbon::createFromFormat('Y-m-d', $request->tanggal_kembali_target)->endOfDay();
        $durasi = (int) now()->diffInDays($tanggalKembali);

        Pinjaman::create([
            'user_id' => auth()->id(),
            'buku_id' => $buku_id,
            'tanggal_pinjam' => now(),
            'tanggal_kembali_target' => $tanggalKembali,
        ]);

        $buku->decrement('jumlah_tersedia');

        return redirect('/dashboard')->with('success', "Buku berhasil dipinjam! Batas waktu kembali: " . $tanggalKembali->format('d M Y') . " (" . $durasi . " hari).");
    }

    public function kembalikan($pinjaman_id)
    {
        $pinjaman = Pinjaman::findOrFail($pinjaman_id);

        if ($pinjaman->user_id !== auth()->id()) {
            return back()->with('error', 'Unauthorized');
        }

        $pinjaman->update([
            'status' => 'dikembalikan',
            'tanggal_kembali_aktual' => now(),
        ]);

        $pinjaman->buku->increment('jumlah_tersedia');

        return back()->with('success', 'Buku berhasil dikembalikan');
    }

    public function myPinjaman()
    {
        $loans = auth()->user()->pinjaman()
            ->with('buku')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.pinjaman', compact('loans'));
    }

    public function submitReview(Request $request)
    {
        $validated = $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'pinjaman_id' => 'required|exists:pinjamen,id',
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string|max:1000',
        ]);

        Review::updateOrCreate(
            [
                'pinjaman_id' => $validated['pinjaman_id'],
            ],
            [
                'user_id' => auth()->id(),
                'buku_id' => $validated['buku_id'],
                'rating' => $validated['rating'],
                'review_text' => $validated['review_text'],
            ]
        );

        return back()->with('success', 'Ulasan Anda berhasil disimpan!');
    }
}
