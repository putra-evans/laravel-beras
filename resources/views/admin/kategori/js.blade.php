@section('script')
<script>
    $(function () {
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
        confirmButton: 'btn btn-success ml-2',
        cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
})
        var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        });
        'use strict';
        var KatTbl = $("#KatTbl").DataTable({
            dom: 'Bfrtip',
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10 rows', '25 rows', '50 rows', 'Show all' ]
            ],
            buttons: [
                // 'pageLength',
                {
                    text: '<i class="fa fa-plus-circle"></i> Add Data',
                    attr: {
                        'title': 'Entry New Data',
                        'data-bs-original-title': 'Entry New Data',
                        'data-toggle':'modal',
                        'data-target':'#modal-lg',
                        'type': 'button',
                        'id': 'addBtn',
                        'class': 'btn btn-primary mr-1 ml-1'
                    },
                    action: function (e, dt, node, config) {
                        // alert('Button activated');
                    }
                },
                {
                    text: '<i class="fa fa-refresh"></i>  Reload',
                    attr: {
                        'title': 'Refresh Table',
                        'class': 'btn btn-danger mr-1',
                    },
                    action: function (e, dt, node, config) {
                        dt.ajax.reload();
                    }
                }
            ],
            responsive: false,
            scrollX: true,
            autoWidth: false,
            ajax: "{{ route('halaman-kategori') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className: 'text-center'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'nama_kategori',
                    name: 'nama_kategori'
                },
                {
                    data: 'ket_kategori',
                    name: 'ket_kategori'
                },
                {
                    data: 'action',
                    name: 'action',
                    className: 'text-center'
                },
            ],
            columnDefs: [{
                orderable: false,
                targets: [0, 1, 2]
            }],
        });

        // VALIDASI FORM
        var validator = $('#kategoriForm').validate({
            ignore: [],
            rules: {
                id_city: {
                    required: true,
                },
                nama_kategori: {
                    required: true,
                },
                ket_kategori: {
                    required: true,
                }
            },
            messages: {
                id_city: {
                    required: "Asal Beras Tidak Boleh Kosong"
                },
                nama_kategori: {
                    required: "Nama Kategori Tidak Boleh Kosong"
                },
                ket_kategori: {
                    required: "Kategori Tidak Boleh Kosong"
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        // ADD DATA
        $("#addBtn").on("click", function() {
            $('#kategoriForm')[0].reset();
            validator.resetForm();
            var box = $(".modal-footer");
            box.empty();
            box.append('<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>' +
                '<button id="storeKategori" type="submit" class="btn btn-primary">Simpan</button>');

            $("#storeKategori").on("click", function(event) {
                event.preventDefault();
                if ($("#kategoriForm").valid()) {
                    var formdata = $("#kategoriForm").serialize(); // here $(this) refere to the form its submitting
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('simpan-kategori') }}",
                        data: formdata, // here $(this) refers to the ajax object not form
                        dataType: 'json', // let's set the expected response format
                        success: function(data) {
                            KatTbl.ajax.reload(null, false)
                            $('#modal-lg').modal('hide');
                            Toast.fire({
                            icon: 'success',
                            title: 'BERHASIL INSERT DATA KATEGORI BERAS.'
                            })
                        },
                        error: function(err) {
                            if (err.status == 422) { // when status code is 422, it's a validation issue
                                $('.ajax-invalid').remove();
                                $.each(err.responseJSON.errors, function(i, error) {
                                    var el = $(document).find('[name="' + i + '"]');
                                    el.after($('<span class="ajax-invalid" style="color: red;">' + error[0] + '</span>'));
                                });
                            } else if (err.status == 403) {
                                Toast.fire({
                                icon: 'error',
                                title: 'GAGAL.'
                                })
                            }
                        }
                    });
                }
            });
        });

    // DELETE DATA
    $(document).on('click', '#deleteBtn', function(e) {
        var data = KatTbl.row($(this).parents('tr')).data();

        swalWithBootstrapButtons.fire({
            title: 'Apakah ingin menghapus ' + data.nama_kategori + '?',
            text: "Aksi ini tidak dapat dibatalkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Lanjutkan',
            cancelButtonText: 'Tidak, Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                var formdata = $("#KatTbl").serialize();
                $.ajax({
                    type: 'POST',
                    url: "{{route('hapus-kategori')}}",
                    data:
                        {
                            "_token": "{{ csrf_token() }}",
                            "id": data.id_kategori,
                        },

                    dataType: 'json', // let's set the expected response format
                    success: function(data) {
                        if (data.success) {
                            $('#modal-lg').modal('hide');
                            KatTbl.ajax.reload(null, false);
                            swalWithBootstrapButtons.fire(
                                'Terhapus!',
                                'Data Berhasil Dihapus.',
                                'success'
                            )
                        } else {
                            Swal.fire(
                                'Error!',
                                data.message,
                                'error'
                            );
                        }
                    },
                    error: function(err) {
                        if (err.status == 422) {
                            $('.ajax-invalid').remove();
                            $.each(err.responseJSON.errors, function(i, error) {
                                var el = $(document).find('[name="' + i + '"]');
                                el.after($('<span class="ajax-invalid" style="color: red;">' + error[0] + '</span>'));
                            });
                        } else if (err.status == 403) {
                            Swal.fire(
                                'Unauthorized!',
                                'You are unauthorized to do the action',
                                'warning'
                            );
                        }
                    }
                });
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan',
                    )
                }
            });
        });

        // EDIT DATA
        $(document).on('click', '#editBtn', function(e) {
            $('#kategoriForm')[0].reset();
            validator.resetForm();
            $(".modal-title").html('Edit Kategori Beras');
            var box = $(".modal-footer");
            box.empty();
            box.append('<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>' +
                '<button id="updateItem" type="submit" class="btn btn-primary">Update</button>');
            var data = KatTbl.row($(this).parents('tr')).data();

            // TAMPIL DATA DI FORM EDIT
            $('#id_kategori').val(data.id_kategori);
            // $("#id_city option[data-value='" + data.id_city +"']").attr("selected","selected");
            $("#id_city").val(data.id_city).change();
            $('#nama_kategori').val(data.nama_kategori);
            $('#ket_kategori').val(data.ket_kategori);


            $("#updateItem").on("click", function(event) {
                event.preventDefault();

                if ($("#kategoriForm").valid()) {
                    var formdata = $("#kategoriForm").serialize();
                    $.ajax({
                        type: 'POST',
                        url: "{{route('update-kategori')}}",
                        data:formdata,
                        dataType: 'json',
                        success: function(data) {
                            if (data.success) {
                                $('#modal-lg').modal('hide');
                                KatTbl.ajax.reload(null, false);
                                Toast.fire({
                                icon: 'success',
                                title: 'BERHASIL EDIT DATA KATEGORI BERAS.'
                            })
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'GAGAL.'
                                })
                            }
                        },
                        error: function(err) {
                            if (err.status == 422) {
                                $('.ajax-invalid').remove();
                                $.each(err.responseJSON.errors, function(i, error) {
                                    var el = $(document).find('[name="' + i + '"]');
                                    el.after($('<span class="ajax-invalid" style="color: red;">' + error[0] + '</span>'));
                                });
                            } else if (err.status == 403) {
                                Swal.fire(
                                    'Unauthorized!',
                                    'You are unauthorized to do the action',
                                    'warning'
                                );
                            }
                        }
                    });
                }
            });
        });
    });

</script>
@endsection
