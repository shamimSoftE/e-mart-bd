@extends('FrontEnd.master')

@section('title')

   @if(!empty($product)) {{ $product->slug }} @else Product Details @endif
@endsection

@section('content')


<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="">Products Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">Extended Description</li>
            </ol>


        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="product-details-top mb-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery">
                            <figure class="product-main-image">
                                <img id="product-zoom" src="{{ asset('Back/images/product/medium/'.$photos[0]) }}"
                                data-zoom-image="{{ asset('Back/images/product/large/'.$photos[0]) }}" alt="product image">

                                <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                    <i class="icon-arrows"></i>
                                </a>
                            </figure>
                            <div id="product-zoom-gallery" class="product-image-gallery">
                                @foreach($photos as $pic)
                                    <a class="product-gallery-item" href="#" data-image="{{ asset('Back/images/product/medium/'.$pic) }}" data-zoom-image="{{ asset('Back/images/product/large/'.$pic) }}">
                                        <img src="{{ asset('Back/images/product/small/'.$pic) }}" alt="product side">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div><!-- End .col-md-6 -->

                    {{-- get percentage --}}

                    @php
                        $amount = ($product->regular_price - $product->special_price)/$product->regular_price;
                        $percentage = $amount*100;
                        $show = number_format((int) $percentage);
                    @endphp

                    <div class="col-md-6">
                        <div class="product-details">
                            <h1 class="product-title" >{{ $product->name }}</h1><!-- End .product-title -->

                            <div class="product-price" title="{{  $show }}% Off">
                                <span style="color: black"> ৳ {{ number_format( $product->special_price ) }} </span>
                                <del style="color:black; margin-left:3%" class="text-muted"> ৳{{ number_format( $product->regular_price ) }}</del>
                                <strong style="margin-left:3%;padding-top: 9px;height: 50px;text-align: center;width: 50px;border-radius: 50%;background: #cb2490;color: white;">
                                    {{  $show }}%
                                </strong>

                            </div><!-- End .product-price -->

                            <div class="product-content">
                                <span><strong> Brand : </strong> @if(!empty($product->brand->name)) {{ $product->brand->name}} @else No Brand @endif</span> |
                                <span> <strong> Delivery  : </strong>  @if(!empty($product->delivery)) {{ $product->delivery }} days  @else 7 days @endif</span> |
                                <span> <strong> Warranty  : </strong> @if(!empty($product->warranty)) {{ $product->warranty}} @else N/A @endif</span>
                            </div><!-- End .product-section -->

                            <form action="{{ route('cart_store') }}" id="add-cart{{ $product->id }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <div class="details-filter-row details-row-size">
                                    <label for="size">Color:</label>
                                    <div class="select-custom">
                                        <select name="color_id" id="size" class="form-control" required>
                                            @foreach($colors as $color)
                                                @if($product->color_id != null)
                                                    @if(in_array($color->id, json_decode($product->color_id, TRUE)))
                                                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="details-filter-row details-row-size">
                                    <label for="qty">Qty:</label>
                                    <div class="product-details-quantity">
                                        <input type="number" name="quantity" class="form-control" max="{{ $product->quantity }}" value="1" min="1" step="1" data-decimals="0" required>
                                    </div>
                                </div>
                            </form>

                            <div class="product-details-action">
                                @if($product->quantity >= 1)
                                    <a href="{{ route('cart_store') }}"
                                    onclick="event.preventDefault(); document.getElementById('add-cart{{ $product->id }}').submit();"
                                    class="btn btn-lg btn-outline-info ml-3 mt-1">
                                        <span>কার্টে যোগ করুন</span>
                                    </a>
                                    <style>
                                        .orderNow:hover{
                                            color: #fff!important;
                                            border-color: #39f !important;
                                            background-color: #39f!important;
                                        }
                                        .orderNow
                                        {
                                            color: #39f !important;
                                            border: 0.1rem solid #39f !important;
                                        }
                                    </style>
                                    {{-- <a href="#" class="btn-product btn-compare">এখনই কিনুন</a> --}}
                                    <a href="{{ route('cart_item') }}" class="btn btn-lg btn-outline-success ml-3 mt-1">
                                        <span>এখনই কিনুন</span>
                                    </a>
                                @else
                                    <a href="#" class="btn-product btn-cart">
                                        <span style="color: #df3030">পণ্যটি শেষ</span>
                                    </a>
                                @endif

                            </div><!-- End .product-details-action -->

                            <div class="product-details-footer">
                                <div class="product-cat">
                                    <span>Category:</span>

                                    @if(!empty( $product->category->name))
                                        <a href=""> {{ $product->category->name}}</a>
                                    @endif
                                </div><!-- End .product-cat -->



                                <div class="social-icons social-icons-sm">
                                    {{-- <span class="social-label">Share:</span> --}}
                                    <div class="ratings-container">
                                        <div class="ratings">
                                            @foreach ($reviews as $review)

                                                @if($review->rating == 1 )
                                                    <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                                                    @elseif ($review->rating == 2)
                                                    <div class="ratings-val" style="width: 40%;"></div><!-- End .ratings-val -->
                                                    @elseif ($review->rating == 3)
                                                    <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                                                    @elseif ($review->rating == 4)
                                                    <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                                    @elseif ($review->rating == 5)
                                                    <div class="ratings-val" style="width: 100%;"></div><!-- End .ratings-val -->
                                                    @else
                                                    <div class="ratings-val" style="width: 0%;"></div><!-- End .ratings-val -->
                                                @endif
                                            @endforeach
                                        </div><!-- End .ratings -->
                                        <a class="ratings-text" href="#product-review-link" id="review-link">( {{ $reviews->count() }} Reviews )</a>
                                    </div><!-- End .rating-container -->
                                    {{-- <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                    <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                    <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                   <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a> --}}
                                </div>
                            </div><!-- End .product-details-footer -->
                        </div><!-- End .product-details -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->
        </div><!-- End .container -->

        <div class="product-details-tab product-details-extended">
            <div class="container">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    {{--<li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                    </li>--}}
                    <li class="nav-item">
                        <a class="nav-link active" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Description</a>
                    </li>
                    {{--<li class="nav-item">
                        <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                    </li>--}}
                    <li class="nav-item">
                        <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews ({{ $reviews->count() }})</a>
                    </li>
                </ul>
            </div><!-- End .container -->

            <div class="tab-content">
                {{--<div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                    <div class="product-desc-content">
                        <div class="product-desc-row bg-image"  style="background-image: url({{ asset('Back/images/product/'.$photos[0]) }}); height: 150px; width: auto">
                            <div class="container">
                                <div class="row justify-content-end">
                                    <div class="col-sm-6 col-lg-4">
                                        <h2>Product Information</h2>
                                        {{ $product->long_description }}
                                    </div><!-- End .col-lg-4 -->
                                </div><!-- End .row -->
                            </div><!-- End .container -->
                        </div><!-- End .product-desc-row -->
                    </div><!-- End .product-desc-section -->
                </div><!-- .End .tab-pane -->--}}
                <div class="tab-pane fade show active" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                    <div class="product-desc-content">
                        <div class="container">
                            <h3>Information</h3>
                            {{ $product->short_description }}
                        </div><!-- End .container -->
                    </div><!-- End .product-desc-section -->
                </div><!-- .End .tab-pane -->
                {{--<div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                    <div class="product-desc-content">
                        <div class="container">
                            <h3>Delivery & returns</h3>
                            <p>We deliver to over 100 countries around the world. For full details of the delivery options we offer, please view our <a href="#">Delivery information</a><br>
                            We hope you’ll love every purchase, but if you ever need to return an item you can do so within a month of receipt. For full details of how to make a return, please view our <a href="#">Returns information</a></p>
                        </div><!-- End .container -->
                    </div><!-- End .product-desc-section -->
                </div><!-- .End .tab-pane -->--}}
                <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                    <div class="reviews">
                        <div class="container">
                            <h3>Reviews ({{ $reviews->count() }})</h3>
                            @foreach ($reviews as $review)

                                <div class="review">
                                    <div class="row no-gutters">
                                        <div class="col-auto">

                                            <h4>
                                                <a href="#">
                                                    @if(!empty($review->customer->name))
                                                        {{ $review->customer->name }}.
                                                        @else
                                                        {{ __('John') }}
                                                    @endif
                                                </a>
                                        </h4>

                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    @if($review->rating == 1 )
                                                        <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                                                        @elseif ($review->rating == 2)
                                                        <div class="ratings-val" style="width: 40%;"></div><!-- End .ratings-val -->
                                                        @elseif ($review->rating == 3)
                                                        <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                                                        @elseif ($review->rating == 4)
                                                        <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                                        @elseif ($review->rating == 5)
                                                        <div class="ratings-val" style="width: 100%;"></div><!-- End .ratings-val -->
                                                        @else
                                                        <div class="ratings-val" style="width: 0%;"></div><!-- End .ratings-val -->
                                                    @endif
                                                </div><!-- End .ratings -->
                                            </div><!-- End .rating-container -->
                                            <span class="review-date">{{ $review->updated_at->diffForHumans(); }}</span>
                                        </div><!-- End .col -->
                                        <div class="col">
                                            <h4>{{ $review->title }}</h4>

                                            <div class="review-content">
                                                <p>
                                                    {{ $review->description }}
                                                </p>
                                            </div><!-- End .review-section -->

                                            <div class="review-action">
                                                <img src="{{ asset('Back/images/review/'.$review->image) }}" alt="">
                                                {{-- <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                                <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a> --}}
                                            </div><!-- End .review-action -->
                                        </div><!-- End .col-auto -->
                                    </div><!-- End .row -->
                                </div><!-- End .review -->
                            @endforeach


                        </div><!-- End .container -->
                    </div><!-- End .reviews -->
                </div><!-- .End .tab-pane -->
            </div><!-- End .tab-section -->
        </div><!-- End .product-details-tab -->

        @if(!empty($relatedProduct))
            <div class="container">
            <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->
            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                data-owl-options='{
                    "nav": false,
                    "dots": true,
                    "margin": 20,
                    "loop": true,
                    "responsive": {
                        "0": {
                            "items":1
                        },
                        "480": {
                            "items":2
                        },
                        "768": {
                            "items":3
                        },
                        "992": {
                            "items":4
                        },
                        "1200": {
                            "items":4,
                            "nav": true,
                            "dots": false,
                            "loop": true
                        }
                    }
                }'>

                @forelse ($relatedProduct as $item )
                        @php
                            $photos = json_decode($item['image'])
                        @endphp
                    <div class="product product-7">
                        <figure class="product-media">
                            {{-- <span class="product-label label-new">{{ $item->tag_title }}</span> --}}
                            <a href="{{ route('single_view',$item->slug) }}">
                                <img src="{{ asset('Back/images/product/'.$photos[0]) }}" alt="Product image" class="product-image">
                            </a>

                            {{-- <div class="product-action">
                                <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                            </div> --}}
                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <div class="product-cat">
                                <a href="#">{{ $item->category->name}}</a>
                            </div><!-- End .product-cat -->
                            <h3 class="product-title"><a href="{{ route('single_view',$item->slug) }}">{{ $item->name }}</a></h3><!-- End .product-title -->
                            <div class="product-price">
                                ৳{{ number_format( $item->special_price ) }}
                                <del style="color:black; margin-left:3%" class="text-muted"> ৳{{ number_format( $item->regular_price ) }}</del>
                            </div><!-- End .product-price -->
                            {{-- <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: 20%;"></div>
                                </div>
                                <span class="ratings-text">( 2 Reviews )</span>
                            </div> --}}

                            {{-- <div class="product-nav product-nav-dots">
                                <a href="#" class="active" style="background: #cc9966;"><span class="sr-only">Color name</span></a>
                                <a href="#" style="background: #7fc5ed;"><span class="sr-only">Color name</span></a>
                                <a href="#" style="background: #e8c97a;"><span class="sr-only">Color name</span></a>
                            </div> --}}
                            <!-- End .product-nav -->
                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                @empty

                @endforelse



            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
        @endif
    </div><!-- End .page-section -->
</main><!-- End .main -->



@endsection

@section('script')

<script src="{{ asset('Front') }}/assets/js/jquery.elevateZoom.min.js"></script>
@endsection


