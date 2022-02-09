@extends('layouts.fontend')
@section('content')
    <div class="section ">
        <div class="hero-slider swiper-container slider-nav-style-1 slider-dot-style-1">
            <div class="swiper-wrapper">
                @foreach ($banners as $banner)
                    <div class="hero-slide-item-2 slider-height swiper-slide d-flex bg-color1">
                        <div class="container align-self-center">
                            <div class="row">
                                <div class="col-xl-6 col-lg-5 col-md-5 col-sm-5 align-self-center sm-center-view">
                                    <div class="hero-slide-content hero-slide-content-2 slider-animated-1">
                                        <span class="category">{{ $banner->offer_message }}</span>
                                        <h2 class="title-1">{{ $banner->banner_message }}</h2>
                                        <a href="shop-left-sidebar.html" class="btn btn-lg btn-primary btn-hover-dark">
                                            Shop
                                            Now <i class="fa fa-shopping-basket ml-15px" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div
                                    class="col-xl-6 col-lg-7 col-md-7 col-sm-7 d-flex justify-content-center position-relative">
                                    <div class="show-case">
                                        <div class="hero-slide-image">
                                            <img src="{{ asset('uploads') }}/banner/{{ $banner->banner_photo }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="swiper-pagination swiper-pagination-white"></div>
            <div class="swiper-buttons">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
    <div class="feature-area  mt-n-65px">
        <div class="container">
            <div class="row">
                @foreach ($features as $feature)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-feature">
                            <div class="feature-icon">
                                <img src="{{ asset("uploads/feature/$feature->feature_photo") }}" alt="">
                            </div>
                            <div class="feature-content">
                                <h4 class="title">{{ $feature->feature_name }}</h4>
                                <span class="sub-title">{{ $feature->feature_message }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="product-area pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center mb-0">
                        <h2 class="title">#products</h2>
                        <div class="nav-center">
                            <ul class="product-tab-nav nav align-items-center justify-content-center">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                                        href="#tab-product--all">All</a></li>
                                @foreach ($categories as $category)
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                            href="#tab-product--{{ $category->id }}">{{ $category->category_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="tab-content mb-30px0px">
                        <div class="tab-pane fade show active" id="tab-product--all">
                            <div class="row">
                                @forelse ($products as $product)
                                    <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up"
                                        data-aos-delay="400">
                                        @include('part_of_website.product')
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                        @foreach ($categories as $category)
                            <div class="tab-pane fade" id="tab-product--{{ $category->id }}">
                                <div class="row">
                                    @forelse (App\Models\Product::where('category_id',$category->id)->get() as $product)
                                        <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up"
                                            data-aos-delay="400">
                                            @include('part_of_website.product')
                                        </div>
                                    @empty
                                        <h3 class="text-center text-danger"> Nothing to show</h3>
                                    @endforelse
                                </div>
                            </div>
                        @endforeach
                        <!-- 2nd tab end -->
                    </div>
                    <a href="shop-left-sidebar.html" class="btn btn-lg btn-primary btn-hover-dark m-auto"> Load More
                        <i class="fa fa-arrow-right ml-15px" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="banner-area pt-100px pb-100px plr-15px">
        <div class="row m-0">
            @foreach ($categories as $category)
                <div class="col-12 col-lg-4 center-col mb-md-30px mb-lm-30px mb-3">
                    <div class="single-banner-2">
                        <img src="{{ asset('dashboard\uploads\category_photo') . '/' . $category->category_photo }}"
                            alt="">
                        <div class="item-disc">
                            <h4 class="title text-white" style="background:#000">{{ $category->category_name }}
                            </h4>
                            <a href="shop-left-sidebar.html" class="shop-link btn btn-primary">Shop Now <i
                                    class="fa fa-shopping-basket ml-5px" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="product-area pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-lg col-md col-12">
                    <div class="section-title mb-0">
                        <h2 class="title">#newarrivals</h2>
                    </div>
                </div>
                <div class="col-lg-auto col-md-auto col-12">
                    <ul class="product-tab-nav nav">
                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                                href="#tab-product-all">All</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                href="#tab-product-new">New</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                href="#tab-product-bestsellers">Bestsellers</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                href="#tab-product-itemssale">Items
                                Sale</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="tab-content top-borber">
                        <div class="tab-pane fade show active" id="tab-product-all">
                            <div class="new-product-slider swiper-container slider-nav-style-1 small-nav">
                                <div class="new-product-wrapper swiper-wrapper">
                                    @foreach ($products as $product)
                                        <div class="new-product-item swiper-slide">
                                            @include('part_of_website.product')
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-buttons">
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-product-new">
                            <div class="new-product-slider swiper-container slider-nav-style-1 small-nav">
                                <div class="new-product-wrapper swiper-wrapper">
                                    @foreach ($products as $product)
                                        <div class="new-product-item swiper-slide">
                                            @include('part_of_website.product')
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-buttons">
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-product-bestsellers">
                            <div class="new-product-slider swiper-container slider-nav-style-1 small-nav">
                                <div class="new-product-wrapper swiper-wrapper">
                                    @foreach ($products as $product)
                                        <div class="new-product-item swiper-slide">
                                            @include('part_of_website.product')
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-buttons">
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-product-itemssale">
                            <div class="new-product-slider swiper-container slider-nav-style-1 small-nav">
                                <div class="new-product-wrapper swiper-wrapper">
                                    @foreach ($products as $product)
                                        <div class="new-product-item swiper-slide">
                                            @include('part_of_website.product')
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-buttons">
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="deal-area deal-bg deal-bg-2" data-bg-image="{{ asset('fontend') }}/images/deal-img">
        <div class="container ">
            <div class="row">
                <div class="col-12">
                    <div class="deal-inner position-relative pt-100px pb-100px">
                        <div class="deal-wrapper">
                            <span class="category">#FASHION SHOP</span>
                            <h3 class="title">Deal Of The Day</h3>
                            <div class="deal-timing">
                                <div data-countdown="2021/12/31"></div>
                            </div>
                            <a href="shop-left-sidebar.html" class="btn btn-lg btn-primary btn-hover-dark m-auto">
                                Shop
                                Now <i class="fa fa-shopping-basket ml-15px" aria-hidden="true"></i></a>
                        </div>
                        <div class="deal-image">
                            <img class="img-fluid  deal-bg-2"
                                src="{{ asset('uploads') }}/banner/" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-blog-area pb-100px pt-100px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center mb-30px0px">
                        <h2 class="title">#blog</h2>
                        <p class="sub-title">Lorem ipsum dolor sit amet consectetur adipisicing eiusmod.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-md-30px mb-lm-30px">
                    <div class="single-blog">
                        <div class="blog-image">
                            <a href="blog-single-left-sidebar.html"><img
                                    src="{{ asset('fontend') }}/images/blog-image/1.jpg" class="img-responsive w-100"
                                    alt=""></a>
                        </div>
                        <div class="blog-text">
                            <div class="blog-athor-date">
                                <a class="blog-date height-shape" href="#"><i class="fa fa-calendar"
                                        aria-hidden="true"></i> 24 Aug, 2021</a>
                                <a class="blog-mosion" href="#"><i class="fa fa-commenting" aria-hidden="true"></i>
                                    1.5
                                    K</a>
                            </div>
                            <h5 class="blog-heading"><a class="blog-heading-link"
                                    href="blog-single-left-sidebar.html">There are many variations of
                                    passages of Lorem</a></h5>

                            <a href="blog-single-left-sidebar.html" class="btn btn-primary blog-btn"> Read More<i
                                    class="fa fa-arrow-right ml-5px" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-md-30px mb-lm-30px">
                    <div class="single-blog ">
                        <div class="blog-image">
                            <a href="blog-single-left-sidebar.html"><img
                                    src="{{ asset('fontend') }}/images/blog-image/2.jpg" class="img-responsive w-100"
                                    alt=""></a>
                        </div>
                        <div class="blog-text">
                            <div class="blog-athor-date">
                                <a class="blog-date height-shape" href="#"><i class="fa fa-calendar"
                                        aria-hidden="true"></i> 24 Aug, 2021</a>
                                <a class="blog-mosion" href="#"><i class="fa fa-commenting" aria-hidden="true"></i>
                                    1.5
                                    K</a>
                            </div>
                            <h5 class="blog-heading"><a class="blog-heading-link"
                                    href="blog-single-left-sidebar.html">It is a long established factoi
                                    ader will be distracted</a></h5>

                            <a href="blog-single-left-sidebar.html" class="btn btn-primary blog-btn"> Read More<i
                                    class="fa fa-arrow-right ml-5px" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-blog">
                        <div class="blog-image">
                            <a href="blog-single-left-sidebar.html"><img
                                    src="{{ asset('fontend') }}/images/blog-image/3.jpg" class="img-responsive w-100"
                                    alt=""></a>
                        </div>
                        <div class="blog-text">
                            <div class="blog-athor-date">
                                <a class="blog-date height-shape" href="#"><i class="fa fa-calendar"
                                        aria-hidden="true"></i> 24 Aug, 2021</a>
                                <a class="blog-mosion" href="#"><i class="fa fa-commenting" aria-hidden="true"></i>
                                    1.5
                                    K</a>
                            </div>
                            <h5 class="blog-heading"><a class="blog-heading-link"
                                    href="blog-single-left-sidebar.html">Contrary to popular belieflo
                                    lorem Ipsum is not</a></h5>


                            <a href="blog-single-left-sidebar.html" class="btn btn-primary blog-btn"> Read More<i
                                    class="fa fa-arrow-right ml-5px" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
