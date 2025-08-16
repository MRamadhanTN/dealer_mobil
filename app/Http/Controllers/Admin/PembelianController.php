<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cicilan;
use App\Models\Mobil;
use App\Models\Order;
use App\Models\PaketKredit;
use App\Models\Pembeli;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    public function index(Request $request) {
        if ($request->type_pembayaran == 'kredit') {
            $data['pembelian'] = Order::with('pembeli', 'mobil')->where('type_pembayaran', 'kredit')->get();
        } else {
            $data['pembelian'] = Order::with('pembeli', 'mobil')->where('type_pembayaran', 'cash')->get();
        }

        return view('admin.pages.pembelian.pembelian', $data);
    }

    public function show(Request $request, $id) {
        $data['pembelian'] = Order::with('pembeli', 'mobil', 'paket_kredit', 'cicilan')->findOrFail($id);

        return view('admin.pages.pembelian.show', $data);
    }

    public function create(Request $request) {
        $data['pembeli'] = Pembeli::pluck('nama', 'ktp');
        $data['mobil'] = Mobil::select('harga', 'kode_mobil', 'type')->get();
        $data['paket'] = PaketKredit::get();
        $data['title'] = "TAMBAH";

        return view('admin.pages.pembelian.form', $data);
    }

    public function edit(Request $request, $id) {
        $data['title'] = "UPDATE";
        $data['pembelian'] = Order::findOrFail($id);

        return view('admin.pages.pembelian.form', $data);
    }

    public function store(Request $request) {
        DB::beginTransaction();
        $data = $request->validate([
            'ktp' => 'required|exists:pembeli,ktp',
            'kode_mobil' => 'required|exists:mobil,kode_mobil',
            'type_pembayaran' => 'required|in:cash,kredit',
            'kode_paket' => 'nullable|exists:paket_kredit,kode_paket',
        ]);

        $mobil = Mobil::find($request->kode_mobil);
        $data['total_harga'] = $mobil->harga;
        if ($request->type_pembayaran == 'kredit') {
            $kredit = PaketKredit::find($request->kode_paket);

            // if ($mobil->harga > $kredit->harga_max && $mobil->harga < $kredit->harga_min) {
            //     return redirect()->back()->withInput()->with('error', 'paket ini tidak cocok untuk pembelian mobil ini.');
            // }

            $data['total_pembayaran'] = $mobil->harga * $kredit->uang_muka / 100;
        } else {
            $data['total_pembayaran'] = $mobil->harga;
        }
        $data['tanggal_bayar'] = date('Y-m-d');

        $order = Order::create($data);
        if ($order->type_pembayaran == 'kredit') {
            $sisaCicilan = $mobil->harga - $order->total_pembayaran;
            $hargaPerBulan = $sisaCicilan / $kredit->jumlah_cicilan;
            $bungaPerBulan = $sisaCicilan * $kredit->bunga * $kredit->jumlah_cicilan / 100;
            $angsuran = $hargaPerBulan + $bungaPerBulan;
            $noCicilan = 1;

            for ($i=0; $i < $kredit->jumlah_cicilan; $i++) {
                $e[] = Cicilan::create([
                    'kode_transaksi' => $order->kode_transaksi,
                    'cicilan_ke' => $noCicilan++,
                    'jatuh_tempo' => Carbon::parse('now')->addMonth($i),
                    'total_bayar' => $angsuran,
                ]);
            }
        }
        DB::commit();

        return redirect()->route('admin.pembelian');
    }

    public function update(Request $request, $id) {
        $data = $request->validate([
            'harga_min' => 'required|integer',
            'harga_max' => 'required|integer',
            'uang_muka' => 'required|integer',
            'jumlah_cicilan' => 'required|integer',
            'bunga' => 'required|integer',
        ]);

        if ($data['harga_max'] < $request['harga_min']) return redirect()->back()->with('error', 'harga max harus lebih tinggi')->withInput();

        $query = Order::findOrFail($id);
        $query->update($data);

        return redirect()->route('admin.pembelian');
    }

    public function delete(Request $request, $id) {
        $data = Order::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'berhasil menghapus data pembelian');
    }
}
