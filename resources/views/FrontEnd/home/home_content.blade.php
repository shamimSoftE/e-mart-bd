@extends('FrontEnd.master')

@section('title')
 Home
@endsection

@section('content')

{{-- @include('FrontEnd.include.header') --}}

<main class="main">

    <div class="intro-slider-container">
        <div class="intro-slider owl-carousel owl-simple owl-nav-inside" data-toggle="owl" data-owl-options='{
                "nav": false,
                "loop": true,
                "responsive": {
                    "992": {
                        "nav": true
                        "loop": true
                    }
                }
            }'>

            @foreach ($slider as $slide)
            <a href="@if(!@empty($slide->category->id)) {{ route('category_wise', $slide->category->id) }} @endif">
                <div class="intro-slide" style="background-image: url({{ asset("Back/images/slider/".$slide->image) }});">
                    <div class="container intro-content">
                        <div class="row">
                            <div class="col-auto offset-lg-3 intro-col">
                                <!--<h3 class="intro-subtitle">-->
                                <!--    @if(!@empty($slide->category->name))-->
                                <!--        {{ $slide->category->name }}-->
                                <!--    @endif-->
                                <!--</h3>-->
                                <h1 class="intro-title">
                                    <!--{{ $slide->name }} <br> {{ $slide->title }}-->
                                    <span>
                                        {{-- <sup class="font-weight-light">from</sup>
                                        <span class="text-primary">$999<sup>,99</sup></span> --}}
                                    </span>
                                </h1><!-- End .intro-title -->
                                <!--@if(!@empty($slide->category->id))-->
                                <!--    <a href="{{ route('category_wise', $slide->category->id) }}" class="btn btn-outline-primary-2">-->
                                <!--        <span>Shop Now</span>-->
                                <!--        <i class="icon-long-arrow-right"></i>-->
                                <!--    </a>-->
                                <!--@endif-->
                            </div><!-- End .col-auto offset-lg-3 -->
                        </div><!-- End .row -->
                    </div><!-- End .container intro-content -->
                </div><!-- End .intro-slide -->
                </a>
            @endforeach


        </div><!-- End .owl-carousel owl-simple -->

        <span class="slider-loader"></span><!-- End .slider-loader -->
    </div><!-- End .intro-slider-container -->



    <div class="mb-4"></div><!-- End .mb-2 -->

    <div class="container">
        <h2 class="title text-center mb-2" style="color: #007bff;">Top Categories</h2><!-- End .title -->

        <div class="cat-blocks-container">
            <div class="row">
                @foreach ($categoriesMenu as $popular)
                    @if(isset($popular->category_img) && $popular->category_img != null)
                        <div class="col-6 col-sm-4 col-lg-2">
                            <a href="{{ route('category_wise',$popular->id) }}" class="cat-block" style="box-shadow: 0 0 20px 1px #007bff24;">
                                <figure>
                                    <span>
                                        <img src="{{ asset('Back/images/category/'.$popular->category_img) }}" alt="Category image" style=" height: 99px; ">
                                    </span>
                                </figure>

                                <h3 class="cat-block-title" style="color: #007bff;">
                                    @if(!empty($popular->name))
                                        {{ $popular->name }}
                                    @endif
                                </h3>
                            </a>
                        </div>
                        @else
                        <div class="col-6 col-sm-4 col-lg-2">
                            <a href="{{ route('category_wise',$popular->id ) }}" class="cat-block" style="border: 1px solid blanchedalmond;background: linear-gradient(90deg, #065aaf, #722087)">
                                <figure>
                                    <span>
                                        <h3 class="cat-block-title" style="color: #007bff;">
                                            {{ $popular->name }}
                                        </h3>
                                    </span>
                                </figure>
                            </a>
                        </div>
                    @endif
                @endforeach

            </div><!-- End .row -->
        </div><!-- End .cat-blocks-container -->
    </div><!-- End .container -->


    <div class="mb-4"></div><!-- End .mb-2 -->


    <div class="mb-3"></div><!-- End .mb-3 -->

    <div class="bg-light pt-3 pb-5">
        @foreach ($section as $sec)

        <div class="container">
            <div class="row">
                @foreach (\App\Models\Banner::where('status', 1)->where('section_id', $sec->id)->get() as $banner)
                    <div class="col-12">
                        <div class="banner banner-overlay">
                            <a href="{{ route('banner_wise_product',$banner->id) }}" target="__blank">
                                <img src="{{ asset("Back/images/banner/". $banner->image) }}" alt="Banner-img">
                            </a>
                        </div>
                    </div><!-- End .col-lg-6 -->
                @endforeach
            </div><!-- End .row -->
        </div>

            <div class="container">
                <div class="heading heading-flex heading-border mb-3">
                    <div class="heading-left" style="border: 1.5px solid #3399ff;padding: 5px 10px 5px 10px;">
                        <h2 class="title">{{ $sec->title }} </h2><!-- End .title -->
                    </div><!-- End .heading-left -->

                <div class="heading-right">
                        <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active"  href="{{ route('view_more',$sec->slug) }}">
                                    Buy More
                                </a>
                            </li>

                        </ul>
                </div><!-- End .heading-right -->
                </div><!-- End .heading -->

                <div class="tab-content tab-content-carousel">
                    <div class="tab-pane p-0 fade show active" id="hot-all-tab" role="tabpanel" aria-labelledby="hot-all-link">
                        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                            data-owl-options='{
                                "nav": false,
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
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
                                    "1280": {
                                        "items":5,
                                        "nav": true
                                    }
                                }
                            }'>
                            @foreach($products as $key =>  $item)
                                @php

                                    try {
                                        $photos = json_decode($item['image']);
                                        } catch (\Throwable $th) {
                                        $photos = [];
                                    }

                                @endphp
                                @if(in_array($sec->id, json_decode($item['section_id'], TRUE)))

                                <div class="product">
                                    <figure class="product-media">
                                        {{-- <span class="product-label label-top">Top</span> --}}
                                        {{-- <span class="product-label label-sale">Sale</span> --}}
                                        <a href="{{ route('single_view',$item->slug) }}" title="{{ $item->name }}">

                                            <img src="{{ asset('Back/images/product/'.$photos[0]) }}" alt="Product image" class="product-image imgLol" style="background: white;">
                                        </a>

                                        {{-- <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                        </div> --}}
                                        <!-- End .product-action-vertical -->

                                        {{-- <div class="product-action">
                                            <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                        </div> --}}
                                        <!-- End .product-action -->
                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <div class="product-cat">
                                            @if(!empty($item->category->name))
                                                <a href="{{ route('category_wise', $item->category->id) }}">
                                                    {{ $item->category->name }}
                                                </a>
                                            @endif
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title">
                                            <a href="{{ route('single_view',$item->slug) }}">
                                                {{ $item->name }}
                                            </a>
                                        </h3><!-- End .product-title -->

                                        @php
                                            $amount = ($item->regular_price - $item->special_price)/$item->regular_price;
                                            $percentage = $amount*100;
                                            $show = number_format((int) $percentage);
                                        @endphp

                                        <div class="product-price">
                                            <span class="new-price"> ৳ {{ number_format($item->special_price) }}</span>
                                            <span class="old-price"> ৳ <del> {{  number_format($item->regular_price) }}</del> <span style="color: black"> @if(isset($show)) -{{ $show }}% @endif </span></span>
                                        </div><!-- End .product-price -->
                                        {{-- <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: 100%;"></div>
                                            </div>
                                            <span class="ratings-text">( 2 Reviews )</span>
                                        </div> --}}
                                        <!-- End .rating-container -->
                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->

                                @endif

                                @if($key == 9)

                                @break

                                @endif

                            @endforeach



                        </div><!-- End .owl-carousel -->
                    </div><!-- .End .tab-pane -->



                </div><!-- End .tab-content -->
            </div><!-- End .container -->
        @endforeach
    </div><!-- End .bg-light pt-5 pb-5 -->

    <div class="mb-3"></div><!-- End .mb-3 -->


    {{-- on sell product  $popularProducts--}}

    <div class="container">
        <h2 class="title mb-2" style="border: 1px dashed #3399ffb0;padding: 9px 5px 7px 13px;width: 155px; color: #007bff;">Being Sold</h2>

        <div class="cat-blocks-container">
            <div class="row">
                @foreach ($popularProducts as $pro)
                    @php
                        try {
                            $photos = json_decode($pro->product['image']);
                        } catch (\Throwable $th) {
                            $photos = [];
                        }
                    @endphp

                    <div class="col-6 col-sm-4 col-lg-2">
                        @if(!empty($pro->product))
                            <a href="{{ route('single_view',$pro->product->slug) }}" class="cat-block">
                                <figure>
                                    <span>
                                        <img src="{{ asset('Back/images/product/'.$photos[0]) }}" class="imgLol" alt="product image">
                                    </span>
                                </figure>

                                <h3 class="cat-block-title mt-1">{{ $pro->product->name }}</h3>
                                <span class="new-price">৳ {{ number_format($pro->product->special_price) }}</span>
                            </a>
                        @endif
                    </div>
                @endforeach

            </div>
        </div>
    </div>







</main><!-- End .main -->

{{-- @include('FrontEnd.include.footer') --}}

@endsection
