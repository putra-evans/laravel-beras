<div class="modal fade" id="add_produk">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #007BFF;color: white">
                <h4 class="modal-title">Tambah Data Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" method="POST" id="ProdukForm" autocomplete="off" enctype="multipart/form-data">
                <!-- CSRF TOKEN -->
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <input type="hidden" name="id_produk" id="id_produk" value="">

                <div class="modal-body">

                    <div class="mb-3 form-group">
                        <label for="judul_produk">Judul Produk</label>
                        <input type="text" class="form-control" id="judul_produk" name="judul_produk"
                            placeholder="Judul Produk">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="deskripsi_produk">Deskripsi Produk</label>
                        <textarea class="form-control" name="deskripsi_produk" id="deskripsi_produk" cols="30"
                            rows="5"></textarea>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6 form-group">
                            <label for="merk_produk">Merk Produk</label>
                            <input type="text" name="merk_produk" id="merk_produk" class="form-control"
                                placeholder="Merk">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="tahun_pembuatan_produk">Tahun</label>
                            <input type="number" class="form-control" min="0" name="tahun_pembuatan_produk"
                                id="tahun_pembuatan_produk" placeholder="Tahun">
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6 form-group">
                            <label for="city_id">Asal Beras</label>
                            <select class="form-control" id="city_id" name="city_id" style="width: 100%;">
                                <option value="" selected="selected">-- Pilih --</option>
                                @foreach($city_id as $pecah)
                                <option value="{{$pecah->city_id}}">{{ $pecah->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="tahun_pembuatan_produk">Jenis Beras</label>
                            <select name="id_kategori" id="id_kategori" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="row g-3  ">
                        <div class="col-md-6 form-group">
                            <label for="persediaan_awal">Persediaan Awal Stok</label>
                            <input type="number" class="form-control" min="0" name="persediaan_awal" id="persediaan_awal"
                                placeholder="Persediaan Awal">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="persediaan_sisa">Sisa Persediaan</label>
                            <input type="number" class="form-control" min="0" name="persediaan_sisa" id="persediaan_sisa"
                                placeholder="Sisa Persediaan">
                        </div>
                    </div>
                    <div class="mb-3 form-group">
                        <label for="harga_produk">Harga Produk</label>
                        <input type="number" min="0" name="harga_produk" id="harga_produk" class="form-control"
                            placeholder="Harga">
                    </div>
                    <div class="mb-3 form-group">
                        <label class="d-grid gap-2" for="nama">Foto Produk</label>
                        <div id="foto-produk-box" class="product-img d-none mb-2 text-center">
                            <img class="img-fluid" id="foto-produk-src" src="" alt="" width="50%">
                        </div>
                        <br>
                        <button id="upload_widget_opener" type="button" class="btn btn-info btn-sm">Upload</button>
                        <input type="hidden" id="foto_produk_url" name="foto_produk_url" value="null">
                    </div>

                </div>

                <div class="modal-footer justify-content-between">

                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

{{-- DETAIL --}}
<div class="modal fade" id="detail_produk">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #007BFF;color: white">
                <h4 class="modal-title">Detail Data Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">
                <section class="content">

                    <!-- Default box -->
                    <div class="card card-solid">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="col-12">
                                        <img src="" class="product-image" id="detailProdukImg" alt="Product Image">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 text-justify">
                                    <h3 class="my-3" id="JudulProduk"></h3>
                                    <p id="MerkProduk" style="font-style: italic"></p>
                                    <hr>
                                    <h4>Jenis Beras :</h4>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-default text-center active">
                                            <input type="radio" name="color_option" id="color_option_a1"
                                                autocomplete="off" checked>
                                            <span id="JenisBeras"></span>
                                        </label>
                                    </div>
                                    <br>
                                    <h4 class="mt-4">Harga :</h4>
                                    <div class="bg-gray py-2 px-3">
                                        <h2 class="mb-0" id="HargaProduk">
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <nav class="w-100">
                                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab"
                                            href="#product-desc" role="tab" aria-controls="product-desc"
                                            aria-selected="true">Deskripsi</a>
                                        <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab"
                                            href="#product-comments" role="tab" aria-controls="product-comments"
                                            aria-selected="false">Keterangan</a>
                                    </div>
                                </nav>
                                <div class="tab-content p-3" id="nav-tabContent">
                                    <div class="tab-pane fade show active DeskripsiProduk text-justify"
                                        id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> </div>
                                    <div class="tab-pane fade" id="product-comments" role="tabpanel"
                                        aria-labelledby="product-comments-tab">
                                        <table>
                                            <tr>
                                                <td>Tahun Produksi</td>
                                                <td>&emsp;:&nbsp;</td>
                                                <td style="font-weight: bold" id="tahunProduksi"></td>
                                            </tr>
                                            <tr>
                                                <td>Persediaan Awal</td>
                                                <td>&emsp;:&nbsp;</td>
                                                <td style="font-weight: bold" id="PersediaanAwal"></td>
                                            </tr>
                                            <tr>
                                                <td>Sisa Persediaan</td>
                                                <td>&emsp;:&nbsp;</td>
                                                <td style="font-weight: bold" id="SisaPersediaan"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
