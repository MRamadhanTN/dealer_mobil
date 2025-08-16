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
                <form action="{{ route('admin.pembelian.store') }}" method="POST">
                    @csrf
                    @method('POST')

                    <x-form-select
                        label="Pilih Pembeli"
                        name="ktp"
                        :options="$pembeli"
                    />

                    <x-form-select
                        label="Pilih Mobil"
                        name="kode_mobil"
                        :options="$mobil->pluck('type', 'kode_mobil')"
                    />

                    <x-form-select
                        label="Pilih Metode Pembayaran"
                        name="type_pembayaran"
                        :default="[
                            'value' => request()->get('type-pembayaran'),
                            'label' => request()->get('type-pembayaran'),
                        ]"
                        :options="[
                            'cash' => 'Cash',
                            'kredit' => 'Kredit',
                        ]"
                    />

                    <div class="col-12 col-xl-8 mb-3" style="display: none" id="paket_detail">
                        <x-form-select
                            label="Pilih Paket"
                            name="kode_paket"
                            :options="$paket->pluck('kode_paket', 'kode_paket')"
                            :wraperattribute="false"
                            {{-- :custom="[
                                'id' => 'kode_paket',
                                'name' => ['kode_paket', ['Harga min.', 'harga_min'], 'harga_max', 'jumlah_cicilan']
                            ]" --}}
                        />
                        <div class="mt-3">
                            detail paket
                        </div>
                    </div>
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
        paket = document.getElementById("paket_detail")

        pembayaranSelect = document.getElementById("select_type_pembayaran")
        paketSelect = document.getElementById("select_kode_paket")
        mobilSelect = document.getElementById("select_kode_mobil")

        pembayaranSelect.addEventListener('change', function() {
            if (pembayaranSelect.value == 'kredit') {
                paket.style.display = "block"
            } else {
                paket.style.display = "none"
                paketSelect.value = null
            }
        })

        document.addEventListener('DOMContentLoaded', async function ()  {
            if (pembayaranSelect.value == 'kredit') {
                paket.style.display = "block"
            } else {
                paketSelect.value = null
            }
        })
    </script>
@endsection
