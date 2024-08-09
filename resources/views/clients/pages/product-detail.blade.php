<!-- Ec breadcrumb start -->
@extends('clients.layouts.index')

@section('content')
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Sản phẩm chi tiết</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                                <li class="ec-breadcrumb-item active">Sản phẩm</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Sart Single product -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-pro-rightside ec-common-rightside col-lg-9 order-lg-last col-md-12 order-md-first">

                    <!-- Single product content Start -->
                    <div class="single-pro-block">
                        <div class="single-pro-inner">
                            <div class="row">
                                <div class="single-pro-img">
                                    <div class="single-product-scroll">
                                        <a class="ec-header-btn ec-header-wishlist ec-video-icon"
                                           data-link-action="quickview" title="Product Player" data-bs-toggle="modal"
                                           data-bs-target="#ec_product_player_modal">
                                            <div class="header-icon"><i class="fi-rr-video-camera-alt"></i></div>
                                        </a>
                                        <div class="single-product-cover">
                                            @foreach($productVariant as $item)
                                                <div class="single-slide zoom-image-hover">
                                                    <img class="img-responsive" src="{{ Storage::url($item->image) }}"
                                                         alt="">
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="single-nav-thumb">
                                            @foreach($productVariant as $item)
                                                <div class="single-slide">
                                                    <img class="main-image" src="{{ Storage::url($item->image) }}"
                                                         alt="Product"/>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                                <div class="single-pro-desc">
                                    <div class="single-pro-content">
                                        <h5 class="ec-single-title">{{$product->name}}</h5>
                                        <div class="ec-single-rating-wrap">
                                            <div class="ec-single-rating">
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star fill"></i>
                                                <i class="ecicon eci-star-o"></i>
                                            </div>
                                            <span class="ec-read-review"><a
                                                    href="#ec-spt-nav-review">Đánh giá sản phẩm</a></span>
                                        </div>
                                        <div class="ec-single-price-stoke">
                                            <div class="ec-single-price">
                                                <span class="ec-single-ps-title">Giá</span>
                                                @if($product->price_sale)
                                                    <span class="old-price original-price">
                                                            {{ number_format($product->price) }}đ
                                                        </span>
                                                    <span class="new-price">
                                                        {{ number_format($product->price_sale) }}đ
                                                    </span>
                                                @else
                                                    <span class="new-price">
                                                        {{ number_format($product->price) }}đ
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="ec-single-stoke">
                                                <span class="ec-single-ps-title">Mã</span>
                                                <span class="ec-single-sku">{{$product->sku}}</span>
                                            </div>
                                        </div>
                                        <form id="add-to-cart-form" action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <div class="ec-pro-variation">
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <div class="home">
                                                    <span>Kích thước</span> <br>
                                                    @foreach($sizes as $id => $name)
                                                        <input type="radio" class="btn-check" id="radio_size_{{ $id }}"
                                                               name="product_size_id" value="{{ $id }}"
                                                               style="width: 20px">
                                                        <label class="btn btn-light"
                                                               for="radio_size_{{ $id }}">{{ $name }}</label>
                                                    @endforeach
                                                </div>
                                                <div class="home">
                                                    <span>Màu sắc</span> <br>
                                                    @foreach($colors as $id => $name)
                                                        <input type="radio" class="btn-check" id="radio_color_{{ $id }}"
                                                               name="product_color_id" value="{{ $id }}"
                                                               style="width: 20px">
                                                        <label class="btn btn-light"
                                                               for="radio_color_{{ $id }}">{{ $name }}</label>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="ec-single-qty">
                                                <div class="qty-plus-minus">
                                                    <input class="qty-input" type="text" name="quantity" value="1"/>
                                                </div>
                                                <div class="ec-single-cart">
                                                    <button type="button" class="btn btn-primary"
                                                            id="add-to-cart-button">Thêm vào giỏ hàng
                                                    </button>
                                                </div>
                                                <div class="ec-single-wishlist">
                                                    <a class="ec-btn-group wishlist" title="Wishlist"><i
                                                            class="fi-rr-heart"></i></a>
                                                </div>
                                                <div class="ec-single-quickview">
                                                    <a href="#" class="ec-btn-group quickview"
                                                       data-link-action="quickview"
                                                       title="Quick view" data-bs-toggle="modal"
                                                       data-bs-target="#ec_quickview_modal"><i
                                                            class="fi-rr-eye"></i></a>
                                                </div>
                                            </div>
                                        </form>

                                        <div class="ec-single-social">
                                            <ul class="mb-0">
                                                <li class="list-inline-item facebook"><a href="#"><i
                                                            class="ecicon eci-facebook"></i></a></li>
                                                <li class="list-inline-item twitter"><a href="#"><i
                                                            class="ecicon eci-twitter"></i></a></li>
                                                <li class="list-inline-item instagram"><a href="#"><i
                                                            class="ecicon eci-instagram"></i></a></li>
                                                <li class="list-inline-item youtube-play"><a href="#"><i
                                                            class="ecicon eci-youtube-play"></i></a></li>
                                                <li class="list-inline-item behance"><a href="#"><i
                                                            class="ecicon eci-behance"></i></a></li>
                                                <li class="list-inline-item whatsapp"><a href="#"><i
                                                            class="ecicon eci-whatsapp"></i></a></li>
                                                <li class="list-inline-item plus"><a href="#"><i
                                                            class="ecicon eci-plus"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Single product content End -->
                    <!-- Single product tab start -->
                    <div class="ec-single-pro-tab">
                        <div class="ec-single-pro-tab-wrapper">
                            <div class="ec-single-pro-tab-nav">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab"
                                           data-bs-target="#ec-spt-nav-details" role="tab"
                                           aria-controls="ec-spt-nav-details" aria-selected="true">Detail</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-info"
                                           role="tab" aria-controls="ec-spt-nav-info" aria-selected="false">More
                                            Information</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-review"
                                           role="tab" aria-controls="ec-spt-nav-review"
                                           aria-selected="false">Reviews</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content  ec-single-pro-tab-content">
                                <div id="ec-spt-nav-details" class="tab-pane fade show active">
                                    <div class="ec-single-pro-tab-desc">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been the industry's standard dummy text ever since the
                                            1500s, when an unknown printer took a galley of type and scrambled it to
                                            make a type specimen book. It has survived not only five centuries, but also
                                            the leap into electronic typesetting, remaining essentially unchanged.
                                        </p>
                                        <ul>
                                            <li>Any Product types that You want - Simple, Configurable</li>
                                            <li>Downloadable/Digital Products, Virtual Products</li>
                                            <li>Inventory Management with Backordered items</li>
                                            <li>Flatlock seams throughout.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="ec-spt-nav-info" class="tab-pane fade">
                                    <div class="ec-single-pro-tab-moreinfo">
                                        <ul>
                                            <li><span>Weight</span> 1000 g</li>
                                            <li><span>Dimensions</span> 35 × 30 × 7 cm</li>
                                            <li><span>Color</span> Black, Pink, Red, White</li>
                                        </ul>
                                    </div>
                                </div>

                                <div id="ec-spt-nav-review" class="tab-pane fade">
                                    <div class="row">
                                        <div class="ec-t-review-wrapper">
                                            <div class="ec-t-review-item">
                                                <div class="ec-t-review-avtar">
                                                    <img src="/template/assets/images/review-image/1.jpg" alt=""/>
                                                </div>
                                                <div class="ec-t-review-content">
                                                    <div class="ec-t-review-top">
                                                        <div class="ec-t-review-name">Jeny Doe</div>
                                                        <div class="ec-t-review-rating">
                                                            <i class="ecicon eci-star fill"></i>
                                                            <i class="ecicon eci-star fill"></i>
                                                            <i class="ecicon eci-star fill"></i>
                                                            <i class="ecicon eci-star fill"></i>
                                                            <i class="ecicon eci-star-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ec-t-review-bottom">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and
                                                            typesetting industry. Lorem Ipsum has been the industry's
                                                            standard dummy text ever since the 1500s, when an unknown
                                                            printer took a galley of type and scrambled it to make a
                                                            type specimen.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ec-t-review-item">
                                                <div class="ec-t-review-avtar">
                                                    <img src="/template/assets/images/review-image/2.jpg" alt=""/>
                                                </div>
                                                <div class="ec-t-review-content">
                                                    <div class="ec-t-review-top">
                                                        <div class="ec-t-review-name">Linda Morgus</div>
                                                        <div class="ec-t-review-rating">
                                                            <i class="ecicon eci-star fill"></i>
                                                            <i class="ecicon eci-star fill"></i>
                                                            <i class="ecicon eci-star fill"></i>
                                                            <i class="ecicon eci-star-o"></i>
                                                            <i class="ecicon eci-star-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ec-t-review-bottom">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and
                                                            typesetting industry. Lorem Ipsum has been the industry's
                                                            standard dummy text ever since the 1500s, when an unknown
                                                            printer took a galley of type and scrambled it to make a
                                                            type specimen.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="ec-ratting-content">
                                            <h3>Add a Review</h3>
                                            <div class="ec-ratting-form">
                                                <form action="#">
                                                    <div class="ec-ratting-star">
                                                        <span>Your rating:</span>
                                                        <div class="ec-t-review-rating">
                                                            <i class="ecicon eci-star fill"></i>
                                                            <i class="ecicon eci-star fill"></i>
                                                            <i class="ecicon eci-star-o"></i>
                                                            <i class="ecicon eci-star-o"></i>
                                                            <i class="ecicon eci-star-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ec-ratting-input">
                                                        <input name="your-name" placeholder="Name" type="text"/>
                                                    </div>
                                                    <div class="ec-ratting-input">
                                                        <input name="your-email" placeholder="Email*" type="email"
                                                               required/>
                                                    </div>
                                                    <div class="ec-ratting-input form-submit">
                                                        <textarea name="your-commemt"
                                                                  placeholder="Enter Your Comment"></textarea>
                                                        <button class="btn btn-primary" type="submit"
                                                                value="Submit">Submit
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details description area end -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="ec-pro-leftside ec-common-leftside col-lg-3 order-lg-first col-md-12 order-md-last">
                    <div class="ec-sidebar-wrap">
                        <!-- Sidebar Category Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Danh mục</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <ul>
                                    <li>
                                        <ul>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="#">Men <span>-25</span></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Sidebar Category Block -->
                    </div>
                    <div class="ec-sidebar-slider">
                        <div class="ec-sb-slider-title">Best Sellers</div>
                        <div class="ec-sb-pro-sl">
                            <div>
                                <div class="ec-sb-pro-sl-item">
                                    <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                                            src="/template/assets/images/product-image/8_2.jpg" alt="product"/></a>
                                    <div class="ec-pro-content">
                                        <h5 class="ec-pro-title"><a href="product-left-sidebar.html">I Watch for Men</a>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sidebar Area Start -->
            </div>
        </div>
    </section>
    <!-- End Single product -->
    <section class="section ec-new-product section-space-p" id="arrivals">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">SẢN PHẨM TƯƠNG TỬ</h2>
                        <h2 class="ec-title">SẢN PHẨM TƯƠNG TỬ</h2>
                        <p class="sub-title">Duyệt qua bộ sưu tập sản phẩm hàng đầu</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- New Product Content -->
                <div class="row">
                    <!-- Product Content -->
                    @foreach($listProduct as $item)
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
                                            <img class="main-image" src="{{ Storage::url($item->img_thumb) }}"
                                                 alt="Product"/>
                                        </a>
                                        <span class="percentage">20%</span>
                                        <a href="#" class="quickview" data-link-action="quickview" title="Quick view"
                                           data-bs-toggle="modal" data-bs-target="#ec_quickview_modal">
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
                                            <ul class="ec-opt-swatch ec-change-img">
                                                <li class="active"><a href="#" class="ec-opt-clr-img"
                                                                      data-src="template/assets/images/product-image/6_1.jpg"
                                                                      data-src-hover="template/assets/images/product-image/6_1.jpg"
                                                                      data-tooltip="Gray"><span
                                                            style="background-color:#e8c2ff;"></span></a></li>
                                                <li><a href="#" class="ec-opt-clr-img"
                                                       data-src="template/assets/images/product-image/6_2.jpg"
                                                       data-src-hover="template/assets/images/product-image/6_2.jpg"
                                                       data-tooltip="Orange"><span
                                                            style="background-color:#9cfdd5;"></span></a></li>
                                            </ul>
                                        </div>
                                        <div class="ec-pro-size">
                                            <ul class="ec-opt-size">
                                                @foreach($sizes as $id => $name)
                                                    <li>
                                                        <a href="#" class="ec-opt-sz" data-tooltip="{{ $name }}">
                                                            {{ $name }}
                                                        </a>
                                                    </li>
                                                @endforeach
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
        </div>
        </div>
    </section>
@endsection

