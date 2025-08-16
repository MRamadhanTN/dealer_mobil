@extends('admin.app') {{-- pastikan ini sesuai dengan file master layout utama --}}

@section('title', $title ?? 'Dashboard') {{-- title halaman dinamis --}}

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                <h3 class="m-0 font-weight-bold text-primary">Data Mobil</h3>
                <a href="{{ route('admin.mobil.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> TAMBAH</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Merk</th>
                                <th>Type</th>
                                <th>Warna</th>
                                <th>Harga</th>
                                <th>Gambar</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($mobil as $item)
                                <tr>
                                    <td>{{ $item->kode_mobil }}</td>
                                    <td>{{ $item->merk }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->warna }}</td>
                                    <td>Rp. {{ number_format($item->harga, 0, 0, '.') }}</td>
                                    <td>
                                        <span href="#mymodal"
                                            data-toggle="modal"
                                            data-target="#mymodal"
                                            style="cursor: pointer"
                                            onclick="showImage('{{ asset('storage/'.$item->gambar) }}')">

                                            <img src="{{ asset('storage/'.$item->gambar) }}" alt="mobil-{{ $item->merk }}" height="100">
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.mobil.delete', $item->kode_mobil) }}" method="post" id="del-{{ $item->kode_mobil }}">
                                            @csrf @method('DELETE')
                                        </form>
                                        <a href="{{ route('admin.mobil.show', $item->kode_mobil) }}" class="btn btn-primary btn-circle" style="width: 19px; height: 27px">
                                            <i class="fas fa-arrow-right" style="font-size: 11px"></i>
                                        </a>
                                        <a href="{{ route('admin.mobil.edit', $item->kode_mobil) }}" class="btn btn-success btn-circle" style="width: 19px; height: 27px">
                                            <i class="fas fa-pen" style="font-size: 11px"></i>
                                        </a>
                                        <button form="del-{{ $item->kode_mobil }}" type="submit" class="btn btn-danger btn-circle" style="width: 19px; height: 27px">
                                            <i class="fas fa-trash" style="font-size: 11px"></i>
                                        </button>
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
