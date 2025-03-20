<?php

namespace App\Models\transaksi;

use App\Models\customer\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public function details()
    {
        return $this->hasMany(PemesananDetail::class);
    }
}
