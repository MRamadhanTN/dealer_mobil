@extends('admin.app') {{-- pastikan ini sesuai dengan file master layout utama --}}

@section('title', $title ?? 'Dashboard') {{-- title halaman dinamis --}}

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">PAKET</h1>
            <a href="{{ route('admin.paket.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
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
                                <th>Kode</th>
                                <th>Harga Min</th>
                                <th>Harga Max</th>
                                <th>Uang Muka</th>
                                <th>Jumlah Cicilan</th>
                                <th>Bunga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        {{-- <tfoot>
                            <tr>
                                <th>Kode</th>
                                <th>Harga Min</th>
                                <th>Harga Max</th>
                                <th>Uang Muka</th>
                                <th>Jumlah Cicilan</th>
                                <th>Bunga</th>
                                <th>Action</th>
                            </tr>
                        </tfoot> --}}
                        <tbody>
                            @forelse ($paket as $item)
                                <tr>
                                    <td>{{ $item->kode_paket }}</td>
                                    <td>Rp. {{ number_format($item->harga_min, 0, 0, '.') }}</td>
                                    <td>Rp. {{ number_format($item->harga_max, 0, 0, '.') }}</td>
                                    <td>{{ $item->uang_muka }}%</td>
                                    <td>{{ $item->jumlah_cicilan }} bulan</td>
                                    <td>{{ $item->bunga }}%</td>
                                    <td>
                                        <form action="{{ route('admin.paket.delete', $item->kode_paket) }}" method="post" id="del-{{ $item->kode_paket }}">
                                            @csrf @method('DELETE')
                                        </form>
                                        <a href="{{ route('admin.paket.show', $item->kode_paket) }}" class="btn btn-primary btn-circle" style="width: 19px; height: 27px">
                                            <i class="fas fa-arrow-right" style="font-size: 11px"></i>
                                        </a>
                                        <a href="{{ route('admin.paket.edit', $item->kode_paket) }}" class="btn btn-success btn-circle" style="width: 19px; height: 27px">
                                            <i class="fas fa-pen" style="font-size: 11px"></i>
                                        </a>
                                        <button form="del-{{ $item->kode_paket }}" type="submit" class="btn btn-danger btn-circle" style="width: 19px; height: 27px">
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
