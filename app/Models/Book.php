<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
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
}
