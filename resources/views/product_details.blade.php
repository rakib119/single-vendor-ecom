@extends('layouts.fontend')

@section('content')

    <div class="product-details-area pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                    <div class="swiper-container zoom-top">
                        <div class="swiper-wrapper">
                            @php
                                $product_id = $product->id;
                            @endphp
                            <div class="swiper-slide zoom-image-hover">
                                <img class="img-responsive m-auto"
                                    src="{{ asset('uploads/products') }}/{{ $product->product_photo }}"
                                    alt="Photo not found">
                            </div>
                            <div class="swiper-slide zoom-image-hover">
                                <img class="img-responsive m-auto"
                                    src="{{ asset('fontend') }}/images/product-image/zoom-image/2.jpg" alt="">
                            </div>
                            <div class="swiper-slide zoom-image-hover">
                                <img class="img-responsive m-auto"
                                    src="{{ asset('fontend') }}/images/product-image/zoom-image/3.jpg" alt="">
                            </div>
                            <div class="swiper-slide zoom-image-hover">
                                <img class="img-responsive m-auto"
                                    src="{{ asset('fontend') }}/images/product-image/zoom-image/4.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-container zoom-thumbs mt-3 mb-3">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img class="img-responsive m-auto"
                                    src="{{ asset('fontend') }}/images/product-image/small-image/1.jpg" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img class="img-responsive m-auto"
                                    src="{{ asset('fontend') }}/images/product-image/small-image/2.jpg" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img class="img-responsive m-auto"
                                    src="{{ asset('fontend') }}/images/product-image/small-image/3.jpg" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img class="img-responsive m-auto"
                                    src="{{ asset('fontend') }}/images/product-image/small-image/4.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                    <div class="product-details-content quickview-content">
                        <h2>{{ $product->product_name }}</h2>
                        <div class="pricing-meta">
                            <ul>
                                <li class="old-price not-cut">৳ {{ $product->discounted_price }}</li>

                                <li> <s style="font-size: 15px">৳ {{ $product->regular_price }} </s>&nbsp;&nbsp;&nbsp;
                                    @php
                                        $save = 100 - ($product->discounted_price * 100) / $product->regular_price;
                                    @endphp
                                    <span
                                        class="sale">{{ $save > 0 ? '-' . round($save, 2) . ' %' : '' }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="pro-details-rating-wrap">
                            <div class="rating-product">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <span class="read-review"><a class="reviews" href="#">( 5 Customer Review )</a></span>
                        </div>
                        <input type="hidden" id="input_color">
                        <input type="hidden" id="input_size">
                        @if ($inventories->count() > 0)
                            <div class="pro-details-color-info d-flex align-items-center">
                                <span>Color </span>
                                <div class="pro-details-color">
                                    <ul>
                                        @foreach ($inventories as $inventory)
                                            <li id="{{ $inventory->color_id }}" class="color_palate"
                                                style="cursor:pointer" title="{{ $inventory->getColor->color_name }}">
                                                <a
                                                    style="border::1px solid black; background: {{ $inventory->getColor->color_code }}"></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif


                        <div class="pro-details-size-info d-flex align-items-center">
                            <span>Size</span>
                            <select id="product_sizes" class="form-control">
                                <option selected>Choose color first</option>
                            </select>
                        </div>
                        <p class="m-0">
                            Availability:
                            <span id="default_stock"
                                class="badge {{ $total_inventories > 0 ? 'bg-success' : 'bg-danger' }}">{{ $total_inventories > 0 ? 'In stock' : 'Out of stock' }}</span>
                            <span id="available_stock"> </span>
                        </p>
                        <p class="m-0">{!! $product->short_description !!}</p>
                        <div class="pro-details-quality">
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1" />
                            </div>
                            <div class="pro-details-cart">
                                <button class="add-cart" href="#"> Add To
                                    Cart</button>
                            </div>
                            <div class="pro-details-compare-wishlist pro-details-wishlist ">
                                <a href="wishlist.html"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-details-compare-wishlist pro-details-compare">
                                <a href="compare.html"><i class="pe-7s-refresh-2"></i></a>
                            </div>
                        </div>
                        <div class="pro-details-sku-info pro-details-same-style  d-flex">
                            <span>Product Code: </span>
                            <ul class="d-flex">
                                <li>
                                    {{ $product->product_code }}
                                </li>
                            </ul>
                        </div>
                        <div class="pro-details-categories-info pro-details-same-style d-flex">
                            <span>Categories: </span>
                            <ul class="d-flex">
                                <li>
                                    <a
                                        href="#">{{ App\Models\Category::find($product->category_id)->category_name }}.</a>
                                </li>
                                <li>
                                    <a
                                        href="#">{{ App\Models\Subcategory::find($product->subcategory_id)->subcategory_name }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="pro-details-social-info pro-details-same-style d-flex">
                            <span>Share: </span>
                            <ul class="d-flex">
                                <li>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-google"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="description-review-area pb-100px" data-aos="fade-up" data-aos-delay="200">
        <div class="container">
            <div class="description-review-wrapper">
                <div class="description-review-topbar nav">
                    <a data-bs-toggle="tab" href="#des-details2">Information</a>
                    <a class="active" data-bs-toggle="tab" href="#des-details1">Description</a>
                    <a data-bs-toggle="tab" href="#des-details3">Reviews (02)</a>
                </div>
                <div class="tab-content description-review-bottom">
                    <div id="des-details2" class="tab-pane">
                        <div class="product-anotherinfo-wrapper text-start">
                            <ul>
                                <li><span>Weight</span> {{ $product->weight }}</li>
                                <li><span>Dimensions</span>{{ $product->dimensions }}</li>
                                <li><span>Materials</span>{{ $product->materials }}</li>
                                <li><span>Other Info</span> {{ $product->other_info }}</li>
                            </ul>
                        </div>
                    </div>
                    <div id="des-details1" class="tab-pane active">
                        <div class="">
                            <p>{!! $product->description !!} </p>
                        </div>
                    </div>
                    <div id="des-details3" class="tab-pane">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="review-wrapper">
                                    <div class="single-review">
                                        <div class="review-img">
                                            <img src="{{ asset('fontend') }}/images/review-image/1.png" alt="" />
                                        </div>
                                        <div class="review-content">
                                            <div class="review-top-wrap">
                                                <div class="review-left">
                                                    <div class="review-name">
                                                        <h4>White Lewis</h4>
                                                    </div>
                                                    <div class="rating-product">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <div class="review-left">
                                                    <a href="#">Reply</a>
                                                </div>
                                            </div>
                                            <div class="review-bottom">
                                                <p>
                                                    Vestibulum ante ipsum primis aucibus orci luctustrices posuere
                                                    cubilia Curae Suspendisse viverra ed viverra. Mauris ullarper
                                                    euismod vehicula. Phasellus quam nisi, congue id nulla.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-review child-review">
                                        <div class="review-img">
                                            <img src="{{ asset('fontend') }}/images/review-image/2.png" alt="" />
                                        </div>
                                        <div class="review-content">
                                            <div class="review-top-wrap">
                                                <div class="review-left">
                                                    <div class="review-name">
                                                        <h4>White Lewis</h4>
                                                    </div>
                                                    <div class="rating-product">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <div class="review-left">
                                                    <a href="#">Reply</a>
                                                </div>
                                            </div>
                                            <div class="review-bottom">
                                                <p>Vestibulum ante ipsum primis aucibus orci luctustrices posuere
                                                    cubilia Curae Sus pen disse viverra ed viverra. Mauris ullarper
                                                    euismod vehicula.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="ratting-form-wrapper pl-50">
                                    <h3>Add a Review</h3>
                                    <div class="ratting-form">
                                        <form action="#">
                                            <div class="star-box">
                                                <span>Your rating:</span>
                                                <div class="rating-product">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="rating-form-style">
                                                        <input placeholder="Name" type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="rating-form-style">
                                                        <input placeholder="Email" type="email" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="rating-form-style form-submit">
                                                        <textarea name="Your Review" placeholder="Message"></textarea>
                                                        <button class="btn btn-primary btn-hover-color-primary "
                                                            type="submit" value="Submit">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($retated_product->count())
        <div class="related-product-area pb-100px">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center mb-30px0px line-height-1">
                            <h2 class="title m-0">Related Products</h2>
                        </div>
                    </div>
                </div>
                <div class="new-product-slider swiper-container slider-nav-style-1 small-nav">
                    <div class="new-product-wrapper swiper-wrapper">
                        @foreach ($retated_product as $product)
                            <div class="new-product-item swiper-slide">
                                @include('part_of_website.product')
                            </div>
                        @endforeach
                    </div>
                    <!-- Add Arrows -->
                    <div class="swiper-buttons">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('javascript')
    <script>
        $(document).ready(function() {
            $(".color_palate").click(function() {
                var product_id = {{ $product_id }};
                var color_id = $(this).attr('id');
                $('#input_color').val(color_id);
                $('#input_size').val("");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('get_sizes') }}",
                    data: {
                        product_id: product_id,
                        color_id: color_id
                    },
                    success: function(data) {
                        $('#product_sizes').html(data)

                    }

                });
            });
            $('#product_sizes').change(function() {
                var size_id = $('#product_sizes').val();
                $('#input_size').val(size_id);
                var color_id = $('#input_color').val();
                var product_id = {{ $product_id }};

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('get_available_qty') }}",
                    data: {
                        product_id: product_id,
                        color_id: color_id,
                        size_id: size_id,
                    },
                    success: function(data) {
                        $("#default_stock").hide();
                        var target = $("#available_stock");
                        if (data > 0) {
                            target.addClass('badge bg-success text-white');
                            target.html("In stock");
                        } else {
                            target.addClass('badge bg-danger text-white');
                            target.html("Out of stock");
                        }
                    }

                });
            });
        });
    </script>
@endsection
