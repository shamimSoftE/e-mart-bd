@extends('FrontEnd.master')

@section('title')

   @if(!empty($product)) {{ $product->slug }} @else Product Details @endif
@endsection

@section('style')
    <style>
        .product-desc-row { padding-top: 0 !important; padding-bottom: 0 !important; min-height: 200px !important; }
    </style>
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


                    <div class="col-md-4 col-lg-4">
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
                    </div>

                    @php
                        $amount = ($product->regular_price - $product->special_price)/$product->regular_price;
                        $percentage = $amount*100;
                        $show = number_format((int) $percentage);
                    @endphp

                    <div class="col-md-5 col-lg-5" >
                        <div class="product-details">
                            <h1 class="product-title" >{{ $product->name }}</h1>

                            <div class="product-price" title="{{  $show }}% Off">
                                <span style="color: black"> ৳ {{ number_format( $product->special_price ) }} </span>
                                <del style="color:black; margin-left:3%" class="text-muted"> ৳{{ number_format( $product->regular_price ) }}</del>
                                <strong style="margin-left:3%;padding-top: 9px;height: 50px;text-align: center;width: 50px;border-radius: 50%;background: #cb2490;color: white;">
                                    {{  $show }}%
                                </strong>
                            </div> <!-- End .product-price -->

                            <div class="product-content">
                                <span><strong> Brand : </strong> @if(!empty($product->brand->name)) {{ $product->brand->name}} @else No Brand @endif</span>
                            </div><!-- End .product-section -->

                            <form action="{{ route('cart_store') }}" id="add-cart{{ $product->id }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                @if(!empty($product->color_id ))
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
                                @endif

                                <div class="details-filter-row details-row-size">
                                    <label for="qty">Qty:</label>
                                    <div class="product-details-quantity">
                                        <input type="number" name="quantity" class="form-control" max="{{ $product->quantity }}" value="1" min="{{ isset($product->omq) ? $product->omq : 1 }}" step="1" data-decimals="0" required>
                                    </div>
                                </div>
                            </form>


                            <form action="{{ route('cart_store2') }}" id="add-to-cart{{ $product->id }}" method="POST" style="display: none">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                @if(!empty($product->color_id ))
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
                                @endif

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
                                        <span>Add To Card</span>
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

                                    <a href="{{ route('cart_store2', $product->id) }}"
                                        onclick="event.preventDefault(); document.getElementById('add-to-cart{{ $product->id }}').submit();"
                                         class="btn btn-lg btn-outline-success ml-3 mt-1">
                                        <span>Buy Now</span>
                                    </a>
                                @else
                                    <a href="#" class="btn-product btn-cart">
                                        <span style="color: #df3030">Not Available</span>
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

                                </div>
                            </div><!-- End .product-details-footer -->
                        </div><!-- End .product-details -->
                    </div><!-- End .col-md-6 -->

                    <div class="col-md-3 col-lg-3">
                        <div class="product-details" >

                            <div class="product-content">
                                <div class="card" style="background: #fafafa;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3"> <img src="{{ asset('Front/assets/images/home-delivery.png') }}" style="height: 25px;width: 25px;float: right;" alt=""></div>
                                            <div class="col-9"> <span>Home Delivery</span> <br> <small> @if(!empty($product->delivery))2 - {{ $product->delivery }} day(s)  @else 2 - 10 day(s) @endif</small></div>
                                        </div>

                                        @if(!empty($product->warranty))
                                            <div class="row mt-1 ">
                                                <div class="col-3"><img src="{{ asset('Front/assets/images/warranty.png') }}" style="height: 25px;width: 25px;float: right;" alt=""></div>
                                                <div class="col-9"><span>{{ $product->warranty}} </span></div>
                                            </div>

                                            @else
                                            <div class="row mt-1">
                                                <div class="col-3"><img src="{{ asset('Front/assets/images/no-warranty.png') }}" style="height: 25px;width: 25px;float: right;" alt=""></div>
                                                <div class="col-9"><span> {{ __('Warranty not available')}} </span></div>
                                            </div>
                                        @endif

                                        @if(!empty($product->cod))
                                            <div class="row mt-1">
                                                <div class="col-3"><img src="{{ asset('Front/assets/images/cash-on-delivery.png') }}" style="height: 25px;width: 25px;float: right;" alt=""></div>
                                                <div class="col-9"><span>{{ __( 'Cash on Delivery Available') }} </span></div>
                                            </div>
                                            @else
                                            <div class="row mt-1">
                                                <div class="col-3"><img src="{{ asset('Front/assets/images/cash-on-delivery.png') }}" style="height: 25px;width: 25px;float: right;" alt=""></div>
                                                <div class="col-9"><span>{{ __( 'Cash On Delivery Not Available') }} </span></div>
                                            </div>
                                        @endif

                                        <div class="row mt-1">
                                            <div class="col-3"> <img src="{{ asset('Front/assets/images/7days.png') }}" style="height: 25px;width: 25px;float: right;" alt=""></div>
                                            <div class="col-9"> <span>7 Day Return</span>
                                                @if(!empty($product->return_policy))
                                                    <a href="#return-police-modal" data-toggle="modal" class="text-muted" title="Read Return Police" style="float: right; font-size: 11px">
                                                        (i)
                                                    </a>
                                                    @else
                                                    <br/>
                                                    <a href="#" class="text-dark" title="Return Police Not Available" style="font-size: 11px">
                                                        Return Policy Not Available
                                                    </a>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div><!-- End .product-section -->

                        </div><!-- End .product-details -->
                    </div>
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->
        </div><!-- End .container -->

        <div class="modal fade" id="return-police-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="icon-close"></i></span>
                        </button>

                        <div class="form-box">
                            <p>
                                @if(!empty($product->return_policy))
                                {{ $product->return_policy }}
                                @else
                                    Not Available
                                @endif
                            </p>
                        </div><!-- End .form-box -->
                    </div><!-- End .modal-body -->
                </div><!-- End .modal-content -->
            </div><!-- End .modal-dialog -->
        </div>
        <!-- End .modal -->

        <div class="product-details-tab product-details-extended">
            <div class="container">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Returns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews ({{ $reviews->count() }})</a>
                    </li>
                </ul>
            </div><!-- End .container -->

            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                    <div class="product-desc-content">
                        {{-- <div class="product-desc-row bg-image"  style="background-image: url({{ asset('Back/images/product/'.$photos[0]) }}); height: 150px; width: auto"> --}}
                        <div class="product-desc-row bg-image" >
                            <div class="container">
                                {{-- <div class="row justify-content-end">
                                    <div class="col-sm-6 col-lg-4"> --}}
                                        <h2>Product Information</h2>
                                        {!!  $product->long_description  !!}
                                    {{-- </div><!-- End .col-lg-4 -->
                                </div><!-- End .row --> --}}
                            </div><!-- End .container -->
                        </div><!-- End .product-desc-row -->
                    </div><!-- End .product-desc-section -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                    <div class="product-desc-content">
                        <div class="container">
                            <h3>Information</h3>
                            {{ $product->short_description }}
                        </div><!-- End .container -->
                    </div><!-- End .product-desc-section -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                    <div class="product-desc-content">
                        <div class="container">
                            <h3>Product returns</h3>
                            <p>
                                {{ $product->return_policy }}
                            </p>
                        </div><!-- End .container -->
                    </div><!-- End .product-desc-section -->
                </div><!-- .End .tab-pane -->
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
                                            <span class="review-date" style="font-size: 12px;">{{ $review->updated_at->diffForHumans(); }}</span>
                                        </div><!-- End .col -->
                                        <div class="col">
                                            <h4>{{ $review->title }}</h4>

                                            <div class="review-content">
                                                <p>
                                                    {{ $review->description }}
                                                </p>
                                            </div><!-- End .review-section -->

                                            <div class="review-action">
                                                <img src="{{ asset('Back/images/review/'.$review->image) }}" style="height: 100px" alt="">
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

        @if(isset($relatedProduct))
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


