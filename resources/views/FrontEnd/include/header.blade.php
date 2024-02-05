@php
    $cartItems = \Cart::getContent();
@endphp
<style>
    .header-10 .category-dropdown .dropdown-toggle {
        background-color: #067af7;
    }
</style>

<header class="header header-10 header-intro-clearance">

    <div class="header-top">
        <div class="container">
            <div class="header-left">
                @if(!empty($info->contact_number))
                    <a href="tel:{{ $info->contact_number }}"><i class="icon-phone"></i> +88 {{ $info->contact_number }}</a>
                @endif
            </div><!-- End .header-left -->

            <div class="header-right">
                 {{-- <a href="#">Contact Us</a>
                 <a href="#" class="mr-1 ml-1">About Us</a> --}}

                <ul class="top-menu">
                    <li>
                        <a href="#">Links</a>
                        <ul>
                            {{-- <li>
                                <div class="header-dropdown">
                                    <a href="#">USD</a>
                                    <div class="header-menu">
                                        <ul>
                                            <li><a href="#">Eur</a></li>
                                            <li><a href="#">Usd</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li> --}}
                            {{-- <li>
                                <div class="header-dropdown">
                                    <a href="#">Engligh</a>
                                    <div class="header-menu">
                                        <ul>
                                            <li><a href="#">English</a></li>
                                            <li><a href="#">French</a></li>
                                            <li><a href="#">Spanish</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li> --}}

                            @auth
                            <style>
                                .header-top a:focus
                                {
                                    color: red !important;
                                }
                            </style>
                                <li>
                                    <div class="header-dropdown">
                                        <a href="#">{{ auth()->user()->name }}</a>
                                        <div class="header-menu">
                                            <ul>
                                                <li><a href="{{ route('customer_dashboard') }}" style="color: black;">Dashboard</a></li>
                                                <li>
                                                    <a href="{{ route('customer_logout') }}" style="color: black;" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">Logout</a>
                                                </li>
                                                {{-- logout form --}}
                                                <form id="logout-form" action="{{ route('customer_logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </ul>
                                        </div><!-- End .header-menu -->
                                    </div><!-- End .header-dropdown -->
                                </li>
                                @else
                                <li class="login">
                                    <a href="#signin-modal" data-toggle="modal">Sign in / Sign up</a>
                                </li>
                            @endauth

                        </ul>
                    </li>
                </ul><!-- End .top-menu -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-top -->

    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>
                @if(!empty( $info->logo))
                    <a href="{{ url('/') }}" class="logo">
                        {{-- <img src="{{ asset('Front') }}" alt="Site Logo" width="105" height="25"> --}}
                        <img src="{{ asset('Back/images/logo/'.$info->logo) }}" alt="Site Logo" height="25">
                    </a>
                @else
                    <a href="{{ url('/') }}" class="logo" style="margin-top: 0px !important;
                        margin-bottom: 0px !important;">
                        <span style="text-transform: uppercase;font-size: 29px;font-family: auto;color: #333333;">Artic Hunter</span>
                    </a>
                @endif
            </div><!-- End .header-left -->

            <div class="header-center">
                <div class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">
                    <a href="javascrip:void(0)" class="search-toggle" role="button"><i class="icon-search"></i></a>
                    <form action="{{ route('search_item') }}" method="get">
                        @csrf
                        <div class="header-search-wrapper search-wrapper-wide" >
                            {{-- <div class="select-custom">
                                <select id="cat" name="category_id">
                                    <option value="">ক্যাটাগরি বাছাই করুন</option>
                                   @foreach ($categoriesFind as $catLate)
                                    @if(count($catLate->subCategories))
                                        @foreach ($catLate->subCategories as $childLate)
                                            <option value="{{ $childLate->id }}">{{  $childLate->name }}</option>
                                        @endforeach
                                    @endif
                                   @endforeach
                                </select>
                            </div> --}}
                            <label for="q" class="sr-only">Search</label>
                            <input type="search" class="form-control" name="query" id="q" placeholder="Search Item..." required>
                            {{-- <input type="search" class="form-control" name="query" id="q" placeholder="Find product..." required> --}}
                            <button class="btn btn-primary" type="submit" ><i class="icon-search"></i></button>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div><!-- End .header-search -->
            </div>

            <div class="header-right">

                <div class="header-dropdown-link">

                    <div class="dropdown cart-dropdown">
                        <a href="javascrip:void(0)" class="dropdown-toggle" style="margin: 0 25px 0 0;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                            <i class="icon-shopping-cart"></i>
                            <span class="cart-count">{{ $cartItems->count() }}</span>
                            <!--<span class="cart-txt">Cart</span>-->
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-cart-products">
                                @php
                                    $cartTotal = 0;
                                @endphp
                                @foreach ($cartItems as $item)
                                    <?php
                                    $cartTotal += $item->quantity * $item->price;
                                    ?>
                                    <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="{{ route('single_view',$item->attributes->slug) }}">{{ $item->name }}</a>
                                            </h4>

                                            <span class="cart-product-info">
                                                <span class="cart-product-qty">{{ $item->quantity }}</span>
                                                x ৳{{ $item->price }}
                                            </span>
                                        </div><!-- End .product-cart-details -->

                                        <figure class="product-image-container">
                                            <a href="{{ route('single_view',$item->attributes->slug) }}" class="product-image">
                                                <img src="{{ asset("Back/images/product/".$item->attributes->image) }}" alt="product">
                                            </a>
                                        </figure>
                                        <a href="{{ route('cart_destroy',$item->id) }}" class="btn-remove" title="Remove Product">
                                            <i class="icon-close"></i>
                                        </a>
                                    </div><!-- End .product -->
                                @endforeach

                            </div><!-- End .cart-product -->

                            <div class="dropdown-cart-total">
                                <span>Total</span>

                                <span class="cart-total-price">@if(!empty($cartTotal)) ৳{{ number_format($cartTotal) }} @endif</span>
                            </div><!-- End .dropdown-cart-total -->

                            <div class="dropdown-cart-action">
                                @if(request()->url() == url('cart-show'))

                                    <a href="{{ route('checkout') }}" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                                @else
                                    <!--<a href="{{ route('cart_item') }}" class="btn btn-primary">View Cart</a>-->
                                    <a href="{{ route('cart_item') }}" class="btn btn-outline-primary-2"><span>View Cart</span><i class="icon-long-arrow-right"></i></a>
                                @endif

                            </div><!-- End .dropdown-cart-total -->
                        </div><!-- End .dropdown-menu -->
                    </div><!-- End .cart-dropdown -->

                    <!--<a href="#" class="wishlist-link">-->
                    <!--    @if(!empty( $info->app_logo))-->
                    <!--    <img src="{{ asset('Back/images/logo/appLogo/'.$info->app_logo) }}"  alt="app-logo">-->
                    <!--        @else-->
                            <!--<img src="//icms-image.slatic.net/images/ims-web/cb1bd0d2-6a3a-4189-a019-b147806fbe84.png"  alt="ভাউচার" data-spm-anchor-id="a2a0e.home.dewallet.i0.735212f7Mml953">-->
                    <!--    @endif-->
                    <!--</a>-->

                    {{-- <div class="account">
                        <a href="dashboard.html" title="My account">
                            <div class="icon">
                                <i class="icon-user"></i>
                                <i class="icon-signout"></i>
                            </div>
                            <p>Account</p>
                        </a>
                    </div> --}}


                </div>
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->


    <div class="header-bottom sticky-header" style="background-color:#007bff">
        <div class="container">


            @if(\Request()->url() == url('/'))
                <div class="header-left">

                    <div class="dropdown category-dropdown show is-on" data-visible="true">
                        <a href="javascrip:void(0)" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-display="static" title="Browse Categories" >
                            Categories
                        </a>

                        <div class="dropdown-menu show">
                            <nav class="side-nav">
                                <ul class="menu-vertical sf-arrows">

                                @forelse ($categories as $category)

                                    <li>
                                        @if(count($category->subCategories))
                                        {{-- @if(!empty($category->subCategories) && count($category->subCategories)) --}}
                                            <a href="#" class="sf-with-ul">{{$category->name}}</a>


                                            <ul>
                                                @foreach ($category->subCategories as $child)

                                                @if (count($child->subCategories))

                                                    <li>
                                                        <a href="{{ route('category_wise', $child->id) }}" class="sf-with-ul">{{ $child->name }}</a>

                                                        <ul>
                                                            @foreach($child->subCategories as $parent)
                                                                <li><a href="{{ route('category_wise', $parent->id) }}">{{ $parent->name }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    @else
                                                    <li><a href="{{ route('category_wise', $child->id) }}">{{ $child->name }}</a></li>

                                                @endif

                                                @endforeach


                                            </ul>

                                            @else
                                            <li><a href="{{ route('category_wise', $category->id) }}">{{$category->name}}</a></li>
                                        @endif


                                    </li>

                                    @empty

                                @endforelse

                                </ul><!-- End .menu-vertical -->
                            </nav><!-- End .side-nav -->
                        </div><!-- End .dropdown-menu -->
                    </div>
                </div>

            @else

                <div class="header-left">
                    <div class="dropdown category-dropdown">
                        <a href="javascrip:void(0)" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Browse Categories">
                            Categories
                        </a>

                        <div class="dropdown-menu">
                            <nav class="side-nav">
                                <ul class="menu-vertical sf-arrows">
                                {{-- <ul class="menu-vertical sf-arrows sf-js-enabled" style="touch-action: pan-y;"> --}}

                                    @forelse ($categories as $category)

                                    <li>
                                        @if(count($category->subCategories))
                                        {{-- @if(!empty($category->subCategories) && count($category->subCategories)) --}}
                                            <a href="#" class="sf-with-ul">{{$category->name}}</a>


                                            <ul>
                                                @foreach ($category->subCategories as $child)

                                                @if (count($child->subCategories))

                                                    <li>
                                                        <a href="{{ route('category_wise', $child->id) }}" class="sf-with-ul">{{ $child->name }}</a>

                                                        <ul>
                                                            @foreach($child->subCategories as $parent)
                                                                <li><a href="{{ route('category_wise', $parent->id) }}">{{ $parent->name }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    @else
                                                    <li><a href="{{ route('category_wise', $child->id) }}">{{ $child->name }}</a></li>

                                                @endif

                                                @endforeach


                                            </ul>

                                            @else
                                            <li><a href="{{ route('category_wise', $category->id) }}">{{$category->name}}</a></li>
                                        @endif


                                    </li>

                                    @empty

                                @endforelse

                                </ul><!-- End .menu-vertical -->
                            </nav><!-- End .side-nav -->
                        </div><!-- End .dropdown-menu -->
                    </div><!-- End .category-dropdown -->
                </div>

            @endif

                <!-- End .category-dropdown -->
            {{-- </div><!-- End .col-lg-3 --> --}}
            <div class="header-center">
                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        {{-- <li class="megamenu-container active">
                            <a href="{{ url('/') }}" >Home</a>
                        </li> --}}


                        <!--@foreach ($popularCategory as $popular)-->
                        <!--    @if(count($category->subCategories))-->
                        <!--        <li>-->
                        <!--            <a href="#" class="sf-with-ul">{{ $category->name }}</a>-->

                        <!--            <ul>-->
                        <!--                @foreach ($category->subCategories as $child)-->

                        <!--                    @if (count($child->subCategories))-->
                        <!--                        <li>-->
                        <!--                            <a href="{{ route('category_wise', $child->id) }}" class="sf-with-ul">{{ $child->name }}</a>-->

                        <!--                            <ul>-->
                        <!--                                @foreach($child->subCategories as $parent)-->
                        <!--                                    <li><a href="{{ route('category_wise', $parent->id) }}">{{ $parent->name }}</a></li>-->
                        <!--                                @endforeach-->
                        <!--                            </ul>-->
                        <!--                        </li>-->
                        <!--                        @else-->
                        <!--                            <li><a href="{{ route('category_wise', $child->id) }}">{{ $child->name }}</a></li>-->
                        <!--                    @endif-->
                        <!--                @endforeach-->
                        <!--            </ul>-->
                        <!--        </li>-->
                        <!--    @endif-->
                        <!--@endforeach-->

                          @foreach ($categoriesMenu as $key => $popular)
                            <li>
                                <a href="{{ route('category_wise',$popular->id ) }}" style="color: white" >
                                    {{ $popular->name }}
                                </a>
                            </li>
                            @if($key == 2)
                                @break
                            @endif
                        @endforeach

                    </ul><!-- End .menu -->
                </nav><!-- End .main-nav -->
            </div><!-- End .col-lg-9 -->

            <div class="header-right">
                <a href="{{ route('latest_product') }}" title="Click" style="color: white;font-size:15px">All New Products</a>
            </div>

        </div><!-- End .container -->
    </div><!-- End .header-bottom -->




</header><!-- End .header -->
