@extends('clients.layouts.index')

@section('content')
    <!-- Main Slider Start -->
    <div class="sticky-header-next-sec ec-main-slider section section-space-pb">
        <div class="ec-slider swiper-container main-slider-nav main-slider-dot">
            <!-- Main slider -->
            <div class="swiper-wrapper">
                <div class="ec-slide-item swiper-slide d-flex ec-slide-1">
                    <div class="container align-self-center">
                        <div class="row">
                            <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                                <div class="ec-slide-content slider-animation">
                                    <h1 class="ec-slide-title">New Fashion Collection</h1>
                                    <h2 class="ec-slide-stitle">Sale Offer</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>
                                    <a href="#" class="btn btn-lg btn-secondary">Order Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ec-slide-item swiper-slide d-flex ec-slide-2">
                    <div class="container align-self-center">
                        <div class="row">
                            <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                                <div class="ec-slide-content slider-animation">
                                    <h1 class="ec-slide-title">Boat Headphone Sets</h1>
                                    <h2 class="ec-slide-stitle">Sale Offer</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>
                                    <a href="#" class="btn btn-lg btn-secondary">Order Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination swiper-pagination-white"></div>
            <div class="swiper-buttons">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
    <!-- Main Slider End -->

    <!-- Product tab Area Start -->
    <section class="section ec-product-tab section-space-p" id="collection">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Our Top Collection</h2>
                        <h2 class="ec-title">Our Top Collection</h2>
                        <p class="sub-title">Browse The Collection of Top Products</p>
                    </div>
                </div>

                <!-- Tab Start -->
                <div class="col-md-12 text-center">
                    <ul class="ec-pro-tab-nav nav justify-content-center">
                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tab-pro-for-all">For
                                All</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-pro-for-men">For
                                Men</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-pro-for-women">For
                                Women</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-pro-for-child">For
                                Children</a></li>
                    </ul>
                </div>
                <!-- Tab End -->
            </div>
            <div class="row">
                <div class="col">
                    <div class="tab-content">
                        <!-- 1st Product tab start -->
                        <div class="tab-pane fade show active" id="tab-pro-for-all">
                            <div class="row">
                                <!-- Product Content -->
                                @foreach($products as $item)
                                    {{--                                @dd($item->img_thumb)--}}
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 ec-product-content"
                                         data-animation="fadeIn">
                                        <div class="ec-product-inner">
                                            <div class="ec-pro-image-outer">
                                                <div class="ec-pro-image">
                                                    @if($item->is_best_sale)
                                                        <span class="badge badge-primary">BEST SALE</span>
                                                    @elseif($item->is_40_sale)
                                                        <span class="badge badge-primary">BEST 40</span>
                                                    @elseif($item->is_hot_online)
                                                        <span class="badge badge-primary">BEST Online</span>
                                                    @endif
                                                    <a href="{{ route('products.detail', $item->slug) }}" class="image">
                                                        <img class="main-image"
                                                             src="{{ Storage::url($item->img_thumb) }}" alt="Product"/>
                                                    </a>
                                                    <span class="percentage">20%</span>
                                                    <a href="#" class="quickview" data-link-action="quickview"
                                                       title="Quick view" data-bs-toggle="modal"
                                                       data-bs-target="#ec_quickview_modal">
                                                        <i class="fi-rr-eye"></i>
                                                    </a>
                                                    <div class="ec-pro-actions">
                                                        <a href="{{ route('products.detail', $item->slug) }}"
                                                           class="ec-btn-group compare" title="Compare">
                                                            <i class="fi fi-rr-arrows-repeat"></i>
                                                        </a>
                                                        <button title="Add To Cart" class="add-to-cart">
                                                            <i class="fi-rr-shopping-basket"></i> Thêm vào giỏ hàng
                                                        </button>
                                                        <a class="ec-btn-group wishlist" title="Wishlist">
                                                            <i class="fi-rr-heart"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ec-pro-content">
                                                <h5 class="ec-pro-title">
                                                    <a href="{{ route('products.detail', $item->slug) }}">{{ $item->name }}</a>
                                                </h5>
                                                <div class="ec-pro-rating">
                                                    <i class="ecicon eci-star fill"></i>
                                                    <i class="ecicon eci-star fill"></i>
                                                    <i class="ecicon eci-star fill"></i>
                                                    <i class="ecicon eci-star fill"></i>
                                                    <i class="ecicon eci-star"></i>
                                                </div>
                                                <span class="ec-price">
                                                <span class="old-price">{{ number_format($item->price_sale) ?: number_format($item->price) }}đ</span>
                                                <span class="new-price">{{ number_format($item->price_sale) ? number_format($item->price) : ''}}đ</span>
                                            </span>
                                                <div class="ec-pro-option">
                                                    <div class="ec-pro-color">
                                                        @foreach($product_color as $color)
                                                            <span class="ec-pro-opt-label">{{$color->name}}</span>
                                                        @endforeach
                                                        <ul class="ec-opt-swatch ec-change-img">
                                                            <li class="active"><a href="#" class="ec-opt-clr-img"
                                                                                  data-src="tempalte/assets/images/product-image/6_1.jpg"
                                                                                  data-src-hover="tempalte/assets/images/product-image/6_1.jpg"
                                                                                  data-tooltip="Gray"><span
                                                                            style="background-color:#e8c2ff;"></span></a>
                                                            </li>
                                                            <li><a href="#" class="ec-opt-clr-img"
                                                                   data-src="tempalte/assets/images/product-image/6_2.jpg"
                                                                   data-src-hover="tempalte/assets/images/product-image/6_2.jpg"
                                                                   data-tooltip="Orange"><span
                                                                            style="background-color:#9cfdd5;"></span></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="ec-pro-size">
                                                        @foreach($product_size as $size)
                                                            <span class="ec-pro-opt-label">{{$size->name}}</span>
                                                        @endforeach
                                                        <ul class="ec-opt-size">
                                                            <li class="active"><a href="#" class="ec-opt-sz"
                                                                                  data-old="$25.00" data-new="$20.00"
                                                                                  data-tooltip="Small">S</a></li>
                                                            <li><a href="#" class="ec-opt-sz" data-old="$27.00"
                                                                   data-new="$22.00" data-tooltip="Medium">M</a></li>
                                                            <li><a href="#" class="ec-opt-sz" data-old="$30.00"
                                                                   data-new="$25.00" data-tooltip="Large">X</a></li>
                                                            <li><a href="#" class="ec-opt-sz" data-old="$35.00"
                                                                   data-new="$30.00" data-tooltip="Extra Large">XL</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-sm-12 shop-all-btn"><a href="shop-left-sidebar-col-3.html">Shop All
                                        Collection</a></div>
                            </div>
                        </div>
                        <!-- ec 1st Product tab end -->
                        <!-- ec 2nd Product tab start -->
                        <div class="tab-pane fade" id="tab-pro-for-men">
                            <div class="row">
                                <!-- Product Content -->
                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content">
                                    <div class="ec-product-inner">
                                        <div class="ec-pro-image-outer">
                                            <div class="ec-pro-image">
                                                <a href="product-left-sidebar.html" class="image">
                                                    <img class="main-image"
                                                         src="tempalte/assets/images/product-image/6_1.jpg"
                                                         alt="Product"/>
                                                    <img class="hover-image"
                                                         src="tempalte/assets/images/product-image/6_2.jpg"
                                                         alt="Product"/>
                                                </a>
                                                <span class="percentage">20%</span>
                                                <a href="#" class="quickview" data-link-action="quickview"
                                                   title="Quick view" data-bs-toggle="modal"
                                                   data-bs-target="#ec_quickview_modal"><i class="fi-rr-eye"></i></a>
                                                <div class="ec-pro-actions">
                                                    <a href="compare.html" class="ec-btn-group compare"
                                                       title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a>
                                                    <button title="Add To Cart" class="add-to-cart"><i
                                                                class="fi-rr-shopping-basket"></i> Add To Cart
                                                    </button>
                                                    <a class="ec-btn-group wishlist" title="Wishlist"><i
                                                                class="fi-rr-heart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ec-pro-content">
                                            <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Round Neck
                                                    T-Shirt</a></h5>
                                            <div class="ec-pro-rating">
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star"></i>
                                            </div>
                                            <span class="ec-price">
                                                <span class="old-price">$30.00</span>
                                                <span class="new-price">$25.00</span>
                                            </span>
                                            <div class="ec-pro-option">
                                                <div class="ec-pro-color">
                                                    <span class="ec-pro-opt-label">Color</span>
                                                    <ul class="ec-opt-swatch ec-change-img">
                                                        <li class="active"><a href="#" class="ec-opt-clr-img"
                                                                              data-src="tempalte/assets/images/product-image/6_1.jpg"
                                                                              data-src-hover="tempalte/assets/images/product-image/6_1.jpg"
                                                                              data-tooltip="Gray"><span
                                                                        style="background-color:#e8c2ff;"></span></a>
                                                        </li>
                                                        <li><a href="#" class="ec-opt-clr-img"
                                                               data-src="tempalte/assets/images/product-image/6_2.jpg"
                                                               data-src-hover="tempalte/assets/images/product-image/6_2.jpg"
                                                               data-tooltip="Orange"><span
                                                                        style="background-color:#9cfdd5;"></span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="ec-pro-size">
                                                    <span class="ec-pro-opt-label">Size</span>
                                                    <ul class="ec-opt-size">
                                                        <li class="active"><a href="#" class="ec-opt-sz"
                                                                              data-old="$25.00" data-new="$20.00"
                                                                              data-tooltip="Small">S</a></li>
                                                        <li><a href="#" class="ec-opt-sz" data-old="$27.00"
                                                               data-new="$22.00" data-tooltip="Medium">M</a></li>
                                                        <li><a href="#" class="ec-opt-sz" data-old="$30.00"
                                                               data-new="$25.00" data-tooltip="Large">X</a></li>
                                                        <li><a href="#" class="ec-opt-sz" data-old="$35.00"
                                                               data-new="$30.00" data-tooltip="Extra Large">XL</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ec 2nd Product tab end -->
                        <!-- ec 3rd Product tab start -->
                        <div class="tab-pane fade" id="tab-pro-for-women">
                            <div class="row">
                                <!-- Product Content -->
                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content">
                                    <div class="ec-product-inner">
                                        <div class="ec-pro-image-outer">
                                            <div class="ec-pro-image">
                                                <a href="product-left-sidebar.html" class="image">
                                                    <img class="main-image"
                                                         src="tempalte/assets/images/product-image/9_1.jpg"
                                                         alt="Product"/>
                                                    <img class="hover-image"
                                                         src="tempalte/assets/images/product-image/9_2.jpg"
                                                         alt="Product"/>
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
                                                                class="fi-rr-shopping-basket"></i> Add To Cart
                                                    </button>
                                                    <a class="ec-btn-group wishlist" title="Wishlist"><i
                                                                class="fi-rr-heart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ec-pro-content">
                                            <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Canvas Shoes
                                                    for Men</a></h5>
                                            <div class="ec-pro-rating">
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star"></i>
                                            </div>
                                            <span class="ec-price">
                                                <span class="old-price">$30.00</span>
                                                <span class="new-price">$25.00</span>
                                            </span>
                                            <div class="ec-pro-option">
                                                <div class="ec-pro-color">
                                                    <span class="ec-pro-opt-label">Color</span>
                                                    <ul class="ec-opt-swatch ec-change-img">
                                                        <li class="active"><a href="#" class="ec-opt-clr-img"
                                                                              data-src="tempalte/assets/images/product-image/9_1.jpg"
                                                                              data-src-hover="tempalte/assets/images/product-image/9_1.jpg"
                                                                              data-tooltip="Gray"><span
                                                                        style="background-color:#21b7fc;"></span></a>
                                                        </li>
                                                        <li><a href="#" class="ec-opt-clr-img"
                                                               data-src="tempalte/assets/images/product-image/9_2.jpg"
                                                               data-src-hover="tempalte/assets/images/product-image/9_2.jpg"
                                                               data-tooltip="Orange"><span
                                                                        style="background-color:#1df0ff;"></span></a>
                                                        </li>
                                                        <li><a href="#" class="ec-opt-clr-img"
                                                               data-src="tempalte/assets/images/product-image/9_3.jpg"
                                                               data-src-hover="tempalte/assets/images/product-image/9_3.jpg"
                                                               data-tooltip="Green"><span
                                                                        style="background-color:#94f7a1;"></span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="ec-pro-size">
                                                    <span class="ec-pro-opt-label">Size</span>
                                                    <ul class="ec-opt-size">
                                                        <li class="active"><a href="#" class="ec-opt-sz"
                                                                              data-old="$30.00" data-new="$25.00"
                                                                              data-tooltip="Small">S</a></li>
                                                        <li><a href="#" class="ec-opt-sz" data-old="$35.00"
                                                               data-new="$27.00" data-tooltip="Medium">M</a></li>
                                                        <li><a href="#" class="ec-opt-sz" data-old="$40.00"
                                                               data-new="$30.00" data-tooltip="Large">X</a></li>
                                                        <li><a href="#" class="ec-opt-sz" data-old="$45.00"
                                                               data-new="$35.00" data-tooltip="Extra Large">XL</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 shop-all-btn"><a href="shop-left-sidebar-col-3.html">Shop All
                                        Collection</a></div>
                            </div>
                        </div>
                        <!-- ec 3rd Product tab end -->
                        <!-- ec 4th Product tab start -->
                        <div class="tab-pane fade" id="tab-pro-for-child">
                            <div class="row">
                                <!-- Product Content -->
                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content">
                                    <div class="ec-product-inner">
                                        <div class="ec-pro-image-outer">
                                            <div class="ec-pro-image">
                                                <a href="product-left-sidebar.html" class="image">
                                                    <img class="main-image"
                                                         src="tempalte/assets/images/product-image/1_1.jpg"
                                                         alt="Product"/>
                                                    <img class="hover-image"
                                                         src="tempalte/assets/images/product-image/1_2.jpg"
                                                         alt="Product"/>
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
                                                                class="fi-rr-shopping-basket"></i> Add To Cart
                                                    </button>
                                                    <a class="ec-btn-group wishlist" title="Wishlist"><i
                                                                class="fi-rr-heart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ec-pro-content">
                                            <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Cute Baby
                                                    Toy's</a></h5>
                                            <div class="ec-pro-rating">
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star"></i>
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
                                                                              data-src="tempalte/assets/images/product-image/1_1.jpg"
                                                                              data-src-hover="tempalte/assets/images/product-image/1_1.jpg"
                                                                              data-tooltip="Gray"><span
                                                                        style="background-color:#90cdf7;"></span></a>
                                                        </li>
                                                        <li><a href="#" class="ec-opt-clr-img"
                                                               data-src="tempalte/assets/images/product-image/1_2.jpg"
                                                               data-src-hover="tempalte/assets/images/product-image/1_2.jpg"
                                                               data-tooltip="Orange"><span
                                                                        style="background-color:#ff3b66;"></span></a>
                                                        </li>
                                                        <li><a href="#" class="ec-opt-clr-img"
                                                               data-src="tempalte/assets/images/product-image/1_3.jpg"
                                                               data-src-hover="tempalte/assets/images/product-image/1_3.jpg"
                                                               data-tooltip="Green"><span
                                                                        style="background-color:#ffc476;"></span></a>
                                                        </li>
                                                        <li><a href="#" class="ec-opt-clr-img"
                                                               data-src="tempalte/assets/images/product-image/1_4.jpg"
                                                               data-src-hover="assets/images/product-image/1_4.jpg"
                                                               data-tooltip="Sky Blue"><span
                                                                        style="background-color:#1af0ba;"></span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="ec-pro-size">
                                                    <span class="ec-pro-opt-label">Size</span>
                                                    <ul class="ec-opt-size">
                                                        <li class="active"><a href="#" class="ec-opt-sz"
                                                                              data-old="$40.00" data-new="$30.00"
                                                                              data-tooltip="Small">S</a></li>
                                                        <li><a href="#" class="ec-opt-sz" data-old="$50.00"
                                                               data-new="$40.00" data-tooltip="Medium">M</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 shop-all-btn"><a href="shop-left-sidebar-col-3.html">Shop All
                                        Collection</a></div>
                            </div>
                        </div>
                        <!-- ec 4th Product tab end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ec Product tab Area End -->

    <!-- ec Banner Section Start -->
    <section class="ec-banner section section-space-p">
        <h2 class="d-none">Banner</h2>
        <div class="container">
            <!-- ec Banners Start -->
            <div class="ec-banner-inner">
                <!--ec Banner Start -->
                <div class="ec-banner-block ec-banner-block-2">
                    <div class="row">
                        <div class="banner-block col-lg-6 col-md-12 margin-b-30" data-animation="slideInRight">
                            <div class="bnr-overlay">
                                <img src="template/assets/images/banner/2.jpg" alt=""/>
                                <div class="banner-text">
                                    <span class="ec-banner-stitle">New Arrivals</span>
                                    <span class="ec-banner-title">mens<br> Sport shoes</span>
                                    <span class="ec-banner-discount">30% Discount</span>
                                </div>
                                <div class="banner-content">
                                    <span class="ec-banner-btn"><a href="#">Order Now</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="banner-block col-lg-6 col-md-12" data-animation="slideInLeft">
                            <div class="bnr-overlay">
                                <img src="template/assets/images/banner/3.jpg" alt=""/>
                                <div class="banner-text">
                                    <span class="ec-banner-stitle">New Trending</span>
                                    <span class="ec-banner-title">Smart<br> watches</span>
                                    <span class="ec-banner-discount">Buy any 3 Items & get <br>20% Discount</span>
                                </div>
                                <div class="banner-content">
                                    <span class="ec-banner-btn"><a href="#">Order Now</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ec Banner End -->
                </div>
                <!-- ec Banners End -->
            </div>
        </div>
    </section>
    <!-- ec Banner Section End -->

    <!--  Category Section Start -->
    <section class="section ec-category-section section-space-p" id="categories">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Our Top Collection</h2>
                        <h2 class="ec-title">Top Categories</h2>
                        <p class="sub-title">Browse The Collection of Top Categories</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <!--Category Nav Start -->
                <div class="col-lg-3">
                    <ul class="ec-cat-tab-nav nav">
                        <li class="cat-item"><a class="cat-link active" data-bs-toggle="tab" href="#tab-cat-1">
                                <div class="cat-icons"><img class="cat-icon"
                                                            src="template/assets/images/icons/cat_1.png"
                                                            alt="cat-icon"><img class="cat-icon-hover"
                                                                                src="template/assets/images/icons/cat_1_1.png"
                                                                                alt="cat-icon"></div>
                                <div class="cat-desc"><span>Clothes</span><span>440 Products</span></div>
                            </a></li>
                        <li class="cat-item"><a class="cat-link" data-bs-toggle="tab" href="#tab-cat-2">
                                <div class="cat-icons"><img class="cat-icon"
                                                            src="template/assets/images/icons/cat_2.png"
                                                            alt="cat-icon"><img class="cat-icon-hover"
                                                                                src="template/assets/images/icons/cat_2_1.png"
                                                                                alt="cat-icon"></div>
                                <div class="cat-desc"><span>Watches</span><span>510 Products</span></div>
                            </a></li>
                        <li class="cat-item"><a class="cat-link" data-bs-toggle="tab" href="#tab-cat-3">
                                <div class="cat-icons"><img class="cat-icon"
                                                            src="template/assets/images/icons/cat_3.png"
                                                            alt="cat-icon"><img class="cat-icon-hover"
                                                                                src="template/assets/images/icons/cat_3_1.png"
                                                                                alt="cat-icon"></div>
                                <div class="cat-desc"><span>Bags</span><span>620 Products</span></div>
                            </a></li>
                        <li class="cat-item"><a class="cat-link" data-bs-toggle="tab" href="#tab-cat-4">
                                <div class="cat-icons"><img class="cat-icon"
                                                            src="template/assets/images/icons/cat_4.png"
                                                            alt="cat-icon"><img class="cat-icon-hover"
                                                                                src="template/assets/images/icons/cat_4_1.png"
                                                                                alt="cat-icon"></div>
                                <div class="cat-desc"><span>Shoes</span><span>320 Products</span></div>
                            </a></li>
                    </ul>

                </div>
                <!-- Category Nav End -->
                <!--Category Tab Start -->
                <div class="col-lg-9">
                    <div class="tab-content">
                        <!-- 1st Category tab end -->
                        <div class="tab-pane fade show active" id="tab-cat-1">
                            <div class="row">
                                <img src="template/assets/images/cat-banner/1.jpg" alt=""/>
                            </div>
                            <span class="panel-overlay">
                                <a href="shop-left-sidebar-col-3.html" class="btn btn-primary">View All</a>
                            </span>
                        </div>
                        <!-- 1st Category tab end -->
                        <div class="tab-pane fade" id="tab-cat-2">
                            <div class="row">
                                <img src="template/assets/images/cat-banner/2.jpg" alt=""/>
                            </div>
                            <span class="panel-overlay">
                                <a href="shop-left-sidebar-col-3.html" class="btn btn-primary">View All</a>
                            </span>
                        </div>
                        <!-- 2nd Category tab end -->
                        <!-- 3rd Category tab start -->
                        <div class="tab-pane fade" id="tab-cat-3">
                            <div class="row">
                                <img src="template/assets/images/cat-banner/3.jpg" alt=""/>
                            </div>
                            <span class="panel-overlay">
                                <a href="shop-left-sidebar-col-3.html" class="btn btn-primary">View All</a>
                            </span>
                        </div>
                        <!-- 3rd Category tab end -->
                        <!-- 4th Category tab start -->
                        <div class="tab-pane fade" id="tab-cat-4">
                            <div class="row">
                                <img src="template/assets/images/cat-banner/4.jpg" alt=""/>
                            </div>
                            <span class="panel-overlay">
                                <a href="shop-left-sidebar-col-3.html" class="btn btn-primary">View All</a>
                            </span>
                        </div>
                        <!-- 4th Category tab end -->
                    </div>
                    <!-- Category Tab End -->
                </div>
            </div>
        </div>
    </section>
    <!-- Category Section End -->

    <!--  Feature & Special Section Start -->
    <section class="section ec-fre-spe-section section-space-p" id="offers">
        <div class="container">
            <div class="row">
                <!--  Feature Section Start -->
                <div class="ec-fre-section col-lg-6 col-md-6 col-sm-6 margin-b-30" data-animation="slideInRight">
                    <div class="col-md-12 text-left">
                        <div class="section-title">
                            <h2 class="ec-bg-title">Feature Items</h2>
                            <h2 class="ec-title">Feature Items</h2>
                        </div>
                    </div>

                    <div class="ec-fre-products">
                        <div class="ec-fs-product">
                            <div class="ec-fs-pro-inner">
                                <div class="ec-fs-pro-image-outer col-lg-6 col-md-6 col-sm-6">
                                    <div class="ec-fs-pro-image">
                                        <a href="product-left-sidebar.html" class="image"><img class="main-image"
                                                                                               src="template/assets/images/product-image/1_1.jpg"
                                                                                               alt="Product"/></a>
                                        <a href="#" class="quickview" data-link-action="quickview" title="Quick view"
                                           data-bs-toggle="modal" data-bs-target="#ec_quickview_modal"><i
                                                    class="fi-rr-eye"></i></a>
                                    </div>
                                </div>
                                <div class="ec-fs-pro-content col-lg-6 col-md-6 col-sm-6">
                                    <h5 class="ec-fs-pro-title"><a href="product-left-sidebar.html">Baby Toy
                                            Teddybear</a>
                                    </h5>
                                    <div class="ec-fs-pro-rating">
                                        <span class="ec-fs-rating-icon">
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star"></i>
                                        </span>
                                        <span class="ec-fs-rating-text">4 Review</span>
                                    </div>
                                    <div class="ec-fs-price">
                                        <span class="old-price">$549.00</span>
                                        <span class="new-price">$480.00</span>
                                    </div>

                                    <div class="countdowntimer"><span id="ec-fs-count-1"></span></div>
                                    <div class="ec-fs-pro-desc">Lorem Ipsum is simply dummy text the printing and
                                        typesetting.
                                    </div>
                                    <div class="ec-fs-pro-book">Total Booking: <span>25</span></div>
                                    <div class="ec-fs-pro-btn">
                                        <a href="#" class="btn btn-lg btn-secondary">Remind Me</a>
                                        <a href="#" class="btn btn-lg btn-primary">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ec-fs-product">
                            <div class="ec-fs-pro-inner">
                                <div class="ec-fs-pro-image-outer col-lg-6 col-md-6 col-sm-6">
                                    <div class="ec-fs-pro-image">
                                        <a href="product-left-sidebar.html" class="image"><img class="main-image"
                                                                                               src="template/assets/images/product-image/3_1.jpg"
                                                                                               alt="Product"/></a>
                                        <a href="#" class="quickview" data-link-action="quickview" title="Quick view"
                                           data-bs-toggle="modal" data-bs-target="#ec_quickview_modal"><i
                                                    class="fi-rr-eye"></i></a>
                                    </div>
                                </div>
                                <div class="ec-fs-pro-content col-lg-6 col-md-6 col-sm-6">
                                    <h5 class="ec-fs-pro-title"><a href="product-left-sidebar.html">Leather Purse For
                                            Women</a>
                                    </h5>
                                    <div class="ec-fs-pro-rating">
                                        <span class="ec-fs-rating-icon">
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                        </span>
                                        <span class="ec-fs-rating-text">4 Review</span>
                                    </div>
                                    <div class="ec-fs-price">
                                        <span class="old-price">$300.00</span>
                                        <span class="new-price">$250.00</span>
                                    </div>

                                    <div class="countdowntimer"><span id="ec-fs-count-2"></span></div>
                                    <div class="ec-fs-pro-desc">Lorem Ipsum is simply dummy text the printing and
                                        typesetting.
                                    </div>
                                    <div class="ec-fs-pro-book">Total Booking: <span>25</span></div>
                                    <div class="ec-fs-pro-btn">
                                        <a href="#" class="btn btn-lg btn-secondary">Remind Me</a>
                                        <a href="#" class="btn btn-lg btn-primary">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  Feature Section End -->
                <!--  Special Section Start -->
                <div class="ec-spe-section col-lg-6 col-md-6 col-sm-6" data-animation="slideInLeft">
                    <div class="col-md-12 text-left">
                        <div class="section-title">
                            <h2 class="ec-bg-title">Limited Time Offer</h2>
                            <h2 class="ec-title">Limited Time Offer</h2>
                        </div>
                    </div>

                    <div class="ec-spe-products">
                        <div class="ec-fs-product">
                            <div class="ec-fs-pro-inner">
                                <div class="ec-fs-pro-image-outer col-lg-6 col-md-6 col-sm-6">
                                    <div class="ec-fs-pro-image">
                                        <a href="product-left-sidebar.html" class="image"><img class="main-image"
                                                                                               src="template/assets/images/product-image/8_1.jpg"
                                                                                               alt="Product"/></a>
                                        <a href="#" class="quickview" data-link-action="quickview" title="Quick view"
                                           data-bs-toggle="modal" data-bs-target="#ec_quickview_modal"><i
                                                    class="fi-rr-eye"></i></a>
                                    </div>
                                </div>
                                <div class="ec-fs-pro-content col-lg-6 col-md-6 col-sm-6">
                                    <h5 class="ec-fs-pro-title"><a href="product-left-sidebar.html">Smart watch
                                            Firebolt</a>
                                    </h5>
                                    <div class="ec-fs-pro-rating">
                                        <span class="ec-fs-rating-icon">
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star"></i>
                                        </span>
                                        <span class="ec-fs-rating-text">4 Review</span>
                                    </div>
                                    <div class="ec-fs-price">
                                        <span class="old-price">$200.00</span>
                                        <span class="new-price">$180.00</span>
                                    </div>
                                    <div class="countdowntimer"><span id="ec-fs-count-3"></span></div>
                                    <div class="ec-fs-pro-desc">Lorem Ipsum is simply dummy text the printing and
                                        typesetting.
                                    </div>
                                    <div class="ec-fs-pro-book">Total Booking: <span>25</span></div>
                                    <div class="ec-fs-pro-btn">
                                        <a href="#" class="btn btn-lg btn-secondary">Remind Me</a>
                                        <a href="#" class="btn btn-lg btn-primary">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ec-fs-product">
                            <div class="ec-fs-pro-inner">
                                <div class="ec-fs-pro-image-outer col-lg-6 col-md-6 col-sm-6">
                                    <div class="ec-fs-pro-image">
                                        <a href="product-left-sidebar.html" class="image"><img class="main-image"
                                                                                               src="template/assets/images/product-image/10_1.jpg"
                                                                                               alt="Product"/></a>
                                        <a href="#" class="quickview" data-link-action="quickview" title="Quick view"
                                           data-bs-toggle="modal" data-bs-target="#ec_quickview_modal"><i
                                                    class="fi-rr-eye"></i></a>
                                    </div>
                                </div>
                                <div class="ec-fs-pro-content col-lg-6 col-md-6 col-sm-6">
                                    <h5 class="ec-fs-pro-title"><a href="product-left-sidebar.html">Casual Shoes Men</a>
                                    </h5>
                                    <div class="ec-fs-pro-rating">
                                        <span class="ec-fs-rating-icon">
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                        </span>
                                        <span class="ec-fs-rating-text">4 Review</span>
                                    </div>
                                    <div class="ec-fs-price">
                                        <span class="old-price">$120.00</span>
                                        <span class="new-price">$95.00</span>
                                    </div>

                                    <div class="countdowntimer"><span id="ec-fs-count-4"></span></div>
                                    <div class="ec-fs-pro-desc">Lorem Ipsum is simply dummy text the printing and
                                        typesetting.
                                    </div>
                                    <div class="ec-fs-pro-book">Total Booking: <span>25</span></div>
                                    <div class="ec-fs-pro-btn">
                                        <a href="#" class="btn btn-lg btn-secondary">Remind Me</a>
                                        <a href="#" class="btn btn-lg btn-primary">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  Special Section End -->
            </div>
        </div>
    </section>
    <!-- Feature & Special Section End -->

    <!--  services Section Start -->
    <section class="section ec-services-section section-space-p" id="services">
        <h2 class="d-none">Services</h2>
        <div class="container">
            <div class="row">
                <div class="ec_ser_content ec_ser_content_1 col-sm-12 col-md-6 col-lg-3" data-animation="zoomIn">
                    <div class="ec_ser_inner">
                        <div class="ec-service-image">
                            <i class="fi fi-ts-truck-moving"></i>
                        </div>
                        <div class="ec-service-desc">
                            <h2>Free Shipping</h2>
                            <p>Free shipping on all US order or order above $200</p>
                        </div>
                    </div>
                </div>
                <div class="ec_ser_content ec_ser_content_2 col-sm-12 col-md-6 col-lg-3" data-animation="zoomIn">
                    <div class="ec_ser_inner">
                        <div class="ec-service-image">
                            <i class="fi fi-ts-hand-holding-seeding"></i>
                        </div>
                        <div class="ec-service-desc">
                            <h2>24X7 Support</h2>
                            <p>Contact us 24 hours a day, 7 days a week</p>
                        </div>
                    </div>
                </div>
                <div class="ec_ser_content ec_ser_content_3 col-sm-12 col-md-6 col-lg-3" data-animation="zoomIn">
                    <div class="ec_ser_inner">
                        <div class="ec-service-image">
                            <i class="fi fi-ts-badge-percent"></i>
                        </div>
                        <div class="ec-service-desc">
                            <h2>30 Days Return</h2>
                            <p>Simply return it within 30 days for an exchange</p>
                        </div>
                    </div>
                </div>
                <div class="ec_ser_content ec_ser_content_4 col-sm-12 col-md-6 col-lg-3" data-animation="zoomIn">
                    <div class="ec_ser_inner">
                        <div class="ec-service-image">
                            <i class="fi fi-ts-donate"></i>
                        </div>
                        <div class="ec-service-desc">
                            <h2>Payment Secure</h2>
                            <p>Contact us 24 hours a day, 7 days a week</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--services Section End -->

    <!--  offer Section Start -->
    <section class="section ec-offer-section section-space-p section-space-m">
        <h2 class="d-none">Offer</h2>
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center ec-offer-content">
                    <h2 class="ec-offer-title">Sunglasses</h2>
                    <h3 class="ec-offer-stitle" data-animation="slideInDown">Super Offer</h3>
                    <span class="ec-offer-img" data-animation="zoomIn"><img
                                src="template/assets/images/offer-image/1.png"
                                alt="offer image"/></span>
                    <span class="ec-offer-desc">Acetate Frame Sunglasses</span>
                    <span class="ec-offer-price">$40.00 Only</span>
                    <a class="btn btn-primary" href="shop-left-sidebar-col-3.html" data-animation="zoomIn">Shop Now</a>
                </div>
            </div>
        </div>
    </section>
    <!-- offer Section End -->

    <!-- New Product Start -->
    <section class="section ec-new-product section-space-p" id="arrivals">
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
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content" data-animation="flipInY">
                    <div class="ec-product-inner">
                        <div class="ec-pro-image-outer">
                            <div class="ec-pro-image">
                                <a href="product-left-sidebar.html" class="image">
                                    <img class="main-image" src="template/assets/images/product-image/9_1.jpg"
                                         alt="Product"/>
                                    <img class="hover-image" src="template/assets/images/product-image/9_2.jpg"
                                         alt="Product"/>
                                </a>
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
                            <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Full Sleeve Cap T-Shirt</a>
                            </h5>
                            <div class="ec-pro-rating">
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star"></i>
                            </div>
                            <span class="ec-price">
                                <span class="old-price">$20.00</span>
                                <span class="new-price">$15.00</span>
                            </span>
                            <div class="ec-pro-option">
                                <div class="ec-pro-color">
                                    <span class="ec-pro-opt-label">Color</span>
                                    <ul class="ec-opt-swatch ec-change-img">
                                        <li><a href="#" class="ec-opt-clr-img"
                                               data-src="template/assets/images/product-image/9_1.jpg"
                                               data-src-hover="assets/images/product-image/9_1.jpg"
                                               data-tooltip="Orange"><span
                                                        style="background-color:#74c7ff;"></span></a></li>
                                        <li><a href="#" class="ec-opt-clr-img"
                                               data-src="template/assets/images/product-image/9_2.jpg"
                                               data-src-hover="assets/images/product-image/9_2.jpg"
                                               data-tooltip="Green"><span style="background-color:#7af6ff;"></span></a>
                                        </li>
                                        <li><a href="#" class="ec-opt-clr-img"
                                               data-src="template/assets/images/product-image/9_3.jpg"
                                               data-src-hover="assets/images/product-image/9_3.jpg"
                                               data-tooltip="Sky Blue"><span
                                                        style="background-color:#85ffeb;"></span></a></li>
                                    </ul>
                                </div>
                                <div class="ec-pro-size">
                                    <span class="ec-pro-opt-label">Size</span>
                                    <ul class="ec-opt-size">
                                        <li class="active"><a href="#" class="ec-opt-sz" data-old="$20.00"
                                                              data-new="$15.00" data-tooltip="Small">S</a></li>
                                        <li><a href="#" class="ec-opt-sz" data-old="$22.00" data-new="$17.00"
                                               data-tooltip="Medium">M</a></li>
                                        <li><a href="#" class="ec-opt-sz" data-old="$25.00" data-new="$20.00"
                                               data-tooltip="Large">X</a></li>
                                        <li><a href="#" class="ec-opt-sz" data-old="$27.00" data-new="$22.00"
                                               data-tooltip="Extra Large">XL</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content" data-animation="flipInY">
                    <div class="ec-product-inner">
                        <div class="ec-pro-image-outer">
                            <div class="ec-pro-image">
                                <a href="product-left-sidebar.html" class="image">
                                    <img class="main-image" src="template/assets/images/product-image/11_1.jpg"
                                         alt="Product"/>
                                    <img class="hover-image" src="template/assets/images/product-image/11_2.jpg"
                                         alt="Product"/>
                                </a>
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
                            <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Classic Leather purse</a></h5>
                            <div class="ec-pro-rating">
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star"></i>
                            </div>
                            <span class="ec-price">
                                <span class="old-price">$100.00</span>
                                <span class="new-price">$80.00</span>
                            </span>
                            <div class="ec-pro-option">
                                <div class="ec-pro-color">
                                    <span class="ec-pro-opt-label">Color</span>
                                    <ul class="ec-opt-swatch ec-change-img">
                                        <li class="active"><a href="#" class="ec-opt-clr-img"
                                                              data-src="template/assets/images/product-image/11_1.jpg"
                                                              data-src-hover="assets/images/product-image/11_1.jpg"
                                                              data-tooltip="Gray"><span
                                                        style="background-color:#dba4ff;"></span></a>
                                        </li>
                                        <li><a href="#" class="ec-opt-clr-img"
                                               data-src="template/assets/images/product-image/11_2.jpg"
                                               data-src-hover="assets/images/product-image/11_2.jpg"
                                               data-tooltip="Orange"><span
                                                        style="background-color:#ff4a77;"></span></a></li>
                                        <li><a href="#" class="ec-opt-clr-img"
                                               data-src="template/assets/images/product-image/11_3.jpg"
                                               data-src-hover="assets/images/product-image/11_3.jpg"
                                               data-tooltip="Green"><span style="background-color:#c9ff55;"></span></a>
                                        </li>
                                        <li><a href="#" class="ec-opt-clr-img"
                                               data-src="template/assets/images/product-image/11_4.jpg"
                                               data-src-hover="assets/images/product-image/11_4.jpg"
                                               data-tooltip="Sky Blue"><span
                                                        style="background-color:#ffcc5e;"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content" data-animation="flipInY">
                    <div class="ec-product-inner">
                        <div class="ec-pro-image-outer">
                            <div class="ec-pro-image">
                                <a href="product-left-sidebar.html" class="image">
                                    <img class="main-image" src="template/assets/images/product-image/12_1.jpg"
                                         alt="Product"/>
                                    <img class="hover-image" src="template/assets/images/product-image/12_2.jpg"
                                         alt="Product"/>
                                </a>
                                <span class="percentage">5%</span>
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
                            <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Fancy Ladies Sandal</a></h5>
                            <div class="ec-pro-rating">
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star"></i>
                            </div>
                            <span class="ec-price">
                                <span class="old-price">$100.00</span>
                                <span class="new-price">$80.00</span>
                            </span>
                            <div class="ec-pro-option">
                                <div class="ec-pro-color">
                                    <span class="ec-pro-opt-label">Color</span>
                                    <ul class="ec-opt-swatch ec-change-img">
                                        <li class="active"><a href="#" class="ec-opt-clr-img"
                                                              data-src="template/assets/images/product-image/12_1.jpg"
                                                              data-src-hover="assets/images/product-image/12_1.jpg"
                                                              data-tooltip="Gray"><span
                                                        style="background-color:#db9dff;"></span></a>
                                        </li>
                                        <li><a href="#" class="ec-opt-clr-img"
                                               data-src="template/assets/images/product-image/12_2.jpg"
                                               data-src-hover="assets/images/product-image/12_2.jpg"
                                               data-tooltip="Orange"><span
                                                        style="background-color:#00ffff;"></span></a></li>
                                        <li><a href="#" class="ec-opt-clr-img"
                                               data-src="template/assets/images/product-image/12_3.jpg"
                                               data-src-hover="assets/images/product-image/12_3.jpg"
                                               data-tooltip="Green"><span style="background-color:#ffa7f3;"></span></a>
                                        </li>
                                        <li><a href="#" class="ec-opt-clr-img"
                                               data-src="template/assets/images/product-image/12_4.jpg"
                                               data-src-hover="assets/images/product-image/12_4.jpg"
                                               data-tooltip="Sky Blue"><span
                                                        style="background-color:#89ff7e;"></span></a></li>
                                    </ul>
                                </div>
                                <div class="ec-pro-size">
                                    <span class="ec-pro-opt-label">Size</span>
                                    <ul class="ec-opt-size">
                                        <li class="active"><a href="#" class="ec-opt-sz" data-old="$50.00"
                                                              data-new="$40.00" data-tooltip="Small">6</a></li>
                                        <li><a href="#" class="ec-opt-sz" data-old="$60.00" data-new="$50.00"
                                               data-tooltip="Medium">7</a></li>
                                        <li><a href="#" class="ec-opt-sz" data-old="$70.00" data-new="$60.00"
                                               data-tooltip="Large">8</a></li>
                                        <li><a href="#" class="ec-opt-sz" data-old="$80.00" data-new="$70.00"
                                               data-tooltip="Extra Large">9</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content" data-animation="flipInY">
                    <div class="ec-product-inner">
                        <div class="ec-pro-image-outer">
                            <div class="ec-pro-image">
                                <a href="product-left-sidebar.html" class="image">
                                    <img class="main-image" src="template/assets/images/product-image/13_1.jpg"
                                         alt="Product"/>
                                    <img class="hover-image" src="template/assets/images/product-image/13_2.jpg"
                                         alt="Product"/>
                                </a>
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
                            <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Womens Leather Backpack</a>
                            </h5>
                            <div class="ec-pro-rating">
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star"></i>
                            </div>
                            <span class="ec-price">
                                <span class="old-price">$100.00</span>
                                <span class="new-price">$80.00</span>
                            </span>
                            <div class="ec-pro-option">
                                <div class="ec-pro-color">
                                    <span class="ec-pro-opt-label">Color</span>
                                    <ul class="ec-opt-swatch ec-change-img">
                                        <li class="active"><a href="#" class="ec-opt-clr-img"
                                                              data-src="template/assets/images/product-image/13_1.jpg"
                                                              data-src-hover="assets/images/product-image/13_1.jpg"
                                                              data-tooltip="Gray"><span
                                                        style="background-color:#deffa4;"></span></a>
                                        </li>
                                        <li><a href="#" class="ec-opt-clr-img"
                                               data-src="template/assets/images/product-image/13_2.jpg"
                                               data-src-hover="assets/images/product-image/13_2.jpg"
                                               data-tooltip="Orange"><span
                                                        style="background-color:#ffcdbe;"></span></a></li>
                                        <li><a href="#" class="ec-opt-clr-img"
                                               data-src="template/assets/images/product-image/13_3.jpg"
                                               data-src-hover="assets/images/product-image/13_3.jpg"
                                               data-tooltip="Green"><span style="background-color:#ff94df;"></span></a>
                                        </li>
                                        <li><a href="#" class="ec-opt-clr-img"
                                               data-src="template/assets/images/product-image/13_4.jpg"
                                               data-src-hover="template/assets/images/product-image/13_4.jpg"
                                               data-tooltip="Sky Blue"><span
                                                        style="background-color:#dd9bfc;"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 shop-all-btn"><a href="shop-left-sidebar-col-3.html">Shop All Collection</a>
                </div>
            </div>
        </div>
    </section>
    <!-- New Product end -->
@endsection
