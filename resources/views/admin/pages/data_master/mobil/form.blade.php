@extends('admin.app') {{-- pastikan ini sesuai dengan file master layout utama --}}

@section('title', $title ?? 'Dashboard') {{-- title halaman dinamis --}}

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                <h3 class="m-0 font-weight-bold text-primary">{{ $title }} Data Mobil</h3>
                <a href="{{ route('admin.mobil') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Kembali</a>
            </div>

            <div class="my-4 text-capitalize">
                <form action="{{ isset($mobil) ? route('admin.mobil.update', $mobil->kode_mobil) : route('admin.mobil.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <x-form
                        label="merk"
                        name="merk"
                        value="{{ $mobil->merk ?? '' }}"
                        placeholder="Masukan merk..."
                    />
                    <x-form
                        label="type"
                        name="type"
                        value="{{ $mobil->type ?? '' }}"
                        placeholder="Masukan type..."
                    />
                    <x-form
                        label="warna"
                        name="warna"
                        value="{{ $mobil->warna ?? '' }}"
                        placeholder="Masukan warna..."
                    />
                    <x-form
                        label="harga"
                        name="harga"
                        oninput="formatNumber(this)"
                        value="{{ $mobil->harga ?? '' }}"
                        placeholder="Masukan harga..."
                    />
                    <x-form
                        label="gambar"
                        name="gambar"
                        type="file"
                        value="{{ $mobil->gambar ?? '' }}"
                        placeholder="Masukan gambar..."
                    />
                    @if ($mobil)
                        <span href="#mymodal"
                            data-toggle="modal"
                            data-target="#mymodal"
                            style="cursor: pointer" class="mx-4"
                            onclick="showImage('{{ asset('storage/'.$mobil->gambar) }}')">

                            <img src="{{ asset('storage/'.$mobil->gambar) }}" alt="mobil-{{ $mobil->merk }}" height="100">
                        </span>
                    @endif
                    <div class="px-3 mt-3 d-flex justify-content-end">
                        <button class="btn btn-primary text-capitalize w-25">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('addon-script')
    <script>
        function formatNumber(input) {
            let value = input.value.replace(/\D/g, '');
            input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }
    </script>
@endsection
