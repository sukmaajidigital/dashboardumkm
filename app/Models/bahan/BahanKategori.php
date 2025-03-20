<?php

namespace App\Models\bahan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanKategori extends Model
{
    use HasFactory;

    protected $table = 'bahan_kategoris';

    protected $fillable = ['nama_kategori'];

    public function bahan()
    {
        return $this->hasMany(Bahan::class, 'bahan_kategori_id');
    }
}
