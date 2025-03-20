<?php

namespace App\Models\customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakPelanggan extends Model
{
    use HasFactory;
    protected $table = 'kontak_pelanggan';
    protected $guarded = [];
}
