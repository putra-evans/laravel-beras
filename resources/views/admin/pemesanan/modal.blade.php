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
                                <div class="col-12 col-sm-6 text-justify">
                                    <h5>Data Penerima :</h5>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <table>
                                            <tr>
                                                <td>Nama Penerima</td>
                                                <td>&emsp;:&nbsp;</td>
                                                <td style="font-weight: bold" id="NamaPenerima"></td>
                                            </tr>
                                            <tr>
                                                <td>No Hp Penerima</td>
                                                <td>&emsp;:&nbsp;</td>
                                                <td style="font-weight: bold" id="NoHP"></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat Penerima</td>
                                                <td>&emsp;:&nbsp;</td>
                                                <td style="font-weight: bold" id="Alamat"></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <br>
                                    <h5 class="mt-4">Total Bayar :</h5>
                                    <div class="bg-gray py-2 px-3">
                                        <h2 class="mb-0" id="TotalB">
                                        </h2>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 text-justify">
                                    <h5>Data Tujuan :</h5>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <table>
                                            <tr>
                                                <td>Provinsi</td>
                                                <td>&emsp;:&nbsp;</td>
                                                <td style="font-weight: bold" id="ProvTujuan"></td>
                                            </tr>
                                            <tr>
                                                <td>Kab/Kota</td>
                                                <td>&emsp;:&nbsp;</td>
                                                <td style="font-weight: bold" id="KotaTujuan"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <nav class="w-100">
                                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab"
                                            href="#product-desc" role="tab" aria-controls="product-desc"
                                            aria-selected="true">Produk</a>
                                        <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab"
                                            href="#product-comments" role="tab" aria-controls="product-comments"
                                            aria-selected="false">Jasa Pengiriman</a>
                                    </div>
                                </nav>
                                <div class="tab-content p-3" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="product-desc" role="tabpanel"
                                        aria-labelledby="product-desc-tab">
                                        <table class="table table-bordered table-hover" width="100%">
                                            <thead>
                                                <tr>
                                                    <th width="5%">No</th>
                                                    <th width="30%">Foto Produk</th>
                                                    <th width="30%">Nama Produk</th>
                                                    <th width="5%">Qty</th>
                                                    <th width="30%">Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody class="DetailPesanan">

                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane fade" id="product-comments" role="tabpanel"
                                        aria-labelledby="product-comments-tab">
                                        <table>
                                            <tr>
                                                <td>Jasa Kirim</td>
                                                <td>&emsp;:&nbsp;</td>
                                                <td style="font-weight: bold" id="JasaKirim"></td>
                                            </tr>
                                            <tr>
                                                <td>Berat Barang</td>
                                                <td>&emsp;:&nbsp;</td>
                                                <td style="font-weight: bold" id="BeratBarang"></td>
                                            </tr>
                                            <tr>
                                                <td>Ongkos Kirim</td>
                                                <td>&emsp;:&nbsp;</td>
                                                <td style="font-weight: bold" id="Ongkir"></td>
                                            </tr>
                                            <tr>
                                                <td>Estimasi</td>
                                                <td>&emsp;:&nbsp;</td>
                                                <td style="font-weight: bold" id="Estimasi"></td>
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

<div class="modal fade" id="bukti_pembayaran">
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
                        <form method="post" id="StatusForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-12 text-justify">
                                        <h5>Bukti Pembayaran :</h5>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id_pemesanan" id="id_pemesanan" value="">
                                            <img class="img-fluid" src="" alt="Bukti Pembayaran" id="BuktiP">
                                        </div>
                                        <a href="" id="LihatP" target="_blank">lihat gambar</a>
                                        <br>
                                        <hr>
                                        <h5 class="mt-4">Update Status Pesanan :</h5>
                                        <div class="py-2 px-3">
                                            <div class="col-12 col-sm-6 text-justify">
                                                <select name="update_status" id="update_status" class="form-control">
                                                    <option value="">-- Pilih --</option>
                                                    <option value="Pembayaran Diterima">Pembayaran Diterima</option>
                                                    <option value="Menyiapkan Pesanan">Menyiapkan Pesanan</option>
                                                    <option value="Pesanan Dikirim">Pesanan Dikirim</option>
                                                    <option value="Pembayaran Ditolak">Pembayaran Ditolak</option>
                                                    <option value="Dibatalkan">Dibatalkan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <h5 class="mt-4">No Resi Pengiriman :</h5>
                                        <div class="py-2 px-3">
                                            <div class="col-12 col-sm-6 text-justify">
                                                <input type="text" name="resi_pengiriman" id="resi_pengiriman" class="form-control" placeholder="Masukkan No Resi Pengiriman">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <button id="storeStatus" type="submit"
                                    class="btn btn-primary btn-sm float-right">Update</button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
