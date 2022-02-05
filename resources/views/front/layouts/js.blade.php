{{-- <script src="{{asset('assets_front/vendor/jquery/jquery-3.2.1.min.js')}}"></script> --}}

<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>

<script src="{{asset('assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>

<!--===============================================================================================-->
	<script src="{{asset('assets_front/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('assets_front/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('assets_front/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('assets_front/vendor/select2/select2.min.js')}}"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="{{asset('assets_front/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('assets_front/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('assets_front/vendor/slick/slick.min.js')}}"></script>
	<script src="{{asset('assets_front/js/slick-custom.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('assets_front/vendor/parallax100/parallax100.js')}}"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="{{asset('assets_front/vendor/MagnificPopup/jquery.magnific-popup.min.js')}}"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
<!--===============================================================================================-->
	<script src="{{asset('assets_front/vendor/isotope/isotope.pkgd.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('assets_front/vendor/sweetalert/sweetalert.min.js')}}"></script>
	<script>
		$('.js-addwish-b2').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/


	</script>
<!--===============================================================================================-->
	<script src="{{asset('assets_front/vendor/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
<!--===============================================================================================-->
	<script src="{{asset('assets_front/js/main.js')}}"></script>
<script src="https://upload-widget.cloudinary.com/global/all.js" type="text/javascript"></script>




<script>
    $(document).ready(function () {
        totalkeranjang();
    });

    $('.BtnKeranjang').click(function(){
        url = "{{ route('view-cart') }}";
        var user_id = $('#UserId').val();
        if (user_id != '') {
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id_user' : user_id,
                },
                dataType: "json",
                success: function (response) {
                    var html = '';
                    var total_seluruh =0;
                $.each(response, function(index, item){
                    total_seluruh += item.total_harga;
                    var harga = (item.harga_produk).toLocaleString(
                        undefined,
                        { minimumFractionDigits: 0 }
                        );
                    html += `
                    <li class="header-cart-item flex-w flex-t m-b-12">
                        <div class="header-cart-item-img">
                            <img src="${item.foto_produk_url}" alt="IMG">
                        </div>

                        <div class="header-cart-item-txt p-t-8">
                            <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                ${item.judul_produk}
                            </a>

                            <span class="header-cart-item-info">
                                ${item.qty} x ${harga}
                            </span>
                        </div>
                    </li>
                            `;
                });
                var TotalS = (total_seluruh).toLocaleString(
                        undefined,
                        { minimumFractionDigits: 0 }
                        );
                $(".TotalAkhir").html('Total : Rp. '+TotalS);
                var box = $(".ListKeranjang");
                box.empty();
                box.append(html);
                }
            });
        } else {
            swal(nameProduct, "Gagal", "errors");
        }
    });

    function totalkeranjang(){
        var url = "{{ route('count-cart') }}";
        var user_id = $('#UserId').val();
        $.ajax({
            type: "POST",
            url: url,
            data: {
                    '_token': '{{ csrf_token() }}',
                    'id_user' : user_id,
                },
            dataType: "json",
            success: function (response) {
                var count = response[0]['total'];
                if (user_id != '') {
                    $('#TotKeranjang').attr("data-notify", count);
                    $('#TotKeranjangMobile').attr("data-notify", count);
                } else {
                    $('#TotKeranjang').attr("data-notify", '0');
                    $('#TotKeranjangMobile').attr("data-notify", '0');
                }

            }
        });
    }

</script>
