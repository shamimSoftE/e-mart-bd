@extends('FrontEnd.master')

@section('title')
    @if(!empty($section->title))
        {!! $section->title !!}
        @elseif (!empty($category))
        {!! $category->name !!}
        @elseif (!empty($brand))
        {!! $brand->name !!}
    @elseif(!empty($range))
        Price {!! number_format($range['min']) !!} -> {!! number_format($range['max']) !!}
    @endif
@endsection

@section('content')
<div class="page-wrapper">



    <main class="main">
        <div class="page-header text-center" style="background-image: url('{{ asset('Front') }}/assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title" style="
                color: #3399ff;
                font-family: monospace;
            ">
                    @if(!empty($section->title))
                        {{ $section->title }}

                        @elseif (!empty($category))
                        {!! $category->name !!}

                        @elseif (!empty($brand))
                        {!! $brand->name !!}

                        @elseif(!empty($range))
                        Price {!! number_format($range['min']) !!} => {!! number_format($range['max']) !!}
                    @endif
                    {{-- <span>Shop</span></h1> --}}
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                       @if(!empty($section->title))
                            {{ $section->title }}
                            @elseif (!empty($category))
                                {!! $category->name !!}
                        @elseif(!empty($range))
                            Price {!! number_format($range['min']) !!} => {!! number_format($range['max']) !!}
                        @endif
                    </li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="toolbox">
                            <div class="toolbox-left">
                                <div class="toolbox-info" style="color: #3399ffd1 !important">
                                    @if(isset($section_id))
                                    @else

                                    Showing <span>{{ $products->count() }}</span> Products
                                    @endif
                                </div><!-- End .toolbox-info -->
                            </div><!-- End .toolbox-left -->

                            <div class="toolbox-right">
                                {{-- <div class="toolbox-sort">
                                    <label for="sortby">Sort by:</label>
                                    <div class="select-custom">
                                        <select name="sortby" id="sortby" class="form-control">
                                            <option value="">All</option>
                                            <a href="">
                                                <option value="popularity" >Most Popular</option>
                                            </a>
                                            <option value="rating">Most Rated</option>

                                        </select>
                                    </div>
                                </div> --}}
                                <div class="toolbox-layout">

                                    {{-- <a href="category-list.html" class="btn-layout">
                                        <svg width="16" height="10">
                                            <rect x="0" y="0" width="4" height="4" />
                                            <rect x="6" y="0" width="10" height="4" />
                                            <rect x="0" y="6" width="4" height="4" />
                                            <rect x="6" y="6" width="10" height="4" />
                                        </svg>
                                    </a> --}}

                                    {{-- <a href="category-2cols.html" class="btn-layout">
                                        <svg width="10" height="10">
                                            <rect x="0" y="0" width="4" height="4" />
                                            <rect x="6" y="0" width="4" height="4" />
                                            <rect x="0" y="6" width="4" height="4" />
                                            <rect x="6" y="6" width="4" height="4" />
                                        </svg>
                                    </a>

                                    <a href="category.html" class="btn-layout">
                                        <svg width="16" height="10">
                                            <rect x="0" y="0" width="4" height="4" />
                                            <rect x="6" y="0" width="4" height="4" />
                                            <rect x="12" y="0" width="4" height="4" />
                                            <rect x="0" y="6" width="4" height="4" />
                                            <rect x="6" y="6" width="4" height="4" />
                                            <rect x="12" y="6" width="4" height="4" />
                                        </svg>
                                    </a> --}}

                                    <a href="" class="btn-layout active">
                                        <svg width="22" height="10">
                                            <rect x="0" y="0" width="4" height="4" />
                                            <rect x="6" y="0" width="4" height="4" />
                                            <rect x="12" y="0" width="4" height="4" />
                                            <rect x="18" y="0" width="4" height="4" />
                                            <rect x="0" y="6" width="4" height="4" />
                                            <rect x="6" y="6" width="4" height="4" />
                                            <rect x="12" y="6" width="4" height="4" />
                                            <rect x="18" y="6" width="4" height="4" />
                                        </svg>
                                    </a>
                                </div><!-- End .toolbox-layout -->
                            </div><!-- End .toolbox-right -->
                        </div><!-- End .toolbox -->

                        <div class="products mb-3">
                            <div class="row justify-content-center">

                                @forelse ($products as $item)
                                    @php
                                        $photos = json_decode($item['image'])
                                    @endphp

                                    @if(isset($section_id))
                                        @if(in_array($section_id, json_decode($item->section_id, TRUE)))
                                            <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                                <div class="product product-7 text-center">
                                                    <figure class="product-media">
                                                        @if($item->quantity >= 1)
                                                            <span class="product-label label-out" style="color: #39f;background: #f5f5f5;">
                                                                In Stock
                                                            </span>
                                                        @else
                                                            <span class="product-label label-out" style="color: #c52121;">Stock Out</span>
                                                        @endif
                                                        <a href="{{ route('single_view',$item->slug) }}">
                                                            <img src="{{ asset('Back/images/product/'.$photos[0]) }}" alt="Product image" class="product-image">
                                                        </a>

                                                        {{-- <div class="product-action-vertical">
                                                            @if($witem->contains($item->id))
                                                                <a href="#" class="btn-product-icon btn-wishlist btn-expandable" style="color: red;">
                                                                    <span>Wishlisted</span>
                                                                </a>
                                                            @else
                                                                <a href="" onclick="event.preventDefault(); document.getElementById('add-wishlist{{ $item->id }}').submit();"
                                                                    class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span>
                                                                </a>
                                                            @endif
                                                            </div> --}}
                                                            <!-- End .product-action-vertical -->

                                                        {{-- <div class="product-action">
                                                            <a href="{{ route('single_view') }}" class="btn-product btn-cart">
                                                                <span>add to cart</span>
                                                            </a>
                                                        </div> --}}

                                                    </figure><!-- End .product-media -->



                                                    {{-- <form action="" id="add-wishlist{{ $item->id }}" method="POST" style="display:none">
                                                        @csrf
                                                        <input type="hidden" name="quantity" @if(!empty($item->omq)) value="{{ $item->omq }}" @else value="1" min="1" @endif>
                                                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                    </form> --}}

                                                    <div class="product-body">
                                                        <div class="product-cat">
                                                            @if(!empty($item->category->name))
                                                                <a href="{{ route('category_wise',$item->category->id) }}">
                                                                    {{ $item->category->name }}
                                                                </a>
                                                            @endif
                                                        </div><!-- End .product-cat -->
                                                        <h3 class="product-title">
                                                            <a href="{{ route('single_view',$item->slug) }}">
                                                                {{ $item->name }}
                                                            </a>
                                                        </h3><!-- End .product-title -->
                                                        <div class="product-price">
                                                        <span> ৳ {{ number_format($item->special_price) }} </span>
                                                            <br>
                                                            <del class="ml-1" style="color: black">
                                                                ৳ {{  number_format($item->regular_price) }}
                                                            </del>

                                                        </div><!-- End .product-price -->
                                                        {{-- <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-val" style="width: 20%;"></div>
                                                            </div>
                                                            <span class="ratings-text">( 2 Reviews )</span>
                                                        </div> --}}
                                                        <!-- End .rating-container -->
                                                    </div><!-- End .product-body -->
                                                </div><!-- End .product -->
                                            </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
                                        @endif

                                        @else
                                        <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                            <div class="product product-7 text-center">
                                                <figure class="product-media">
                                                    @if($item->quantity >= 1)
                                                        <span class="product-label label-out" style="color: #39f;background: #f5f5f5;">
                                                            In Stock
                                                        </span>
                                                    @else
                                                        <span class="product-label label-out" style="color: #c52121;">Stock Out</span>
                                                    @endif
                                                    <a href="{{ route('single_view',$item->slug) }}">
                                                        <img src="{{ asset('Back/images/product/'.$photos[0]) }}" alt="Product image" class="product-image">
                                                    </a>

                                                </figure><!-- End .product-media -->

                                                <div class="product-body">
                                                    <div class="product-cat">
                                                        @if(!empty($item->category->name))
                                                            <a href="{{ route('category_wise',$item->category->id) }}">
                                                                {{ $item->category->name }}
                                                            </a>
                                                        @endif
                                                    </div><!-- End .product-cat -->
                                                    <h3 class="product-title">
                                                        <a href="{{ route('single_view',$item->slug) }}">
                                                            {{ $item->name }}
                                                        </a>
                                                    </h3><!-- End .product-title -->
                                                    <div class="product-price">
                                                       <span> ৳ {{ number_format($item->special_price) }} </span>
                                                        <br>
                                                        <del class="ml-1" style="color: black">
                                                            ৳ {{  number_format($item->regular_price) }}
                                                        </del>

                                                    </div><!-- End .product-price -->
                                                    {{-- <div class="ratings-container">
                                                        <div class="ratings">
                                                            <div class="ratings-val" style="width: 20%;"></div>
                                                        </div>
                                                        <span class="ratings-text">( 2 Reviews )</span>
                                                    </div> --}}
                                                    <!-- End .rating-container -->
                                                </div><!-- End .product-body -->
                                            </div><!-- End .product -->
                                        </div>

                                    @endif

                                @empty
                                <div class="col-6 col-md-4 col-lg-3 col-sm-6">
                                    <div class="product product-7 text-center">
                                        <h5>No Product Found</h5>
                                    </div>
                                </div>
                                @endforelse



                            </div><!-- End .row -->
                        </div><!-- End .products -->

                        {{-- pagination --}}

                        {{-- <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                        <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                                    </a>
                                </li>
                                <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item-total">of 6</li>
                                <li class="page-item">
                                    <a class="page-link page-link-next" href="#" aria-label="Next">
                                        Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                    </a>
                                </li>
                            </ul>
                        </nav> --}}

                    </div><!-- End .col-lg-9 -->
                    <aside class="col-lg-3 order-lg-first">
                        <div class="sidebar sidebar-shop">
                            <div class="widget widget-clean">
                                <label>Filters:</label>
                                <a href="" class="sidebar-filter-clear"> <input type="reset" value="Clear All" style="border: 1px solid #3399ff;color: black;background: white;" /></a>
                            </div><!-- End .widget widget-clean -->

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                        Category
                                    </a>
                                </h3><!-- End .widget-title -->

                                <div class="collapse show" id="widget-1">
                                    <div class="widget-body">
                                        <div class="filter-items filter-items-count">
                                            @foreach (App\Models\Category::where('status',1)->where('parent_id', null)->get() as $cate)
                                                @if(count($cate->subCategories))
                                                    @foreach ($cate->subCategories as $subCate)

                                                        @php
                                                            $pro = App\Models\Product::where('status',1)->where('category_id', $subCate->id)->get();
                                                        @endphp
                                                        @if($pro->count() >= 1 )
                                                            <div class="filter-item">
                                                                <div class="custom-control">

                                                                    @if(!empty($category->id) && $category->id == $subCate->id)
                                                                        <a href="{{ route('category_wise', $subCate->id) }}">
                                                                            <input type="checkbox" class="custom-control-input" id="cat-1">
                                                                            {{-- <label class="custom-control-label" for="cat-1">{{ $subCate->name }}</label> --}}
                                                                            {{ $subCate->name }}
                                                                        </a>
                                                                        @else
                                                                        <a href="{{ route('category_wise', $subCate->id) }}" style="color:black">
                                                                            <input type="checkbox" class="custom-control-input" id="cat-1">
                                                                            {{-- <label class="custom-control-label" for="cat-1">{{ $subCate->name }}</label> --}}
                                                                            {{ $subCate->name }}
                                                                        </a>
                                                                    @endif

                                                                </div><!-- End .custom-checkbox -->

                                                                <span class="item-count">{{ $pro->count() }}</span>
                                                            </div><!-- End .filter-item -->
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach


                                        </div><!-- End .filter-items -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5">
                                        Price Range:
                                    </a>
                                </h3><!-- End .widget-title -->

                                <div class="collapse show" id="widget-5">
                                    <div class="widget-body">
                                        <div class="filter-price">
                                            <div class="filter-price-text">
                                                {{-- Price Range: --}}
                                                {{-- <span id="filter-price-range"></span> --}}
                                                <form method="get" action="{{ route('price_range') }}">
                                                    @csrf
                                                    {{-- <input type="hidden" name="section_id"  value="{{ $section->id }}"> --}}
                                                    <div class="price-range-holder">
                                                        <div class="min-max">
                                                            <div class="row">
                                                                <div class="col-md-6 col-sm-6 col-lg-6">
                                                                    <input type="number" style="
                                                                        max-width: 70px;
                                                                        font-size: 11px;
                                                                        float: left;
                                                                        display: block;
                                                                        width: 70px;
                                                                        height: 30px;
                                                                        padding: 0 7px;
                                                                        text-align: left;
                                                                        color: #404040;
                                                                        border: 1px solid #a8a8a8;
                                                                        border-radius: 3px;
                                                                        outline: 0;
                                                                        background-color: #fff;
                                                                        -webkit-box-shadow: 0 1px 1px 0 #ececec;
                                                                        box-shadow: 0 1px 1px 0 #ececec;
                                                                        -webkit-transition: all .3s linear;
                                                                        -o-transition: all .3s linear;
                                                                        transition: all .3s linear;
                                                                        min-width: auto;" min="0" name="min" placeholder="Min"
                                                                        @if(!empty($range)) value="{{ $range['min'] }}" @endif
                                                                        pattern="[0-9]*" required="">
                                                                </div>
                                                                <div class="col-md-6 col-sm-6 col-lg-6">
                                                                    <input type="number" min="0" style="
                                                                        max-width: 70px;
                                                                        font-size: 11px;
                                                                        float: left;
                                                                        display: block;
                                                                        width: 70px;
                                                                        height: 30px;
                                                                        padding: 0 7px;
                                                                        text-align: left;
                                                                        color: #404040;
                                                                        border: 1px solid #a8a8a8;
                                                                        border-radius: 3px;
                                                                        outline: 0;
                                                                        background-color: #fff;
                                                                        -webkit-box-shadow: 0 1px 1px 0 #ececec;
                                                                        box-shadow: 0 1px 1px 0 #ececec;
                                                                        -webkit-transition: all .3s linear;
                                                                        -o-transition: all .3s linear;
                                                                        transition: all .3s linear;
                                                                        min-width: auto;" name="max" placeholder="Max"
                                                                       @if(!empty($range)) value="{{ $range['max'] }}" @endif
                                                                        pattern="[0-9]*" required="">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12 col-sm-12 col-lg-12 mt-1" style="margin-bottom: -55px;">
                                                                    <button type="submit" style="
                                                                        height: 40px;
                                                                        width: 100%;
                                                                        color: #3399ff;
                                                                        background: #fff;
                                                                        font-size: 15px;
                                                                        border-radius: 5px;
                                                                        border: 1px solid;">Show</button>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </form>
                                            </div><!-- End .filter-price-text -->

                                            <div id="price-slider"></div><!-- End #price-slider -->
                                        </div><!-- End .filter-price -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div>

                            {{-- color range --}}

                            {{-- <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true" aria-controls="widget-3">
                                        Colour
                                    </a>
                                </h3>

                                <div class="collapse show" id="widget-3">
                                    <div class="widget-body">
                                        <div class="filter-colors">
                                            <a href="#" style="background: #b87145;"><span class="sr-only">Color Name</span></a>
                                            <a href="#" style="background: #f0c04a;"><span class="sr-only">Color Name</span></a>
                                            <a href="#" style="background: #333333;"><span class="sr-only">Color Name</span></a>
                                            <a href="#" class="selected" style="background: #cc3333;"><span class="sr-only">Color Name</span></a>
                                            <a href="#" style="background: #3399cc;"><span class="sr-only">Color Name</span></a>
                                            <a href="#" style="background: #669933;"><span class="sr-only">Color Name</span></a>
                                            <a href="#" style="background: #f2719c;"><span class="sr-only">Color Name</span></a>
                                            <a href="#" style="background: #ebebeb;"><span class="sr-only">Color Name</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- End color range --}}

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
                                        Brand
                                    </a>
                                </h3><!-- End .widget-title -->

                                <div class="collapse show" id="widget-4">
                                    <div class="widget-body">
                                        <div class="filter-items">
                                            @foreach (App\Models\Brand::where('status',1)->get() as $bra)
                                                <div class="filter-item">
                                                    <div class="custom-control custom-checkbox">
                                                        @if(!empty($brand->id) && $brand->id == $bra->id)
                                                            <a href="{{ route('brand_wise', $bra->id) }}">
                                                                <input type="checkbox" class="custom-control-input" id="brand-1">
                                                                {{-- <label class="custom-control-label" for="brand-1">Next</label> --}}
                                                                {{ $bra->name }}
                                                            </a>
                                                            @else
                                                            <a href="{{ route('brand_wise', $bra->id) }}" style="color: black">
                                                                <input type="checkbox" class="custom-control-input" id="brand-1">
                                                                {{-- <label class="custom-control-label" for="brand-1">Next</label> --}}
                                                                {{ $bra->name }}
                                                            </a>
                                                        @endif
                                                    </div><!-- End .custom-checkbox -->
                                                </div><!-- End .filter-item -->
                                            @endforeach

                                        </div><!-- End .filter-items -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->


                        </div><!-- End .sidebar sidebar-shop -->
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .page-section -->
    </main><!-- End .main -->

</div><!-- End .page-wrapper -->

@endsection

{{-- @section('section')


@endsection --}}
