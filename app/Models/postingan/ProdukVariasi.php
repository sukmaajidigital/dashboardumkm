<?php

namespace App\Models\postingan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukVariasi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
