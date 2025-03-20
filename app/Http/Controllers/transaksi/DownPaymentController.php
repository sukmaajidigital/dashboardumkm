<?php

namespace App\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DownPaymentController extends Controller
{
    public function index()
    {
        return view('page_transaksi.downpayment.index');
    }
}
