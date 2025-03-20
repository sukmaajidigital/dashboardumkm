<?php

namespace App\Models\transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownPayment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}
