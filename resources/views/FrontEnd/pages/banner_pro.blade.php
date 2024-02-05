@extends('FrontEnd.master')

@section('title')
   Offer Products
@endsection

@section('content')

    <main class="main">

        <div class="page-header text-center" style="background-image: url('{{ asset('Back/images/banner/small/'.$banner->image) }}')">

        </div>

        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="">pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                       @yield('title')
                    </li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            {{-- <h2 class="title mb-2">বিক্রি হচ্ছে</h2><!-- End .title --> --}}

            <div class="cat-blocks-container">
                <div class="row">
                    @foreach ($products as $pro)
                        @php
                            $photos = json_decode($pro['image'])
                        @endphp
                        @if(in_array($banner->section_id, json_decode($pro['section_id'], TRUE)))

                            <div class="col-6 col-sm-4 col-lg-2">

                                    <a href="{{ route('single_view',$pro->slug) }}" class="cat-block">
                                        <figure>
                                            <span>
                                                <img src="{{ asset('Back/images/product/'.$photos[0]) }}" class="imgLol" alt="product image">
                                            </span>
                                        </figure>

                                        @php
                                                $amount = ($pro->regular_price - $pro->special_price)/$pro->regular_price;
                                                $percentage = $amount*100;
                                                $show = number_format((int) $percentage);
                                            @endphp

                                        <h3 class="cat-block-title mt-1">{{ $pro->name }}</h3>
                                        <span class="new-price">৳ {{ number_format($pro->special_price) }} <del class="text-muted">৳ {{  number_format($pro->regular_price) }}</del> <span style="color: black"> @if(isset($show)) -{{ $show }}% @endif </span></span>
                                    </a>

                            </div><!-- End .col-sm-4 col-lg-2 -->
                        @endif
                    @endforeach



                </div><!-- End .row -->
            </div><!-- End .cat-blocks-container -->
        </div>

    </main>

@endsection
