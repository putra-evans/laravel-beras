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


        $(".BtnCetakPenjualan").on("click", function (event) {
            event.preventDefault();
            var tglbln = $('input[name="bulan_penjualan"]').val();
            if (tglbln != '') {
                url = "{{ route('lap-penjualan') }}" + '?bulantahun=' + tglbln;
                window.location.href = url;
            } else {
                alert('Bulan dan Tahun Masih Kosong')
            }

        });

        $(".BtnCetakPersediaan").on("click", function (event) {
            event.preventDefault();
            var tglbln = $('input[name="bulan_persediaan"]').val();
            if (tglbln != '') {
                url = "{{ route('lap-persediaan') }}" + '?bulantahun=' + tglbln;
                window.location.href = url;
            } else {
                alert('Bulan dan Tahun Masih Kosong')
            }
        });
    });

</script>
@endsection
