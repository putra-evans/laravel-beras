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
                    <li class="breadcrumb-item active">Data Kategori Beras </li>
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
                        <h2>Data Kategori Beras </h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="KatTbl">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th>Asal Beras</th>
                                    <th>Nama Kategori</th>
                                    <th>Keterangan</th>
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
@include('admin.kategori.modal')

@endsection
@include('admin.kategori.js')
