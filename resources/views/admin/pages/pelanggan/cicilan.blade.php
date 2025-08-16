@extends('admin.app') {{-- pastikan ini sesuai dengan file master layout utama --}}

@section('title', $title ?? 'Dashboard') {{-- title halaman dinamis --}}

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">CICILAN</h1>
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
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kode Cicilan</th>
                                <th>Kode Transaksi</th>
                                {{-- <th>Pembeli</th> --}}
                                <th>Status</th>
                                <th>Total Bayar</th>
                                <th>Jatuh Tempo</th>
                                <th>Cicilan Ke-</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        {{-- <tfoot>
                        </tfoot> --}}
                        <tbody>
                            @forelse ($cicilan as $item)
                                <tr>
                                    <td>{{ $item->kode_cicilan }}</td>
                                    <td>{{ $item->kode_transaksi }}</td>
                                    {{-- <td>{{ $item->pembeli->nama }}</td> --}}
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
                                    <td>Rp. {{ number_format($item->total_bayar,0,0,'.') }}</td>
                                    <td>{{ $item->jatuh_tempo }}</td>
                                    <td>{{ $item->cicilan_ke }}</td>
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
    </div>
@endsection
