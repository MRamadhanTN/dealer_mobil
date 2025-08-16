<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembeli;
use Illuminate\Http\Request;

class PembeliController extends Controller
{
    public function index(Request $request) {
        $data['pembeli'] = Pembeli::get();

        return view('admin.pages.pelanggan.pembeli.pembeli', $data);
    }

    public function show(Request $request, $id) {
        $data['pembeli'] = Pembeli::findOrFail($id);

        return view('admin.pages.pelanggan.pembeli.show', $data);
    }

    public function create(Request $request) {
        $data['title'] = "TAMBAH";

        return view('admin.pages.pelanggan.pembeli.form', $data);
    }

    public function edit(Request $request, $id) {
        $data['title'] = "UPDATE";
        $data['pembeli'] = Pembeli::findOrFail($id);

        return view('admin.pages.pelanggan.pembeli.form', $data);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'ktp' => 'required',
            'alamat' => 'required',
            'nama' => 'required',
            'telp' => 'required',
        ]);

        Pembeli::create($data);

        return redirect()->route('admin.pembeli');
    }

    public function update(Request $request, $id) {
        $data = $request->validate([
            'ktp' => 'required',
            'alamat' => 'required',
            'nama' => 'required',
            'telp' => 'required',
        ]);

        $query = Pembeli::findOrFail($id);
        $query->update($data);

        return redirect()->route('admin.pembeli');
    }

    public function delete(Request $request, $id) {
        $data = Pembeli::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'berhasil menghapus data pembeli');
    }
}
