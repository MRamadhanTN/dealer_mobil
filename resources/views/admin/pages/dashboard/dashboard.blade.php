@extends('admin.app') {{-- pastikan ini sesuai dengan file master layout utama --}}

@section('content')
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
		{{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
	</div>

	<!-- Content Row -->
	<div class="row">

		<!-- Total Mobil -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Total Mobil</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">
								{{ number_format($totalMobil, 0, ',', '.') }}
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-car fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Total Paket Kredit -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
								Total Paket Kredit</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">
								{{ number_format($totalPaketKredit, 0, ',', '.') }}
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Total Cash -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
								Total Cash</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">
								{{ number_format($totalCash, 0, ',', '.') }}
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Total Kredit -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-danger shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
								Total Kredit</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">
								{{ number_format($totalKredit, 0, ',', '.') }}
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-credit-card fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>


	<!-- Content Row -->
	<div class="row">
		<!-- Content Column -->
		<div class="col-lg-12 mb-2">
			<!-- Project Card Example -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Kredit Terbaru</h6>
				</div>
				<div class="card-body">
					<table class="table table-bordered" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Kode Cicilan</th>
								<th>Kode Transaksi</th>
								<th>Status</th>
								<th>Total Bayar</th>
								<th>Jatuh Tempo</th>
								<th>Cicilan Ke-</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@forelse($kreditTerbaru as $index => $order)
								<tr>
									<td>{{ $order->kode_transaksi }}</td>
									<td>{{ $order->pembeli->nama ?? '-' }}</td>
									<td>{{ $order->mobil->nama ?? '-' }}</td>
									<td>{{ $order->paket_kredit->nama ?? '-' }}</td>
									<td>
										@if ($order->cicilan->isNotEmpty())
											{{ $order->cicilan->first()->total_bayar }}
										@else
											-
										@endif
									</td>
								</tr>
							@empty
								<tr>
									<td colspan="5" class="text-center text-muted">Tidak ada kredit terbaru</td>
								</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<!-- Content Column -->
		<div class="col-lg-12 mb-2">
			<!-- Project Card Example -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Cash Terbaru</h6>
				</div>
				<div class="card-body">
					<table class="table table-bordered" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Kode Transaksi</th>
								<th>KTP</th>
								<th>Kode Mobil</th>
								<th>Total Harga</th>
								<th>Total Pembayaran</th>
								<th>Tanggal Bayar</th>
							</tr>
						</thead>
						<tbody>
							@forelse($cashTerbaru as $item)
								<tr>
									<td>{{ $item->kode_transaksi }}</td>
									<td>{{ $item->ktp }}</td>
									<td>{{ $item->kode_mobil }}</td>
									<td>{{ number_format($item->total_harga, 0, ',', '.') }}</td>
									<td>{{ number_format($item->total_pembayaran, 0, ',', '.') }}</td>
									<td>{{ $item->tanggal_bayar }}</td>
								</tr>
							@empty
								<tr>
									<td colspan="6" class="text-center">Tidak ada data</td>
								</tr>
							@endforelse
						</tbody>

					</table>
				</div>
			</div>
		</div>

		<!-- Content Column -->
		<div class="col-lg-12">
			<!-- Project Card Example -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Pembeli Terbaru</h6>
				</div>
				<div class="card-body">
					<table class="table table-bordered" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>KTP</th>
								<th>Nama</th>
								<th>Alamat</th>
								<th>Telp</th>
							</tr>
						</thead>
						<tbody>
							@forelse($pembeliTerbaru as $item)
								<tr>
									<td>{{ $item->ktp }}</td>
									<td>{{ $item->nama }}</td>
									<td>{{ $item->alamat }}</td>
									<td>{{ $item->telp }}</td>
								</tr>
							@empty
								<tr>
									<td colspan="4" class="text-center">Tidak ada data</td>
								</tr>
							@endforelse
						</tbody>

					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
