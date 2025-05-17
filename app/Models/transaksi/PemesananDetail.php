<?php

namespace App\Models\transaksi;

use App\Models\postingan\Produk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
