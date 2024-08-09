<!-- Ec breadcrumb start -->
@extends('clients.layouts.index')

@section('content')
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Checkout</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                                <li class="ec-breadcrumb-item active">Thanh toán</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec checkout page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-checkout-leftside col-lg-8 col-md-12 ">
                    <!-- checkout content Start -->

                    <div class="ec-checkout-content">
                        <div class="ec-checkout-inner">
                            <div class="ec-checkout-wrap margin-bottom-30 padding-bottom-3">
                                <div class="ec-checkout-block ec-check-bill">
                                    <h3 class="ec-checkout-title">Chi tiết thanh toán</h3>
                                    <div class="ec-bl-block-content">
                                        <div class="ec-check-subtitle">Tùy chọn thanh toán</div>
                                        <div class="ec-check-bill-form">
                                            <form action="{{ route('order.add') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="productVariants"
                                                       value="{{ $productVariants }}">
                                                <input type="hidden" name="totalAmount" value="{{ $totalAmount }}">
                                                <input type="hidden" name="userId" value="{{ $user->id }}">
                                                <span class="ec-bill-wrap ec-bill-half">
                                                        <label>Nhập họ và tên*</label>
                                                        <input type="text" class="input-buttom" name="user_name"
                                                               value="{{ $user->name }}"
                                                               placeholder="Nhập họ và tên" style="margin-bottom: 3px"/>
                                                    @error('user_name')
                                                    <p class="text-danger"> {{$message}}</p>
                                                    @enderror
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half">
                                                        <label>Nhập email*</label>
                                                        <input type="text" class="input-buttom" name="user_email"
                                                               value="{{ $user->email }}"
                                                               placeholder="Nhập email" style="margin-bottom: 3px"/>
                                                </span>
                                                @error('user_email')
                                                <p class="text-danger"> {{$message}}</p>
                                                @enderror
                                                <span class="ec-bill-wrap ec-bill-half mt-3">
                                                        <label>Nhập địa chỉ*</label>
                                                        <input type="text" name="user_address"
                                                               placeholder="Nhập địa chỉ" style="margin-bottom: 3px"/>
                                                    @error('user_address')
                                                        <p class="text-danger"> {{$message}}</p>
                                                      @enderror
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half mt-3">
                                                        <label>Nhập số điện thoại*</label>
                                                        <input type="text" name="user_phone"
                                                               placeholder="Nhập số điện thoại"
                                                               style="margin-bottom: 3px"/>
                                                        @error('user_phone')
                                                        <p class="text-danger"> {{$message}}</p>
                                                      @enderror
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half mt-3">
                                                        <label>Nhập email người nhận*</label>
                                                        <input type="text" name="receiver_email"
                                                               placeholder="Nhập số điện thoại"
                                                               style="margin-bottom: 3px"/>
                                                        @error('receiver_email')
                                                        <p class="text-danger"> {{$message}}</p>
                                                      @enderror
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half mt-3">
                                                        <label>Tên người nhận*</label>
                                                        <input type="text" name="receiver_name"
                                                               placeholder="Nhập tên người nhận"
                                                               style="margin-bottom: 3px"/>
                                                        @error('receiver_name')
                                                        <p class="text-danger"> {{$message}}</p>
                                                      @enderror
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half mt-3">
                                                        <label>Nhập địa chỉ*</label>
                                                        <input type="text" name="receiver_address"
                                                               placeholder="Nhập số điện thoại"
                                                               style="margin-bottom: 3px"/>
                                                        @error('receiver_address')
                                                        <p class="text-danger"> {{$message}}</p>
                                                      @enderror
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half mt-3">
                                                        <label>Nhập số điện thoại người nhận*</label>
                                                        <input type="text" name="receiver_phone"
                                                               placeholder="Nhập số điện thoại"
                                                               style="margin-bottom: 3px"/>
                                                        @error('receiver_phone')
                                                        <p class="text-danger"> {{$message}}</p>
                                                      @enderror
                                                </span>

                                                <span class="ec-bill-wrap">
                                                        <label>Ghi chú</label>
                                                        <textarea name="note"></textarea>
                                                        @error('note')
                                                        <p class="text-danger"> {{$message}}</p>
                                                      @enderror
                                                    </span>

                                                <div class="mt-2" style="margin-left: 85%">
                                                    <button class="btn btn-primary" type="submit">Đặt hàng</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--cart content End -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="ec-checkout-rightside col-lg-4 col-md-12">
                    <div class="ec-sidebar-wrap">
                        <!-- Sidebar Summary Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Thông tin</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <div class="ec-checkout-summary">
                                    <div>
                                        <span class="text-left">Tạm tính</span>
                                        <span class="text-right">{{ $subTotal }}</span>
                                    </div>
                                    <div>
                                        <span class="text-left">Phí vận chyển</span>
                                        <span class="text-right">{{ $shipping }}</span>
                                    </div>
                                    <div>
                                        <span class="text-left">Mã giảm giá</span>
                                        <span class="text-right"><a class="ec-checkout-coupan">Áp dụng</a></span>
                                    </div>
                                    <div class="ec-checkout-coupan-content">
                                        <form class="ec-checkout-coupan-form" name="ec-checkout-coupan-form"
                                              method="post" action="#">
                                            <input class="ec-coupan" type="text"=""
                                            placeholder="Enter Your Coupan Code" name="ec-coupan" value="">
                                            <button class="ec-coupan-btn button btn-primary" type="submit"
                                                    name="subscribe" value="">Apply
                                            </button>
                                        </form>
                                    </div>
                                    <div class="ec-checkout-summary-total">
                                        <span class="text-left">Tổng tiền</span>
                                        <span class="text-right">{{ $totalAmount }}</span>
                                    </div>
                                </div>
                                <div class="ec-checkout-pro">
                                    @foreach($productVariants as $key => $item)
                                        <div class="col-sm-12 mb-6">
                                            <div class="ec-product-inner">
                                                <div class="ec-pro-image-outer">
                                                    <div class="ec-pro-image">
                                                        <a href="product-left-sidebar.html" class="image">
                                                            <img class="main-image"
                                                                 src="{{ Storage::url($item->product_img_thumb) }}"
                                                                 alt="Product"/>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="ec-pro-content">
                                                    <h5 class="ec-pro-title"><a
                                                            href="product-left-sidebar.html">{{ $item->product_name }}</a>
                                                    </h5>
                                                    <div class="ec-pro-rating">
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star"></i>
                                                    </div>
                                                    <span class="ec-price">
                                                     @if($item->product_price_sale_variant)
                                                            <span class="text-danger price">{{ number_format($item->product_price_sale_variant, 0, '', '.') }}đ</span>
                                                            <span class="text-gray"
                                                                  style="text-decoration: line-through">{{ number_format($item->product_price_variant, 0, '', '.') }}đ</span>
                                                        @else
                                                            <span class="text-danger price">{{ number_format($item->product_price_variant, 0, '', '.') }}đ</span>
                                                        @endif
                                                </span>
                                                    <div class="ec-pro-option">
                                                        <div class="ec-pro-color">
                                                            <span class="ec-pro-opt-label">Color</span>
                                                            <ul class="ec-opt-swatch ec-change-img">
                                                                <li class="active"><a href="#" class="ec-opt-clr-img"
                                                                                      data-src="template/assets/images/product-image/1_1.jpg"
                                                                                      data-src-hover="template/assets/images/product-image/1_1.jpg"
                                                                                      data-tooltip="Gray"><span
                                                                            style="background-color:#000000;">{{ $item->variant_color_name }}</span></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="ec-pro-size">
                                                            <span class="ec-pro-opt-label">Size</span>
                                                            <ul class="ec-opt-size">
                                                                <li class="active"><a href="#" class="ec-opt-sz"
                                                                                      data-tooltip="Small">{{ $item->variant_size_name }}</a>
                                                                </li>
                                                                <li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Summary Block -->

                    </div>
                    <div class="ec-sidebar-wrap ec-checkout-pay-wrap">
                        <!-- Sidebar Payment Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Phương thức thanh toán
                                    <div class="ec-sidebar-res"><i class="ecicon eci-angle-down"></i></div>
                                </h3>
                            </div>
                            <div class="ec-sb-block-content ec-sidebar-dropdown">
                                <div class="ec-checkout-pay">
                                    <div class="ec-pay-desc">Vui lòng chọn phương thức thanh toán ưa thích để sử dụng
                                        cho đơn hàng này.
                                    </div>
                                    <form action="#">
                    <span class="ec-pay-option">
                        <span>
                            <input type="radio" style="width: 5%; height: 5%" name="radio-group" checked>
                            <label for="pay1">Thanh toán khi giao hàng</label> <br>
                             <input type="radio" style="width: 5%; height: 5%" name="radio-group" checked>
                            <label for="pay1">Thanh toán Online</label>
                        </span>
                    </span>
                                        <span class="ec-pay-commemt">
                        <span class="ec-pay-opt-head">Thêm bình luận về đơn hàng của bạn</span>
                        <textarea name="your-commemt" placeholder="Bình luận"></textarea>
                    </span>
                                        <span class="ec-pay-agree">
                        <input type="checkbox" value="">
                        <a href="#">Tôi đã đọc và đồng ý với <span>Điều khoản &amp; Điều kiện</span></a>
                    </span>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Payment Block -->
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
                <!-- New Product Content --
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                    <div class="ec-product-inner">
                        <div class="ec-pro-image-outer">
                            <div class="ec-pro-image">
                                <a href="product-left-sidebar.html" class="image">
                                    <img class="main-image"
                                         src="template/assets/images/product-image/7_1.jpg" alt="Product" />
                                    <img class="hover-image"
                                         src="template/assets/images/product-image/7_2.jpg" alt="Product" />
                                </a>
                                <span class="percentage">20%</span>
                                <span class="flags">
                                        <span class="sale">Sale</span>
                                    </span>
                                <a href="#" class="quickview" data-link-action="quickview"
                                   title="Quick view" data-bs-toggle="modal"
                                   data-bs-target="#ec_quickview_modal"><i class="fi-rr-eye"></i></a>
                                <div class="ec-pro-actions">
                                    <a href="compare.html" class="ec-btn-group compare"
                                       title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a>
                                    <button title="Add To Cart" class="add-to-cart"><i
                                            class="fi-rr-shopping-basket"></i> Add To Cart</button>
                                    <a class="ec-btn-group wishlist" title="Wishlist"><i
                                            class="fi-rr-heart"></i></a>
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
                            <div class="ec-pro-list-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dutmmy text ever since the 1500s, when an unknown printer took a galley.</div>
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
                                                    style="background-color:#01f1f1;"></span></a></li>
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
                                        <li class="active"><a href="#" class="ec-opt-sz"
                                                              data-old="$12.00" data-new="$10.00"
                                                              data-tooltip="Small">S</a></li>
                                        <li><a href="#" class="ec-opt-sz" data-old="$15.00"
                                               data-new="$12.00" data-tooltip="Medium">M</a></li>
                                        <li><a href="#" class="ec-opt-sz" data-old="$20.00"
                                               data-new="$17.00" data-tooltip="Extra Large">XL</a></li>
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
    <!-- New Product end -->
