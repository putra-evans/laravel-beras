<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #007BFF;color: white">
                <h4 class="modal-title">Tambah Kategori Beras</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" id="kategoriForm" autocomplete="off">
                <!-- CSRF TOKEN -->
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <input type="hidden" name="id_kategori" id="id_kategori" value="">

                <div class="modal-body">

                    <div class="mb-3 form-group">
                        <label for="id_city">Asal Beras</label>
                        <select class="form-control" name="id_city" id="id_city" required>
                            <option value="">-- Pilih --</option>
                            @foreach ($kabkota as $kabkota =>$value )
                            <option value="{{$kabkota}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 form-group">
                        <label for="nama_kategori">Nama Kategori Beras</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Nama kategori Beras">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="ket_kategori">Keterangan Beras</label>
                        <textarea class="form-control" name="ket_kategori" id="ket_kategori" cols="30" rows="5"></textarea>
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
