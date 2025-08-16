@extends('admin.app') {{-- pastikan ini sesuai dengan file master layout utama --}}

@section('title', $title ?? 'Dashboard') {{-- title halaman dinamis --}}

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title ?? 'TAMBAH' }} PAKET</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>

            <div class="my-4">
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ isset($paket) ? route('admin.paket.update', $paket->kode_paket) : route('admin.paket.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <x-form
                        label="harga min"
                        name="harga_min"
                        value="{{ $paket->harga_min ?? '' }}"
                        oninput="formatNumber(this)"
                        placeholder="harga min disini"
                    />
                    <x-form
                        label="harga max"
                        name="harga_max"
                        value="{{ $paket->harga_max ?? '' }}"
                        oninput="formatNumber(this)"
                        placeholder="harga max disini"
                    />
                    <x-form
                        label="uang muka (dalam persen)"
                        name="uang_muka"
                        type="number"
                        min="1" max="100"
                        value="{{ $paket->uang_muka ?? '' }}"
                        placeholder="uang muka disini"
                    />
                    <x-form
                        label="jumlah cicilan (dalam bulan)"
                        name="jumlah_cicilan"
                        type="number"
                        min="1"
                        value="{{ $paket->jumlah_cicilan ?? '' }}"
                        placeholder="jumlah cicilan disini"
                    />
                    <x-form
                        label="bunga per tahun (dalam persen)"
                        name="bunga"
                        type="number"
                        min="0" max="100"
                        value="{{ $paket->bunga ?? '' }}"
                        placeholder="bunga disini"
                    />
                    <div class="px-3 mt-3 d-flex justify-content-end">
                        <button class="btn btn-primary">submit</button>
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
