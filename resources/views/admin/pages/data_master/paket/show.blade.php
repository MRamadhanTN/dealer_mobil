@extends('admin.app') {{-- pastikan ini sesuai dengan file master layout utama --}}

@section('title', $title ?? 'Dashboard') {{-- title halaman dinamis --}}

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">DETAIL PAKET</h1>
            <a href="{{ route('admin.paket.edit', $paket->kode_paket) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> EDIT</a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>

            <div class="my-4">
                <form action="{{ route('admin.paket.store') }}" method="POST" enctype="multipart/form-data">
                    <x-form
                        label="Harga Min"
                        name="merk"
                        value="Rp. {{ number_format($paket->harga_min, 0, 0, '.') ?? '' }}"
                        readonly
                    />
                    <x-form
                        label="Harga Max"
                        name="type"
                        value="Rp. {{ number_format($paket->harga_max, 0, 0, '.') ?? '' }}"
                        readonly
                    />
                    <x-form
                        label="Uang Muka"
                        name="warna"
                        value="{{ $paket->uang_muka.'%' ?? '' }}"
                        readonly
                    />
                    <x-form
                        label="Jumlah Cicilan"
                        name="harga"
                        value="{{ $paket->jumlah_cicilan.' bulan' ?? '' }}"
                        readonly
                    />
                    <x-form
                        label="Bunga"
                        name="bunga"
                        value="{{ $paket->bunga.'%' ?? '' }}"
                        readonly
                    />
                </form>
            </div>
        </div>
    </div>
@endsection
