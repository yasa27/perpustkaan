<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['nama', 'deskripsi'];

    public function bukus()
    {
        return $this->hasMany(Buku::class);
    }
}
