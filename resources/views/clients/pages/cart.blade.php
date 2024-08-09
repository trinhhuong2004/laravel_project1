<!-- Ec breadcrumb start -->
@extends('clients.layouts.index')

@section('content')
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Giỏ hàng</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="ec-breadcrumb-item active">Đơn Hàng</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec cart page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-cart-leftside col-lg-8 col-md-12">
                    <!-- cart content Start -->
                    <div class="ec-cart-content">
                        <div class="ec-cart-inner">
                            <div class="row">
                                <form id="cart-form">
                                    @csrf
                                    <div class="table-content cart-table-content">
                                        <table class="text-center">
                                            <thead>
                                            <tr>
                                                <th>Tên sản phẩm</th>
                                                <th style="text-align: center">Giá</th>
                                                <th>Số lượng</th>
                                                <th>Tổng tiền</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($productVariants as $key => $item)
                                                <tr data-product-id="{{ $item->product_variant_id }}"
                                                    data-price="{{ $item->product_price_sale_variant ? $item->product_price_sale_variant : $item->product_price_variant }}">
                                                    <td data-label="Product" class="ec-cart-pro-name"
                                                        style="width: 300px">
                                                        <a href="#" style="font-size: 13px">
                                                            <img class="ec-cart-pro-img mr-3"
                                                                 src="{{ Storage::url($item->product_img_thumb) }}"
                                                                 alt=""/>
                                                            {{ $item->product_name }}<br>
                                                            Phân loại: {{ $item->variant_color_name }}
                                                            x {{ $item->variant_size_name }}
                                                        </a>
                                                    </td>
                                                    <td data-label="Price" class="ec-cart-pro-price"
                                                        style="text-align: center">
                                                        @if($item->product_price_sale_variant)
                                                            <span class="text-danger price">{{ number_format($item->product_price_sale_variant, 0, '', '.') }}đ</span>
                                                            <span class="text-gray"
                                                                  style="text-decoration: line-through">{{ number_format($item->product_price_variant, 0, '', '.') }}đ</span>
                                                        @else
                                                            <span class="text-danger price">{{ number_format($item->product_price_variant, 0, '', '.') }}đ</span>
                                                        @endif
                                                    </td>
                                                    <td data-label="Quantity" class="ec-cart-pro-qty"
                                                        style="text-align: center;">
                                                        <div class="quantity-control" style="position: relative">
                                                            <button type="button" class="quantity-btn minus"
                                                                    style="position: absolute; top: 9px; left: 10px">-
                                                            </button>
                                                            <input class="quantity-input" type="number"
                                                                   name="cartItems[{{ $key }}][quantity]"
                                                                   value="{{ $item->quantity }}" min="1"
                                                                   style="padding-left: 40px; width: 100px; height:45px"/>
                                                            <button type="button" class="quantity-btn plus"
                                                                    style="position: absolute; top: 9px; right: 10px">+
                                                            </button>
                                                            <input type="hidden"
                                                                   name="cartItems[{{ $key }}][product_id]"
                                                                   value="{{ $item->product_variant_id }}">
                                                        </div>
                                                    </td>
                                                    <td data-label="Total" class="ec-cart-pro-subtotal">
                                                        {{ number_format(($item->product_price_sale_variant ? $item->product_price_sale_variant : $item->product_price_variant) * $item->quantity, 0, '', '.') }}
                                                        đ
                                                    </td>
                                                    <td data-label="Remove" class="pro-remove">
                                                        <a href="#"><i class="ecicon eci-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="ec-cart-update-bottom">
                                                <a href="#">Tiếp tục mua</a>
                                                <button class="btn btn-primary" id="update-cart" type="button">Cập
                                                    nhật
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>

                    <!-- cart content End -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="ec-cart-rightside col-lg-4 col-md-12">
                    <div class="ec-sidebar-wrap">
                        <!-- Sidebar Summary Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Tổng đơn hàng</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <div class="ec-cart-summary-bottom">
                                    <div class="ec-cart-summary">
                                        <div>
                                            <span class="text-left">Tạm tính</span>
                                            <span class="text-right sub-total" id="sub-total">{{ number_format($subTotal, 0, '', '.') }}đ</span>
                                        </div>
                                        <div>
                                            <span class="text-left">Phí vận chuyển</span>
                                            <span class="text-right shipping" id="shipping">{{ number_format($shipping, 0, '', '.') }}đ</span>
                                        </div>
                                        <div>
                                            <span class="text-left">Mã giảm giá</span>
                                            <span class="text-right"><a class="ec-cart-coupan">Áp dụng</a></span>
                                        </div>
                                        <div class="ec-cart-coupan-content">
                                            <form class="ec-cart-coupan-form" name="ec-cart-coupan-form" method="post"
                                                  action="#">
                                                <input class="ec-coupan" type="text" required=""
                                                       placeholder="Nhập mã giảm giá" name="ec-coupan" value="">
                                                <button class="ec-coupan-btn button btn-primary" type="submit"
                                                        name="subscribe" value="">Áp
                                                </button>
                                            </form>
                                        </div>
                                        <div class="ec-cart-summary-total">
                                            <span class="text-left">Tổng tiền</span>
                                            <span class="text-right total-amount" id="total-amount">{{ number_format($totalAmount, 0, '', '.') }}đ</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-end mt-3">
                                            <a href="{{ route('checkout') }}">
                                                <button class="btn btn-primary">Thanh Toán</button>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Summary Block -->
                    </div>
                </div>
            </div>
        </div>
    </section>





    <!-- New Product Start -->
    <section class="section ec-new-product section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">New Arrivals</h2>
                        <h2 class="ec-title">New Arrivals</h2>
                        <p class="sub-title">Browse The Collection of Top Products</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- New Product Content -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                    <div class="ec-product-inner">
                        <div class="ec-pro-image-outer">
                            <div class="ec-pro-image">
                                <a href="product-left-sidebar.html" class="image">
                                    <img class="main-image" src="template/assets/images/product-image/6_1.jpg"
                                         alt="Product"/>
                                    <img class="hover-image" src="template/assets/images/product-image/6_2.jpg"
                                         alt="Product"/>
                                </a>
                                <span class="percentage">20%</span>
                                <a href="#" class="quickview" data-link-action="quickview" title="Quick view"
                                   data-bs-toggle="modal" data-bs-target="#ec_quickview_modal"><i
                                        class="fi-rr-eye"></i></a>
                                <div class="ec-pro-actions">
                                    <a href="compare.html" class="ec-btn-group compare" title="Compare"><i
                                            class="fi fi-rr-arrows-repeat"></i></a>
                                    <button title="Add To Cart" class="add-to-cart"><i
                                            class="fi-rr-shopping-basket"></i> Add To Cart
                                    </button>
                                    <a class="ec-btn-group wishlist" title="Wishlist"><i class="fi-rr-heart"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="ec-pro-content">
                            <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Round Neck T-Shirt</a></h5>
                            <div class="ec-pro-rating">
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star"></i>
                            </div>
                            <div class="ec-pro-list-desc">Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry. Lorem Ipsum is simply dutmmy text ever since the 1500s, when an
                                unknown printer took a galley.
                            </div>
                            <span class="ec-price">
                                <span class="old-price">$27.00</span>
                                <span class="new-price">$22.00</span>
                            </span>
                            <div class="ec-pro-option">
                                <div class="ec-pro-color">
                                    <span class="ec-pro-opt-label">Color</span>
                                    <ul class="ec-opt-swatch ec-change-img">
                                        <li class="active"><a href="#" class="ec-opt-clr-img"
                                                              data-src="template/assets/images/product-image/6_1.jpg"
                                                              data-src-hover="template/assets/images/product-image/6_1.jpg"
                                                              data-tooltip="Gray"><span
                                                    style="background-color:#e8c2ff;"></span></a>
                                        </li>
                                        <li><a href="#" class="ec-opt-clr-img"
                                               data-src="template/assets/images/product-image/6_2.jpg"
                                               data-src-hover="template/assets/images/product-image/6_2.jpg"
                                               data-tooltip="Orange"><span
                                                    style="background-color:#9cfdd5;"></span></a></li>
                                    </ul>
                                </div>
                                <div class="ec-pro-size">
                                    <span class="ec-pro-opt-label">Size</span>
                                    <ul class="ec-opt-size">
                                        <li class="active"><a href="#" class="ec-opt-sz" data-old="$25.00"
                                                              data-new="$20.00" data-tooltip="Small">S</a></li>
                                        <li><a href="#" class="ec-opt-sz" data-old="$27.00" data-new="$22.00"
                                               data-tooltip="Medium">M</a></li>
                                        <li><a href="#" class="ec-opt-sz" data-old="$35.00" data-new="$30.00"
                                               data-tooltip="Extra Large">XL</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                    <div class="ec-product-inner">
                        <div class="ec-pro-image-outer">
                            <div class="ec-pro-image">
                                <a href="product-left-sidebar.html" class="image">
                                    <img class="main-image" src="template/assets/images/product-image/7_1.jpg"
                                         alt="Product"/>
                                    <img class="hover-image" src="template/assets/images/product-image/7_2.jpg"
                                         alt="Product"/>
                                </a>
                                <span class="percentage">20%</span>
                                <span class="flags">
                                    <span class="sale">Sale</span>
                                </span>
                                <a href="#" class="quickview" data-link-action="quickview" title="Quick view"
                                   data-bs-toggle="modal" data-bs-target="#ec_quickview_modal"><i
                                        class="fi-rr-eye"></i></a>
                                <div class="ec-pro-actions">
                                    <a href="compare.html" class="ec-btn-group compare" title="Compare"><i
                                            class="fi fi-rr-arrows-repeat"></i></a>
                                    <button title="Add To Cart" class="add-to-cart"><i
                                            class="fi-rr-shopping-basket"></i> Add To Cart
                                    </button>
                                    <a class="ec-btn-group wishlist" title="Wishlist"><i class="fi-rr-heart"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="ec-pro-content">
                            <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Full Sleeve Shirt</a></h5>
                            <div class="ec-pro-rating">
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star"></i>
                            </div>
                            <div class="ec-pro-list-desc">Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry. Lorem Ipsum is simply dutmmy text ever since the 1500s, when an
                                unknown printer took a galley.
                            </div>
                            <span class="ec-price">
                                <span class="old-price">$12.00</span>
                                <span class="new-price">$10.00</span>
                            </span>
                            <div class="ec-pro-option">
                                <div class="ec-pro-color">
                                    <span class="ec-pro-opt-label">Color</span>
                                    <ul class="ec-opt-swatch ec-change-img">
                                        <li class="active"><a href="#" class="ec-opt-clr-img"
                                                              data-src="template/assets/images/product-image/7_1.jpg"
                                                              data-src-hover="template/assets/images/product-image/7_1.jpg"
                                                              data-tooltip="Gray"><span
                                                    style="background-color:#01f1f1;"></span></a>
                                        </li>
                                        <li><a href="#" class="ec-opt-clr-img"
                                               data-src="template/assets/images/product-image/7_2.jpg"
                                               data-src-hover="template/assets/images/product-image/7_2.jpg"
                                               data-tooltip="Orange"><span
                                                    style="background-color:#b89df8;"></span></a></li>
                                    </ul>
                                </div>
                                <div class="ec-pro-size">
                                    <span class="ec-pro-opt-label">Size</span>
                                    <ul class="ec-opt-size">
                                        <li class="active"><a href="#" class="ec-opt-sz" data-old="$12.00"
                                                              data-new="$10.00" data-tooltip="Small">S</a></li>
                                        <li><a href="#" class="ec-opt-sz" data-old="$15.00" data-new="$12.00"
                                               data-tooltip="Medium">M</a></li>
                                        <li><a href="#" class="ec-opt-sz" data-old="$20.00" data-new="$17.00"
                                               data-tooltip="Extra Large">XL</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                    <div class="ec-product-inner">
                        <div class="ec-pro-image-outer">
                            <div class="ec-pro-image">
                                <a href="product-left-sidebar.html" class="image">
                                    <img class="main-image" src="template/assets/images/product-image/1_1.jpg"
                                         alt="Product"/>
                                    <img class="hover-image" src="template/assets/images/product-image/1_2.jpg"
                                         alt="Product"/>
                                </a>
                                <span class="percentage">20%</span>
                                <span class="flags">
                                    <span class="sale">Sale</span>
                                </span>
                                <a href="#" class="quickview" data-link-action="quickview" title="Quick view"
                                   data-bs-toggle="modal" data-bs-target="#ec_quickview_modal"><i
                                        class="fi-rr-eye"></i></a>
                                <div class="ec-pro-actions">
                                    <a href="compare.html" class="ec-btn-group compare" title="Compare"><i
                                            class="fi fi-rr-arrows-repeat"></i></a>
                                    <button title="Add To Cart" class="add-to-cart"><i
                                            class="fi-rr-shopping-basket"></i> Add To Cart
                                    </button>
                                    <a class="ec-btn-group wishlist" title="Wishlist"><i class="fi-rr-heart"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="ec-pro-content">
                            <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Cute Baby Toy's</a></h5>
                            <div class="ec-pro-rating">
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star"></i>
                            </div>
                            <div class="ec-pro-list-desc">Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry. Lorem Ipsum is simply dutmmy text ever since the 1500s, when an
                                unknown printer took a galley.
                            </div>
                            <span class="ec-price">
                                <span class="old-price">$40.00</span>
                                <span class="new-price">$30.00</span>
                            </span>
                            <div class="ec-pro-option">
                                <div class="ec-pro-color">
                                    <span class="ec-pro-opt-label">Color</span>
                                    <ul class="ec-opt-swatch ec-change-img">
                                        <li class="active"><a href="#" class="ec-opt-clr-img"
                                                              data-src="template/assets/images/product-image/1_1.jpg"
                                                              data-src-hover="template/assets/images/product-image/1_1.jpg"
                                                              data-tooltip="Gray"><span
                                                    style="background-color:#90cdf7;"></span></a>
                                        </li>
                                        <li><a href="#" class="ec-opt-clr-img"
                                               data-src="template/assets/images/product-image/1_2.jpg"
                                               data-src-hover="template/assets/images/product-image/1_2.jpg"
                                               data-tooltip="Orange"><span
                                                    style="background-color:#ff3b66;"></span></a></li>
                                        <li><a href="#" class="ec-opt-clr-img"
                                               data-src="template/assets/images/product-image/1_3.jpg"
                                               data-src-hover="template/assets/images/product-image/1_3.jpg"
                                               data-tooltip="Green"><span style="background-color:#ffc476;"></span></a>
                                        </li>
                                        <li><a href="#" class="ec-opt-clr-img"
                                               data-src="template/assets/images/product-image/1_4.jpg"
                                               data-src-hover="template/assets/images/product-image/1_4.jpg"
                                               data-tooltip="Sky Blue"><span
                                                    style="background-color:#1af0ba;"></span></a></li>
                                    </ul>
                                </div>
                                <div class="ec-pro-size">
                                    <span class="ec-pro-opt-label">Size</span>
                                    <ul class="ec-opt-size">
                                        <li class="active"><a href="#" class="ec-opt-sz" data-old="$40.00"
                                                              data-new="$30.00" data-tooltip="Small">S</a></li>
                                        <li><a href="#" class="ec-opt-sz" data-old="$50.00" data-new="$40.00"
                                               data-tooltip="Medium">M</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                    <div class="ec-product-inner">
                        <div class="ec-pro-image-outer">
                            <div class="ec-pro-image">
                                <a href="product-left-sidebar.html" class="image">
                                    <img class="main-image" src="template/assets/images/product-image/2_1.jpg"
                                         alt="Product"/>
                                    <img class="hover-image" src="template/assets/images/product-image/2_2.jpg"
                                         alt="Product"/>
                                </a>
                                <span class="percentage">20%</span>
                                <span class="flags">
                                    <span class="new">New</span>
                                </span>
                                <a href="#" class="quickview" data-link-action="quickview" title="Quick view"
                                   data-bs-toggle="modal" data-bs-target="#ec_quickview_modal"><i
                                        class="fi-rr-eye"></i></a>
                                <div class="ec-pro-actions">
                                    <a href="compare.html" class="ec-btn-group compare" title="Compare"><i
                                            class="fi fi-rr-arrows-repeat"></i></a>
                                    <button title="Add To Cart" class="add-to-cart"><i
                                            class="fi-rr-shopping-basket"></i> Add To Cart
                                    </button>
                                    <a class="ec-btn-group wishlist" title="Wishlist"><i class="fi-rr-heart"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="ec-pro-content">
                            <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Jumbo Carry Bag</a></h5>
                            <div class="ec-pro-rating">
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star"></i>
                            </div>
                            <div class="ec-pro-list-desc">Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry. Lorem Ipsum is simply dutmmy text ever since the 1500s, when an
                                unknown printer took a galley.
                            </div>
                            <span class="ec-price">
                                <span class="old-price">$50.00</span>
                                <span class="new-price">$40.00</span>
                            </span>
                            <div class="ec-pro-option">
                                <div class="ec-pro-color">
                                    <span class="ec-pro-opt-label">Color</span>
                                    <ul class="ec-opt-swatch ec-change-img">
                                        <li class="active"><a href="#" class="ec-opt-clr-img"
                                                              data-src="template/assets/images/product-image/2_1.jpg"
                                                              data-src-hover="template/assets/images/product-image/2_2.jpg"
                                                              data-tooltip="Gray"><span
                                                    style="background-color:#fdbf04;"></span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 shop-all-btn"><a href="#">Shop All Collection</a></div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            function updateTotal() {
                var subTotal = 0;
                $('.quantity-input').each(function () {
                    var $input = $(this);
                    var price = parseFloat($input.closest('tr').data('price'));
                    var quantity = parseFloat($input.val());
                    subTotal += price * quantity;
                });
                var shipping = 30000; // Phí vận chuyển cố định
                var total = subTotal + shipping;
                $('#sub-total').text(subTotal.toLocaleString('vi-VN') + ' đ');
                $('#total-amount').text(total.toLocaleString('vi-VN') + ' đ');
            }

            // Xử lý sự kiện click cho nút plus và minus
            $('.quantity-btn').on('click', function () {
                var $btn = $(this);
                var $row = $btn.closest('tr');
                var $quantityInput = $row.find('.quantity-input');
                var quantity = parseInt($quantityInput.val());
                var maxQuantity = parseInt($row.data('stock')); // Lấy số lượng còn lại từ data attribute

                if ($btn.hasClass('plus')) {
                    quantity += 1;
                } else if ($btn.hasClass('minus')) {
                    quantity = Math.max(1, quantity - 1);
                }

                if (quantity > maxQuantity) {
                    alert('Số lượng đã vượt quá số lượng có sẵn.');
                    return; // Ngừng cập nhật số lượng nếu vượt quá số lượng có sẵn
                }

                $quantityInput.val(quantity);
                var price = parseFloat($row.data('price'));
                var newSubtotal = quantity * price;
                $row.find('.ec-cart-pro-subtotal').text(newSubtotal.toLocaleString('vi-VN') + ' đ');
                updateTotal();
            });

            // Xử lý sự kiện change cho input số lượng
            $('.quantity-input').on('input', function () {
                var $input = $(this);
                var $row = $input.closest('tr');
                var quantity = parseInt($input.val());
                var maxQuantity = parseInt($row.data('stock')); // Lấy số lượng còn lại từ data attribute

                quantity = isNaN(quantity) || quantity < 1 ? 1 : quantity;

                if (quantity > maxQuantity) {
                    alert('Số lượng đã vượt quá số lượng có sẵn.');
                    $input.val(maxQuantity); // Cập nhật số lượng về số lượng còn lại
                    return;
                }

                $input.val(quantity);
                var price = parseFloat($row.data('price'));
                var newSubtotal = quantity * price;
                $row.find('.ec-cart-pro-subtotal').text(newSubtotal.toLocaleString('vi-VN') + ' đ');
                updateTotal();
            });

            // Xử lý sự kiện click cho nút cập nhật giỏ hàng
            $('#update-cart').click(function () {
                var cartItems = [];
                $('.quantity-input').each(function () {
                    var $row = $(this).closest('tr');
                    var productId = $row.data('product-id');
                    var quantity = parseInt($(this).val());
                    cartItems.push({product_id: productId, quantity: quantity});
                });

                $.ajax({
                    url: '{{ route('cart.update') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        cartItems: cartItems
                    },
                    success: function (response) {
                        $('#sub-total').text(response.subtotal + ' đ');
                        $('#total-amount').text(response.totalAmount + ' đ');
                        alert('Giỏ hàng đã được cập nhật thành công.');
                    },
                    error: function (response) {
                        alert('Đã có lỗi xảy ra khi cập nhật giỏ hàng.');
                    }
                });
            });

            // Xử lý sự kiện click cho nút xóa sản phẩm
            $('.pro-remove').on('click', function (event) {
                event.preventDefault();
                var $row = $(this).closest('tr');
                var productId = $row.data('product-id');

                // Gửi yêu cầu xóa sản phẩm về server
                $.ajax({
                    url: '{{ route('cart.remove') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: productId
                    },
                    success: function (response) {
                        $row.remove();
                        updateTotal();
                        alert('Sản phẩm đã được xóa khỏi giỏ hàng.');
                    },
                    error: function (response) {
                        alert('Đã có lỗi xảy ra khi xóa sản phẩm.');
                    }
                });
            });
        });

    </script>

@endsection
<!-- New Product end -->
