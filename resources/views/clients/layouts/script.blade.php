<script src="{{ asset('/template/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('/template/assets/js/vendor/popper.min.js') }}"></script>
<script src="{{ asset('/template/assets/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('/template/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
<script src="{{ asset('/template/assets/js/vendor/modernizr-3.11.2.min.js') }}"></script>

<!--Plugins JS-->
<script src="{{ asset('/template/assets/js/plugins/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('/template/assets/js/plugins/countdownTimer.min.js') }}"></script>
<script src="{{ asset('/template/assets/js/plugins/scrollup.js') }}"></script>
<script src="{{ asset('/template/assets/js/plugins/jquery.zoom.min.js') }}"></script>
<script src="{{ asset('/template/assets/js/plugins/slick.min.js') }}"></script>
<script src="{{ asset('/template/assets/js/plugins/infiniteslidev2.js') }}"></script>
<script src="{{ asset('/template/assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('/template/assets/js/plugins/jquery.sticky-sidebar.js') }}"></script>

<!-- Main Js -->
<script src="{{ asset('/template/assets/js/vendor/index.js') }}"></script>
<script src="{{ asset('/template/assets/js/main.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#add-to-cart-button').on('click', function(e) {
            e.preventDefault();

            var sizeChecked = document.querySelector('input[name="product_size_id"]:checked');
            var colorChecked = document.querySelector('input[name="product_color_id"]:checked');

            if (!sizeChecked || !colorChecked) {
                alert('Bạn cần phải chọn màu và kích thước');
                return;
            }

            var form = $('#add-to-cart-form');
            var formData = form.serialize();
            var url = form.attr('action');

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                success: function(response) {
                    alert('Sản phẩm đã được thêm vào giỏ hàng.');
                },
                error: function(xhr, status, error) {
                    alert('Bạn phải đăng nhập mới thêm được sản phẩm.');
                    window.location.href = '/login';
                }
            });
        });
    });
</script>

