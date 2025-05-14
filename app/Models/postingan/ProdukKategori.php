<?php

namespace App\Models\postingan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukKategori extends Model
{
    use HasFactory;

    protected $table = 'produk_kategoris';

    protected $guarded = [];

    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'produk_listkategoris', 'produk_kategori_id', 'produk_id');
    }
}
