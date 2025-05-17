<?php

namespace App\Models\transaksi;

use App\Models\postingan\Produk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
