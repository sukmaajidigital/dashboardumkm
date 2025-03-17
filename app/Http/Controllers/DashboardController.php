<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bahan;
use App\Models\BahanMasuk;
use App\Models\BahanKeluar;
use App\Models\BahanKategori;
use App\Models\Supplier;
use App\Models\Keperluan;
use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data bahan dari database
        $setting = Setting::first();

        // Kirim data ke view
        return view('welcome', compact('setting'));
    }
}
