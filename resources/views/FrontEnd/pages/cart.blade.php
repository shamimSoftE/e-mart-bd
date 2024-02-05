@extends('FrontEnd.master')

@section('title')
{{ request()->url() }}
@endsection

@section('content')



    <main class="main">
        <div class="page-header text-center" style="background-image: url('{{ asset('Front') }}/assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->


        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="cart">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">
                            <form method="post" action="{{ route('cart_update') }}">
                                @csrf
                                <table class="table table-cart table-mobile">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @php
                                        $cartTotal = 0;
                                    @endphp
                                     @forelse($cartItem as $item)
                                        <?php
                                        $cartTotal += $item->quantity * $item->price;
                                        ?>
                                        {{-- <form method="POST" action="{{ route('cart_update',$item->id) }}" id="update-cart{{ $item->id }}"> --}}
                                        <form method="POST" action="{{ route('cart_update') }}" >
                                            @csrf
                                            <tr>
                                                <td class="product-col">
                                                    <div class="product">
                                                        <figure class="product-media">
                                                            <a href="{{ route('single_view',$item->attributes->slug) }}">
                                                                <img src="{{ asset("Back/images/product/".$item->attributes->image) }}" alt="Product image">
                                                            </a>
                                                        </figure>

                                                        <h3 class="product-title">
                                                            <a href="{{ route('single_view',$item->attributes->slug) }}" title="{{ $item->name }}">{{ \Str::words($item->name, 3) }}</a>
                                                        </h3><!-- End .product-title -->
                                                    </div><!-- End .product -->
                                                </td>
                                                <td class="price-col">৳{{ number_format($item->price) }}</td>
                                                <td class="quantity-col">
                                                    <div class="cart-product-quantity">
                                                        {{ $item->quantity }}
                                                        <!--<input type="number" class="form-control" value="{{ $item->quantity }}" name="qty" min="1" max="100" step="1" data-decimals="0">-->
                                                        <input type="hidden" name="rowId" value="{{ $item->id }}"/>
                                                        {{-- <input type="hidden" name="price" value="{{ $item->price }}"/> --}}
                                                    </div><!-- End .cart-product-quantity -->
                                                </td>
                                                <td class="total-col">৳{{ number_format($item->price * $item->quantity) }}</td>
                                                <td class="remove-col">
                                                    <a href="{{ route('cart_destroy',$item->id) }}" class="btn-remove"><i class="icon-close"></i></a>
                                                    {{-- <button href="{{ route('cart_update',$item->id) }}" onclick="event.preventDefault(); document.getElementById('update-cart{{ $item->id }}').submit();" class="btn-remove" title="UPDATE"> --}}
                                                    <!--<button type="submit" class="btn-remove" title="UPDATE">-->
                                                    <!--    <i class="icon-refresh"></i>-->
                                                    <!--</button>-->
                                                </td>
                                            </tr>
                                        </form>
                                        @empty
                                        <tr>
                                            <td>No Cart Item Found</td>
                                        </tr>
                                    @endforelse

                                    </tbody>
                                </table><!-- End .table table-wishlist -->
                                {{-- <div class="cart-bottom">
                                    <button type="submit" class="btn btn-outline-dark-2"><span>UPDATE CART</span><i class="icon-refresh"></i></button>
                                </div> --}}
                                <!-- End .cart-bottom -->
                            </form>

                            <div class="cart-bottom">
                                <div class="cart-discount">
                                    {{-- <form action="#">
                                        <div class="input-group">
                                            <input type="text" class="form-control" required placeholder="coupon code">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
                                            </div><!-- .End .input-group-append -->
                                        </div><!-- End .input-group -->
                                    </form> --}}
                                    <a href="{{ route('home') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                                    <form method="POST" action="{{ route('checkout') }}">
                                        @csrf

                                        <input type="hidden" name="products" value="{{ $cartItem }}" />
                                    <table class="table">
                                        <thead class="summary-shipping">
                                            <td>Payment Method:</td>
                                            {{-- <td>&nbsp;</td> --}}
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>
                                                    <span>
                                                        Cash On Delivery
                                                        <input type="radio" name="payment_type" value="cash-on-delivery" required>
                                                        <strong>/</strong> bKash
                                                        <input type="radio" value="bKash" name="payment_type" required>
                                                        <strong>/</strong> Nagad
                                                        <input type="radio" name="payment_type" value="nagad" required>
                                                    </span>
                                                </td>
                                                <td>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div><!-- End .col-lg-9 -->
                        <aside class="col-lg-3">
                            <div class="summary summary-cart">
                                <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

                                <table class="table table-summary">
                                    <tbody>
                                    <tr class="summary-subtotal">
                                        <td>Subtotal:</td>
                                        <td>@if(!empty($cartTotal)) ৳{{ number_format($cartTotal) }} @endif</td>
                                    </tr><!-- End .summary-subtotal -->
                                    @auth

                                        <tr class="summary-shipping">
                                            <td>Shipping:</td>
                                            <td>Charge</td>
                                            {{-- <td>&nbsp;</td> --}}
                                        </tr>

                                        @foreach (App\Models\ShippingAddress::where('status', 1)->where('customer_id', auth()->user()->id)->get() as $address)

                                            <tr class="summary-shipping-row">
                                                <td>
                                                    <span >
                                                        <input type="radio" name="shipping_id" value="{{ $address->id }}" class="form-control-input"

                                                            @if(!empty($address->shippingCharge->charge))
                                                                shipping_charge = "{{ $address->shippingCharge->charge }}"
                                                            @else
                                                            shipping_charge = "00"
                                                            @endif

                                                            @if(!empty($cartTotal))
                                                                cartTotal = "{{ $cartTotal }}"
                                                                @else
                                                                cartTotal = "00"
                                                            @endif

                                                        required>

                                                        {{-- get subtatol --}}
                                                        @if(!empty($cartTotal))
                                                            <input type="hidden" value="{{ $cartTotal }}" name="subtotal">
                                                        @endif

                                                        {{-- get shipping charge --}}
                                                        @if(!empty($address->shippingCharge->charge))
                                                            <input type="hidden" value="{{ $address->shippingCharge->charge }}" name="shipping_charge">
                                                        @endif
                                                        <label  for="free-shipping">{{ $address->address }}</label>
                                                    </span><!-- End .custom-control -->
                                                </td>

                                                <td>
                                                    @if(!empty($address->shippingCharge->charge))
                                                        ৳{{ $address->shippingCharge->charge }}
                                                    @else
                                                        ৳00
                                                    @endif
                                                </td>
                                            </tr><!-- End .summary-shipping-row -->
                                        @endforeach
                                    @endauth

                                    <tr class="summary-shipping-estimate">
                                        <td>Estimate for Your City<br>
                                            @auth
                                                @if(App\Models\ShippingAddress::where('customer_id', auth()->user()->id)->count() >= 1)
                                                    <a href="{{ route('shipping_edit',auth()->user()->id) }}">Change address</a>
                                                    @else
                                                        <a href="{{ route('add_shippingAddress') }}">New address</a>
                                                @endif
                                                @else
                                                    <a href="#signin-modal" data-toggle="modal">
                                                        New address
                                                    </a>
                                            @endauth
                                        </td>
                                        <td>&nbsp;</td>
                                    </tr>


                                    <tr class="summary-total">
                                        <td>Total:</td>
                                        <td class="grand_total">
                                            ৳@if(!empty($cartTotal))
                                                {{ number_format($cartTotal) }}
                                                <input type="hidden" value="{{ $cartTotal }}" class="grand_total" name="grandTotal">
                                            @endif
                                        </td>
                                    </tr><!-- End .summary-total -->
                                    </tbody>
                                </table><!-- End .table table-summary -->
                                @auth

                                    @if($cartItem->count() >= 1 )
                                        <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</button>
                                        @else

                                    @endif
                                    {{-- <a href="checkout.html" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a> --}}
                                @else
                                    <a href="#signin-modal" data-toggle="modal" class="btn btn-outline-primary-2 btn-order btn-block">
                                        PROCEED TO CHECKOUT
                                    </a>
                                @endauth

                            </div><!-- End .summary -->
                        </form>

                        </aside><!-- End .col-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .cart -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->


    <script>

        $(document).ready(function(){

            $("input[name=shipping_id]").bind('change',function(){

                var shipping_charge = $(this).attr("shipping_charge");

                var sub_total = $(this).attr("cartTotal");

                // $(".ship_charge").html("Tk."+shipping_charge);
                var grand_total = parseInt(sub_total) + parseInt(shipping_charge);

                $(".grand_total").html("৳"+grand_total);
            });
        })
    </script>



@endsection
