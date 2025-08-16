@extends('admin.app') {{-- pastikan ini sesuai dengan file master layout utama --}}

@section('title', $title ?? 'Dashboard') {{-- title halaman dinamis --}}

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title ?? 'TAMBAH' }} PEMBELI</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>

            <div class="my-4">
                <form action="{{ isset($pembeli) ? route('admin.pembeli.update', $pembeli->ktp) : route('admin.pembeli.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <x-form
                        label="ktp"
                        name="ktp"
                        value="{{ $pembeli->ktp ?? '' }}"
                        placeholder="ktp disini"
                    />
                    <x-form
                        label="nama"
                        name="nama"
                        value="{{ $pembeli->nama ?? '' }}"
                        placeholder="nama disini"
                    />
                    <x-form
                        label="telp"
                        name="telp"
                        value="{{ $pembeli->telp ?? '' }}"
                        placeholder="telp disini"
                    />
                    <x-textarea
                        label="alamat"
                        name="alamat"
                        value="{{ $pembeli->alamat ?? '' }}"
                        placeholder="alamat disini"
                    />
                    <div class="px-3 mt-3 d-flex justify-content-end">
                        <button class="btn btn-primary">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
