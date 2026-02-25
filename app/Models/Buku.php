<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'pengarang',
        'penerbit',
        'deskripsi',
        'isbn',
        'tahun_terbit',
        'jumlah_total',
        'jumlah_tersedia',
        'cover_image',
        'kategori_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'buku_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'buku_id');
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function reviewCount()
    {
        return $this->reviews()->count();
    }
};