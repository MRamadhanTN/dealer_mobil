@extends('admin.app') {{-- pastikan ini sesuai dengan file master layout utama --}}

@section('title', $title ?? 'Dashboard') {{-- title halaman dinamis --}}

@section('content')
    <div class="container-fluid">

            {{-- <h1 class="h3 mb-0 text-gray-800">DETAIL MOBIL</h1> --}}

        {{-- </div> --}}

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                <h3 class="m-0 font-weight-bold text-primary">Detail Mobil</h3>
                <div>
                    <a href="{{ route('admin.mobil') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Kembali</a>
                    <a href="{{ route('admin.mobil.edit', $mobil->kode_mobil) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> EDIT</a>
                </div>
            </div>

            <div class="my-4">
                <form action="{{ route('admin.mobil.store') }}" method="POST" enctype="multipart/form-data">
                    <x-form
                        label="merk"
                        name="merk"
                        value="{{ $mobil->merk ?? '' }}"
                        placeholder="merk disini"
                        readonly
                    />
                    <x-form
                        label="type"
                        name="type"
                        value="{{ $mobil->type ?? '' }}"
                        placeholder="type disini"
                        readonly
                    />
                    <x-form
                        label="warna"
                        name="warna"
                        value="{{ $mobil->warna ?? '' }}"
                        placeholder="warna disini"
                        readonly
                    />
                    <x-form
                        label="harga"
                        name="harga"
                        value="Rp. {{ number_format($mobil->harga, 0, 0, '.') ?? '' }}"
                        readonly
                    />
                    <div class="col-12 col-xl-8 mb-3">
                        <label>Gambar</label>
                        <br>
                        <img src="{{ asset('storage/'. $mobil->gambar) }}" alt="gambar-mobil" height="300">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
