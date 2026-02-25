<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'buku_id',
        'pinjaman_id',
        'rating',
        'review_text',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class);
    }
}
