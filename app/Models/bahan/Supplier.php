<?php

namespace App\Models\bahan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';

    protected $guarded = [];

    public function bahanMasuk()
    {
        return $this->hasMany(BahanMasuk::class, 'supplier_id');
    }
}
