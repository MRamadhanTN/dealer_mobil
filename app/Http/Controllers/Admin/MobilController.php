<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\Mobil;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    public function index(Request $request) {
        $data['mobil'] = Mobil::get();

        return view('admin.pages.data_master.mobil.mobil', $data);
    }

    public function show(Request $request, $id) {
        $data['mobil'] = Mobil::findOrFail($id);

        return view('admin.pages.data_master.mobil.show', $data);
    }

    public function create(Request $request) {
        $data['title'] = "Tambah";

        return view('admin.pages.data_master.mobil.form', $data);
    }

    public function edit(Request $request, $id) {
        $data['title'] = "Update";
        $data['mobil'] = Mobil::findOrFail($id);

        return view('admin.pages.data_master.mobil.form', $data);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'merk' => 'required|min:2',
            'type' => 'required|min:2',
            'warna' => 'required',
            'harga' => 'required',
            'gambar' => 'nullable|max:2048',
        ]);

        if (isset($request['gambar'])) {
            $data['gambar'] = FileUpload::file_upload('mobil', $request->gambar);
        }
        $data['harga'] = str_replace('.', '', $data['harga']);
        Mobil::create($data);

        return redirect()->route('admin.mobil');
    }

    public function update(Request $request, $id) {
        $data = $request->validate([
            'merk' => 'required|min:2',
            'type' => 'required|min:2',
            'warna' => 'required',
            'harga' => 'required',
            'gambar' => 'nullable|max:2048',
        ]);

        $query = Mobil::findOrFail($id);
        if (isset($request['gambar'])) {
            $data['gambar'] = FileUpload::file_upload('mobil', $request->gambar, $query->gambar ? $query->gambar : null);
        }
        $data['harga'] = str_replace('.', '', $data['harga']);
        $query->update($data);

        return redirect()->route('admin.mobil');
    }

    public function delete(Request $request, $id) {
        $data = Mobil::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'berhasil menghapus data mobil');
    }
}
