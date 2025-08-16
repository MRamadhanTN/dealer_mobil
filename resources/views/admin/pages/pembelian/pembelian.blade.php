@extends('admin.app') {{-- pastikan ini sesuai dengan file master layout utama --}}

@section('title', $title ?? 'Dashboard') {{-- title halaman dinamis --}}

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">PEMBELIAN {{ strtoupper(request()->get('type-pembayaran')) }}</h1>
            <a href="{{ route('admin.pembelian.create') }}?type-pembayaran={{ request()->get('type_pembayaran') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
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
                                <th>Pembeli</th>
                                <th>Kode Mobil</th>
                                @if (request()->get('type_pembayaran') == 'kredit')
                                    <th>Kode Paket</th>
                                @endif
                                <th>Total Harga</th>
                                <th>Total Pembayaran</th>
                                <th>Tanggal Bayar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        {{-- <tfoot>
                        </tfoot> --}}
                        <tbody>
                            @forelse ($pembelian as $item)
                                <tr>
                                    <td>{{ $item->kode_transaksi }}</td>
                                    <td>{{ $item->pembeli->nama }}</td>
                                    <td>{{ $item->kode_mobil }}</td>
                                    @if (request()->get('type_pembayaran') == 'kredit')
                                        <td>{{ $item->kode_paket }}</td>
                                    @endif
                                    <td>Rp. {{ number_format($item->total_harga,0,0,'.') }}</td>
                                    <td>Rp. {{ number_format($item->total_pembayaran,0,0,'.') }}</td>
                                    <td>{{ $item->tanggal_bayar }}</td>
                                    <td>
                                        <form action="{{ route('admin.pembelian.delete', $item->kode_transaksi) }}" method="post" id="del-{{ $item->kode_transaksi }}">
                                            @csrf @method('DELETE')
                                        </form>
                                        <a href="{{ route('admin.pembelian.show', $item->kode_transaksi) }}" class="btn btn-primary btn-circle" style="width: 19px; height: 27px">
                                            <i class="fas fa-arrow-right" style="font-size: 11px"></i>
                                        </a>
                                        <button form="del-{{ $item->kode_transaksi }}" type="submit" class="btn btn-danger btn-circle" style="width: 19px; height: 27px">
                                            <i class="fas fa-trash" style="font-size: 11px"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ request()->get('type-pembayaran') == 'kredit' ? 8 : 7 }}">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
