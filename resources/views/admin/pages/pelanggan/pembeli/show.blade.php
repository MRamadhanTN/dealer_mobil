@extends('admin.app') {{-- pastikan ini sesuai dengan file master layout utama --}}

@section('title', $title ?? 'Dashboard') {{-- title halaman dinamis --}}

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">DETAIL PEMBELI</h1>
            <a href="{{ route('admin.pembeli.edit', $pembeli->ktp) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> EDIT</a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>

            <div class="my-4">
                <form action="{{ route('admin.pembeli.store') }}" method="POST" enctype="multipart/form-data">
                    <x-form
                        label="ktp"
                        name="ktp"
                        value="{{ $pembeli->ktp ?? '' }}"
                        placeholder="ktp disini"
                        readonly
                    />
                    <x-form
                        label="nama"
                        name="nama"
                        value="{{ $pembeli->nama ?? '' }}"
                        placeholder="nama disini"
                        readonly
                    />
                    <x-form
                        label="telp"
                        name="telp"
                        value="{{ $pembeli->telp ?? '' }}"
                        placeholder="telp disini"
                        readonly
                    />
                    <x-textarea
                        label="alamat"
                        name="alamat"
                        value="{{ $pembeli->alamat ?? '' }}"
                        placeholder="alamat disini"
                        readonly
                    />
                </form>
            </div>
        </div>
    </div>
@endsection
