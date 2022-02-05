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
                    <li class="breadcrumb-item active">Data Produk Beras </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h2>Data Produk Beras </h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="ProdTbl">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">No</th>
                                    <th width="10%">Jenis Beras</th>
                                    <th width="20%">Nama Produk</th>
                                    <th width="10%">Merk Produk</th>
                                    <th width="10%">Tahun</th>
                                    <th width="10%">Harga</th>
                                    <th width="10%">Persediaan Awal</th>
                                    <th width="10%">Sisa Persediaan</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('admin.produk.modal')

@endsection
@include('admin.produk.js')
