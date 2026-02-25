<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Pinjaman;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalBuku = Buku::count();
        $totalUser = User::where('role', 'user')->count();
        $totalPinjaman = Pinjaman::count();
        $pinjamanAktif = Pinjaman::where('status', 'dipinjam')->count();
        $totalReview = Review::count();
        $totalAdmin = User::where('role', 'admin')->count();

        return view('admin.dashboard', compact(
            'totalBuku',
            'totalUser',
            'totalPinjaman',
            'pinjamanAktif',
            'totalReview',
            'totalAdmin'
        ));
    }

    // ===== MANAGE BUKU =====
    public function bukuIndex(Request $request)
    {
        $search = $request->query('search');
        
        $bukus = Buku::query()
            ->when($search, function($query) use ($search) {
                return $query->where('judul', 'like', "%{$search}%")
                    ->orWhere('pengarang', 'like', "%{$search}%")
                    ->orWhere('isbn', 'like', "%{$search}%");
            })
            ->paginate(10);
        
        return view('admin.buku.index', compact('bukus', 'search'));
    }

    public function bukuCreate()
    {
        $kategoris = Kategori::all();
        return view('admin.buku.create', compact('kategoris'));
    }

    public function bukuStore(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'isbn' => 'required|string|unique:bukus',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'jumlah_total' => 'required|integer|min:1',
            'kategori_id' => 'nullable|exists:kategoris,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validated['jumlah_tersedia'] = $validated['jumlah_total'];

        // Handle file upload
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/covers'), $filename);
            $validated['cover_image'] = 'uploads/covers/' . $filename;
        }

        Buku::create($validated);

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function bukuEdit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.buku.edit', compact('buku', 'kategoris'));
    }

    public function bukuUpdate(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'isbn' => 'required|string|unique:bukus,isbn,' . $id,
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'jumlah_total' => 'required|integer|min:1',
            'kategori_id' => 'nullable|exists:kategoris,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Calculate jumlah_tersedia based on jumlah_dipinjam
        $jumlahDipinjam = $buku->jumlah_total - $buku->jumlah_tersedia;
        $validated['jumlah_tersedia'] = max(0, $validated['jumlah_total'] - $jumlahDipinjam);

        // Handle file upload
        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($buku->cover_image && file_exists(public_path($buku->cover_image))) {
                unlink(public_path($buku->cover_image));
            }

            $file = $request->file('cover_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/covers'), $filename);
            $validated['cover_image'] = 'uploads/covers/' . $filename;
        }

        $buku->update($validated);

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil diperbarui!');
    }

    public function bukuDestroy($id)
    {
        $buku = Buku::findOrFail($id);

        // Check apakah buku sedang dipinjam
        $sedangDipinjam = Pinjaman::where('buku_id', $id)
            ->where('status', 'dipinjam')
            ->exists();

        if ($sedangDipinjam) {
            return back()->with('error', 'Buku tidak bisa dihapus karena sedang dipinjam');
        }

        $buku->delete();

        return back()->with('success', 'Buku berhasil dihapus!');
    }

    // ===== MANAGE PEMINJAMAN =====
    public function pinjamanIndex()
    {
        $pinjamans = Pinjaman::with(['user', 'buku'])->paginate(15);
        return view('admin.pinjaman.index', compact('pinjamans'));
    }

    public function pinjamanDetail($id)
    {
        $pinjaman = Pinjaman::with(['user', 'buku', 'review'])->findOrFail($id);
        return view('admin.pinjaman.detail', compact('pinjaman'));
    }

    public function pinjamanKembalikan($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);

        if ($pinjaman->status === 'dikembalikan') {
            return back()->with('error', 'Peminjaman sudah dikembalikan');
        }

        $pinjaman->update([
            'status' => 'dikembalikan',
            'tanggal_kembali_aktual' => now(),
        ]);

        // kembalikan jumlah buku tersedia
        $pinjaman->buku->increment('jumlah_tersedia');

        return back()->with('success', 'Peminjaman berhasil ditandai sudah dikembalikan');
    }

    // ===== MANAGE USERS =====
    public function userIndex()
    {
        $users = User::where('role', 'user')->paginate(15);
        return view('admin.user.index', compact('users'));
    }

    public function userDetail($id)
    {
        $user = User::findOrFail($id);
        $pinjamans = $user->pinjaman()->with('buku')->paginate(10);
        $reviews = $user->reviews()->with('buku')->paginate(10);

        return view('admin.user.detail', compact('user', 'pinjamans', 'reviews'));
    }

    public function userCreate()
    {
        return view('admin.user.create');
    }

    public function userStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['role'] = 'user';

        User::create($validated);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function userDestroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return back()->with('error', 'Tidak bisa menghapus user admin');
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus!');
    }

    // ===== MANAGE ADMIN =====
    public function adminIndex()
    {
        $admin = User::where('role', 'admin')->first();
        return view('admin.admin.index', compact('admin'));
    }

    public function adminCreate()
    {
        // Check jika sudah ada admin
        if (User::where('role', 'admin')->exists()) {
            return redirect()->route('admin.admin.index')->with('error', 'Sistem hanya mendukung 1 akun admin');
        }

        return view('admin.admin.create');
    }

    public function adminStore(Request $request)
    {
        // Check jika sudah ada admin
        if (User::where('role', 'admin')->exists()) {
            return redirect()->route('admin.admin.index')->with('error', 'Sistem hanya mendukung 1 akun admin. Admin sudah terdaftar');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['role'] = 'admin';

        User::create($validated);

        return redirect()->route('admin.admin.index')->with('success', 'Admin berhasil ditambahkan!');
    }

    public function adminDestroy($id)
    {
        return back()->with('error', 'Tidak bisa menghapus akun admin. Sistem memerlukan minimal 1 admin');
    }

    // ===== MANAGE KATEGORI =====
    public function kategoriIndex(Request $request)
    {
        $search = $request->query('search');
        
        $kategoris = Kategori::query()
            ->when($search, function($query) use ($search) {
                return $query->where('nama', 'like', "%{$search}%");
            })
            ->paginate(10);
        
        return view('admin.kategori.index', compact('kategoris', 'search'));
    }

    public function kategoriCreate()
    {
        return view('admin.kategori.create');
    }

    public function kategoriStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kategoris',
            'deskripsi' => 'nullable|string|max:500',
        ]);

        Kategori::create($validated);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function kategoriEdit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function kategoriUpdate(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kategoris,nama,' . $id,
            'deskripsi' => 'nullable|string|max:500',
        ]);

        $kategori->update($validated);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function kategoriDestroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        // Check apakah ada buku yang menggunakan kategori ini
        if ($kategori->bukus()->exists()) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena masih digunakan oleh buku');
        }

        $kategori->delete();

        return back()->with('success', 'Kategori berhasil dihapus!');
    }
}

