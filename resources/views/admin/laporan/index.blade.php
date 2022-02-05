@extends('admin.index_admin')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data Laporan </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h4>Data Laporan Penjualan Per Bulan </h4>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <form method="post" id="FormPenjualan">
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <input type="month" class="form-control" name="bulan_penjualan" required>
                                <button class="btn btn-primary btn-sm mt-4 BtnCetakPenjualan">Cetak</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h4>Data Laporan Persediaan Per Bulan </h4>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <form method="post" id="FormPenjualan">
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <input type="month" class="form-control" name="bulan_persediaan" required>
                                <button class="btn btn-primary btn-sm mt-4 BtnCetakPersediaan">Cetak</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
@include('admin.laporan.js')
