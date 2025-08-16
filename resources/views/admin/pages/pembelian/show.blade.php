@extends('admin.app') {{-- pastikan ini sesuai dengan file master layout utama --}}

@section('title', $title ?? 'Dashboard') {{-- title halaman dinamis --}}

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">DETAIL PEMBELIAN</h1>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h5>Data Transaksi</h5>
                        <p>Kode Transaksi : {{ $pembelian->kode_transaksi }}</p>
                        <p>Kode Mobil : {{ $pembelian->kode_mobil }}</p>
                        <p>KTP Pembeli : {{ $pembelian->ktp }}</p>
                        <p>Type Pembayaran : {{ $pembelian->type_pembayaran }}</p>
                        <p>Total Harga : {{ $pembelian->total_harga }}</p>
                        <p>Total Pembayaran @if ($pembelian->total_pembayaran == 'kredit' ) DP @endif : {{ $pembelian->total_pembayaran }}</p>
                        <p>Tanggal Bayar : {{ $pembelian->tanggal_bayar }}</p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <h5>Data Pembeli</h5>
                        <p>KTP Pembeli : {{ $pembelian->pembeli->ktp }}</p>
                        <p>Nama Pembeli : {{ $pembelian->pembeli->nama }}</p>
                        <p>Telepon Pembeli : {{ $pembelian->pembeli->telp }}</p>
                        <p>Alamat Pembeli : {{ $pembelian->pembeli->alamat }}</p>
                    </div>
                    <div class="col-6">
                        <h5>Data Mobil</h5>
                        <p>Kode Mobil : {{ $pembelian->mobil->kode_mobil }}</p>
                        <p>Merk Mobil : {{ $pembelian->mobil->merk }}</p>
                        <p>Type Mobil : {{ $pembelian->mobil->type }}</p>
                        <p>Warna Mobil : {{ $pembelian->mobil->warna }}</p>
                        <p>Gambar Mobil : </p>
                        <div href="#mymodal"
                            data-toggle="modal"
                            data-target="#mymodal"
                            style="cursor: pointer"
                            onclick="showImage('{{ asset('storage/'.$pembelian->mobil->gambar) }}')">
                            <img src="{{ asset('storage/'.$pembelian->mobil->gambar) }}" alt="mobil-{{ $pembelian->mobil->merk }}" width="200">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($pembelian->type_pembayaran == 'kredit')
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Cicilan Pembeli</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Cicilan</th>
                                    <th>Status Cicilan</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Total Bayar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pembelian->cicilan as $item)
                                    <tr>
                                        <td>{{ $item->cicilan_ke }}</td>
                                        <td>{{ $item->kode_cicilan }}</td>
                                        <td>
                                            {{ str_replace('_',' ',$item->status_cicilan) }}
                                            @if ($item->status_cicilan == 'lunas')
                                                <span class="btn btn-success btn-circle" style="width: 19px; height: 27px">
                                                    <i class="fas fa-check" style="font-size: 11px"></i>
                                                </span>
                                            @else
                                                <span class="btn btn-danger btn-circle" style="width: 19px; height: 27px">
                                                    <i class="fas fa-exclamation-triangle" style="font-size: 11px"></i>
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $item->jatuh_tempo }}</td>
                                        <td>Rp. {{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                                        <td>
                                            <form action="{{ route('admin.cicilan.update', [$item->kode_transaksi, $item->kode_cicilan]) }}" method="POST" id="update-{{ $item->kode_cicilan }}">
                                                @csrf @method('POST')
                                            </form>
                                            <a href="{{ route('admin.pembelian.show', $item->kode_transaksi) }}" class="btn btn-primary btn-circle" style="width: 19px; height: 27px">
                                                <i class="fas fa-arrow-right" style="font-size: 11px"></i>
                                            </a>
                                            @if ($item->status_cicilan == 'belum_lunas')
                                                <button form="update-{{ $item->kode_cicilan }}" type="submit" class="btn btn-success btn-circle" style="width: 19px; height: 27px">
                                                    <i class="fas fa-pen" style="font-size: 11px"></i>
                                                </button>
                                            @endif
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
        @endif
    </div>
@endsection
