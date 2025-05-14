<?php

namespace App\Models\postingan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';

    protected $guarded = [];

    public function kategoris()
    {
        return $this->belongsToMany(ProdukKategori::class, 'produk_listkategoris', 'produk_id', 'produk_kategori_id');
    }
    // public function variasi()
    // {
    //     return $this->hasMany(ProdukVariasi::class, 'produk_id');
    // }
}
