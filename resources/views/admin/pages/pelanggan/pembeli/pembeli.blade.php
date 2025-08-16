@extends('admin.app') {{-- pastikan ini sesuai dengan file master layout utama --}}

@section('title', $title ?? 'Dashboard') {{-- title halaman dinamis --}}

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">PEMBELI</h1>
            <a href="{{ route('admin.pembeli.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> TAMBAH</a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>KTP</th>
                                <th>Telepon</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        {{-- <tfoot>
                            <tr>
                                <th>Kode</th>
                                <th>Merk</th>
                                <th>Type</th>
                                <th>Warna</th>
                                <th>Harga</th>
                                <th>Gambar</th>
                                <th>Action</th>
                            </tr>
                        </tfoot> --}}
                        <tbody>
                            @forelse ($pembeli as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->ktp }}</td>
                                    <td>{{ $item->telp }}</td>
                                    <td>
                                        <form action="{{ route('admin.pembeli.delete', $item->ktp) }}" method="post" id="del-{{ $item->ktp }}">
                                            @csrf @method('DELETE')
                                        </form>
                                        <a href="{{ route('admin.pembeli.show', $item->ktp) }}" class="btn btn-primary btn-circle" style="width: 19px; height: 27px">
                                            <i class="fas fa-arrow-right" style="font-size: 11px"></i>
                                        </a>
                                        <a href="{{ route('admin.pembeli.edit', $item->ktp) }}" class="btn btn-success btn-circle" style="width: 19px; height: 27px">
                                            <i class="fas fa-pen" style="font-size: 11px"></i>
                                        </a>
                                        <button form="del-{{ $item->ktp }}" type="submit" class="btn btn-danger btn-circle" style="width: 19px; height: 27px">
                                            <i class="fas fa-trash" style="font-size: 11px"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
