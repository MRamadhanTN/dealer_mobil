<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use App\Models\Order;
use App\Models\PaketKredit;
use App\Models\Pembeli;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
{
    $totalMobil = Mobil::count();
    $totalPaketKredit = PaketKredit::count();
    $totalCash = Order::where('type_pembayaran', 'cash')->count();
    $totalKredit = Order::where('type_pembayaran', 'kredit')->count();

    // Ambil 5 kredit terbaru
    $kreditTerbaru = Order::orderBy('created_at', 'desc')
        ->where('type_pembayaran', 'kredit')
        ->take(5)
        ->get();

    // Ambil 5 transaksi cash terbaru
    $cashTerbaru = Order::where('type_pembayaran', 'cash')
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

    // Ambil 5 pembeli terbaru
    $pembeliTerbaru = Pembeli::orderBy('created_at', 'desc')
        ->take(5)
        ->get();


    return view('admin.pages.dashboard.dashboard', compact(
        'totalMobil',
        'totalPaketKredit',
        'totalCash',
        'totalKredit',
        'kreditTerbaru',
        'cashTerbaru',
        'pembeliTerbaru'
    ));
}

}
