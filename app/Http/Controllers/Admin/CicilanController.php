<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cicilan;
use Illuminate\Http\Request;

class CicilanController extends Controller
{
    public function index(Request $request) {
        $data['cicilan'] = Cicilan::get();

        return view('admin.pages.pelanggan.cicilan', $data);
    }

    public function update(Request $request, $trx, $id) {
        $query = Cicilan::where('kode_transaksi', $trx)->get();
        $cicilan = $query->find($id);

        if ($cicilan->cicilan_ke > 1) {
            $oldCicilan = $query->where('cicilan_ke', $cicilan->cicilan_ke-1)->first();
            if ($oldCicilan->status_cicilan != 'lunas') return back()->with('error', 'selesaikan cicilan sebelumnya terlebih dahulu');
        }

        $cicilan->update(['status_cicilan' => 'lunas']);

        return redirect()->back()->with('success', 'Cicilan berhasil diperbarui');
    }
}
