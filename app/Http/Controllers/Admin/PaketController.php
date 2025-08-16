<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaketKredit;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index(Request $request) {
        $data['paket'] = PaketKredit::get();

        return view('admin.pages.data_master.paket.paket', $data);
    }

    public function show(Request $request, $id) {
        $data['paket'] = PaketKredit::findOrFail($id);

        return view('admin.pages.data_master.paket.show', $data);
    }

    public function create(Request $request) {
        $data['title'] = "TAMBAH";

        return view('admin.pages.data_master.paket.form', $data);
    }

    public function edit(Request $request, $id) {
        $data['title'] = "UPDATE";
        $data['paket'] = PaketKredit::findOrFail($id);

        return view('admin.pages.data_master.paket.form', $data);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'harga_min' => 'required',
            'harga_max' => 'required',
            'uang_muka' => 'required',
            'jumlah_cicilan' => 'required',
            'bunga' => 'required',
        ]);

        $data['harga_min'] = str_replace('.', '', $data['harga_min']);
        $data['harga_max'] = str_replace('.', '', $data['harga_max']);
        if ($data['harga_max'] < $data['harga_min']) return redirect()->back()->with('error', 'harga max harus lebih tinggi')->withInput();

        PaketKredit::create($data);

        return redirect()->route('admin.paket');
    }

    public function update(Request $request, $id) {
        $data = $request->validate([
            'harga_min' => 'required',
            'harga_max' => 'required',
            'uang_muka' => 'required|integer',
            'jumlah_cicilan' => 'required|integer',
            'bunga' => 'required|integer',
        ]);

        $data['harga_min'] = str_replace('.', '', $data['harga_min']);
        $data['harga_max'] = str_replace('.', '', $data['harga_max']);
        if ($data['harga_max'] < $data['harga_min']) return redirect()->back()->with('error', 'harga max harus lebih tinggi')->withInput();

        $query = PaketKredit::findOrFail($id);
        $query->update($data);

        return redirect()->route('admin.paket');
    }

    public function delete(Request $request, $id) {
        $data = PaketKredit::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'berhasil menghapus data paket');
    }
}