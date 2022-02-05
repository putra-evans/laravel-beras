<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #007BFF;color: white">
                <h4 class="modal-title">Tambah Kategori Beras</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" id="UserForm" autocomplete="off">
                <!-- CSRF TOKEN -->
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <input type="hidden" name="id_user" id="id_user" value="">

                <div class="modal-body">
                    <div class="mb-3 form-group">
                        <label for="nama_user">Nama User</label>
                        <input type="text" class="form-control" id="nama_user" name="nama_user" >
                    </div>
                    <div class="mb-3 form-group">
                        <label for="email_user">Email User</label>
                        <input type="text" class="form-control" id="email_user" name="email_user" >
                    </div>
                    <div class="mb-3 form-group">
                        <label for="password_baru">Masukkan Password Baru</label>
                        <input type="text" class="form-control" id="password_baru" name="password_baru" >
                        <span style="font-size: 11px;color: red">Kosongkan jika tidak ingin ganti password</span>
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
