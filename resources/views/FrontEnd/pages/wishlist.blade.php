@extends('FrontEnd.master')

@section('title')
{{ request()->url() }}
@endsection

@section('section')
    @include('FrontEnd.include.header_top')


    <main class="main">
        <div class="page-header text-center" style="background-image: url('{{ asset('Back') }}/assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Wishlist<span>Shop</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Item</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        @php

            $wishItem = Cart::instance('wishlist')->content();
        @endphp
        <div class="page-content">
            <div class="container">
                <table class="table table-wishlist table-mobile">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Stock Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse( $wishItem as $item)
                            <tr>
                                <td class="product-col">
                                    <div class="product">
                                        <figure class="product-media">
                                            <a href="{{ route('single_page',$item->options->slug) }}">
                                                <img src="{{ asset("Back/images/product/".$item->options->image) }}" alt="{{ $item->name }}">
                                            </a>
                                        </figure>

                                        <h3 class="product-title">
                                            <a href="{{ route('single_page',$item->options->slug) }}">{{ $item->name }}</a>
                                        </h3><!-- End .product-title -->
                                    </div><!-- End .product -->
                                </td>

                                <td class="price-col">৳{{ $item->price }}</td>

                                @if($item->qty >= 1)
                                    <td class="stock-col"><span class="in-stock">In stock</span></td>
                                    <td class="action-col">
                                        <button onclick="event.preventDefault(); document.getElementById('add-cart{{ $item->id }}').submit();"
                                         class="btn btn-block btn-outline-primary-2"><i class="icon-cart-plus"></i>Add to Cart</button>
                                    </td>
                                @else
                                    <td class="stock-col"><span class="out-of-stock"> Stock Out</span></td>
                                    <td class="action-col">
                                        <button class="btn btn-block btn-outline-primary-2 disabled">Out of Stock</button>
                                    </td>
                                @endif
                                <td class="remove-col"><a href="{{ route('wish_remove',$item->rowId) }}" class="btn-remove"><i class="icon-close"></i></button></td>

                                <form action="{{ route('cart_store') }}" id="add-cart{{ $item->id }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="quantity" @if(!empty($item->omq)) value="{{ $item->omq }}" @else value="1" min="1" @endif>
                                    <input type="hidden" name="product_id" value="{{ $item->id }}">

                                    @foreach(App\Models\Color::where('status',1)->get() as $color)
                                        @if(!empty($item->color_id) && in_array($color->id, json_decode($item->color_id, TRUE)))
                                            <input type="hidden" name="color_name" value="{{ $color->name }}">
                                        @endif
                                    @endforeach
                                </form>
                            </tr>
                            @empty
                            <tr>
                                <td><strong style="float: right; color: orange; font-size: 19px;">No wishlist item found</strong></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table><!-- End .table table-wishlist -->
                <div class="wishlist-share">
                    <div class="social-icons social-icons-sm mb-2">
                        <label class="social-label">Share on:</label>
                        <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                        <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                        <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                        <a href="#" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                        <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                    </div><!-- End .soial-icons -->
                </div><!-- End .wishlist-share -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->



    @include('FrontEnd.include.footer')
@endsection
