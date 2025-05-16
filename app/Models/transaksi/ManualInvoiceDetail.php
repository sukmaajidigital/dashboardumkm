<?php

namespace App\Models\transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualInvoiceDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function manualinvoice()
    {
        return $this->belongsTo(ManualInvoice::class);
    }
}
