<?php

namespace App\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    public function index()
    {
        return view('page_transaksi.source.index');
    }
}
