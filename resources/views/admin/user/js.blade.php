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
        var UserTbl = $("#UserTbl").DataTable({
            dom: 'Bfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],
            buttons: [{
                text: '<i class="fa fa-refresh"></i>  Reload',
                attr: {
                    'title': 'Refresh Table',
                    'class': 'btn btn-danger mr-1',
                },
                action: function (e, dt, node, config) {
                    dt.ajax.reload();
                }
            }],
            responsive: false,
            scrollX: true,
            autoWidth: false,
            ajax: "{{ route('halaman-user') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className: 'text-center'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    email: 'name'
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
        var validator = $('#UserForm').validate({
            ignore: [],
            rules: {
                nama_user: {
                    required: true,
                },
                email_user: {
                    required: true,
                }
            },
            messages: {
                nama_user: {
                    required: "Nama Tidak Boleh Kosong"
                },
                email_user: {
                    required: "Email Tidak Boleh Kosong"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });


        // DELETE DATA
        $(document).on('click', '#deleteBtn', function (e) {
            var data = UserTbl.row($(this).parents('tr')).data();

            swalWithBootstrapButtons.fire({
                title: 'Apakah ingin menghapus ' + data.name + '?',
                text: "Aksi ini tidak dapat dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Lanjutkan',
                cancelButtonText: 'Tidak, Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var formdata = $("#UserTbl").serialize();
                    $.ajax({
                        type: 'POST',
                        url: "{{route('hapus-user')}}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": data.id,
                        },

                        dataType: 'json', // let's set the expected response format
                        success: function (data) {
                            if (data.success) {
                                $('#modal-lg').modal('hide');
                                UserTbl.ajax.reload(null, false);
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
                        error: function (err) {
                            if (err.status == 422) {
                                $('.ajax-invalid').remove();
                                $.each(err.responseJSON.errors, function (i,
                                error) {
                                    var el = $(document).find('[name="' +
                                        i + '"]');
                                    el.after($('<span class="ajax-invalid" style="color: red;">' +
                                        error[0] + '</span>'));
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
        $(document).on('click', '#editBtn', function (e) {
            validator.resetForm();
            $(".modal-title").html('Edit Data User');
            var box = $(".modal-footer");
            box.empty();
            box.append(
                '<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>' +
                '<button id="updateItem" type="submit" class="btn btn-primary">Update</button>');
            var data = UserTbl.row($(this).parents('tr')).data();


            // TAMPIL DATA DI FORM EDIT
            $('#id_user').val(data.id);
            $('#nama_user').val(data.name);
            $('#email_user').val(data.email);


            $("#updateItem").on("click", function (event) {
                event.preventDefault();

                if ($("#UserForm").valid()) {
                    var formdata = $("#UserForm").serialize();
                    $.ajax({
                        type: 'POST',
                        url: "{{route('update-user')}}",
                        data: formdata,
                        dataType: 'json',
                        success: function (data) {
                            if (data.success) {
                                $('#modal-lg').modal('hide');
                                UserTbl.ajax.reload(null, false);
                                Toast.fire({
                                    icon: 'success',
                                    title: 'BERHASIL EDIT DATA USER.'
                                })
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'GAGAL.'
                                })
                            }
                        },
                        error: function (err) {
                            if (err.status == 422) {
                                $('.ajax-invalid').remove();
                                $.each(err.responseJSON.errors, function (i,
                                error) {
                                    var el = $(document).find('[name="' +
                                        i + '"]');
                                    el.after($('<span class="ajax-invalid" style="color: red;">' +
                                        error[0] + '</span>'));
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
