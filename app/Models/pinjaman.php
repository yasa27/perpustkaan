<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;

    protected $table = 'pinjamen';

    protected $fillable = [
        'user_id',
        'buku_id',
        'tanggal_pinjam',
        'tanggal_kembali_target',
        'tanggal_kembali_aktual',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pinjam' => 'datetime',
            'tanggal_kembali_target' => 'datetime',
            'tanggal_kembali_aktual' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
