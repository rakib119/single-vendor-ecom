<div class="product">
    <div class="thumb">
        <a href="{{ route('product.product_details', $product->slug) }}" class="image">
            <img src="{{ asset("uploads/products/$product->product_photo") }}" alt="Product" />
            <img class="hover-image" src="{{ asset("uploads/products/$product->product_photo") }}" alt="Product" />
        </a>
        <span class="badges">
            @php
                $save = 100 - ($product->discounted_price * 100) / $product->regular_price;
            @endphp
            <span class="sale">{{ $save > 0 ? '-' . round($save, 2) . ' %' : '' }}</span>
            <span class="new">{{ $product->created_at->diffInDays() <= 6 ? 'New' : '' }}</span>
        </span>
        <div class="actions">
            <a href="wishlist.html" class="action wishlist" title="Wishlist"><i class="pe-7s-like"></i></a>
            <a href="#" class="action quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal"
                data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
            <a href="compare.html" class="action compare" title="Compare"><i class="pe-7s-refresh-2"></i></a>
        </div>
        <button title="Add To Cart" class=" add-to-cart">Add
            To Cart</button>
    </div>
    <div class="content">
        <span class="ratings">
            <span class="rating-wrap">
                <span class="star" style="width: 80%"></span>
            </span>
            <span class="rating-num">( 4 Review )</span>
        </span>
        <h5 class="title"><a href="">{{ $product->product_name }}</a>
        </h5>
        <span class="price">
            <span class="new">৳{{ $product->discounted_price }}</span>
            <span class="old">৳{{ $product->regular_price }}</span>
        </span>
    </div>
</div>
