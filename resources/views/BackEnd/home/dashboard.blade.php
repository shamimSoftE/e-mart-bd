@extends('BackEnd.master')

@section('title')
    Dashboard
@endsection

@section('section')
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            {{-- display error message --}}
            @if(Session::has('sms'))
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('sms') }}</strong>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
            {{-- //display error message --}}
            @php
                    use Carbon\Carbon;
                    use \App\Models\Order;
                    use Illuminate\Support\Facades\DB;
                        // $lol = \App\Models\Order::whereDate('created_at', '=', Carbon::today()->toDateString())->select('grand_total')->count();
                        // $lol = DB::table('orders')->whereDate('created_at', '=', Carbon::today()->toDateString())->sum('grand_total');  //QUERY BUILDER STYLE
                        $todaysComOrder = Order::where('status', 3)->whereDate('created_at', '=', Carbon::today()->toDateString())->sum('grand_total');
                        // $weekly_ComOrder = $get_visitor->where('created_at', '>=', \Carbon\Carbon::today()->subDays(7))->count();
                        $monthly_ComOrder = Order::where('status', 3)->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('grand_total');

                        $allComOrder = Order::where('status', 3)->sum('grand_total');
                    @endphp



            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-two" >
                    <div class="widget-heading ">
                        <h5 class="text-dark">
                            Todays Sell
                            <sup>৳ {{ number_format($todaysComOrder)  }}</sup>
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-two" >
                    <div class="widget-heading ">
                        <h5 class="text-dark">
                            Monthly Sell
                            <sup >৳ {{ number_format($monthly_ComOrder)  }}</sup>
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-two">
                    <div class="widget-heading ">
                        <h5 class="text-dark">
                            Total Sell
                            <sup >৳ {{ number_format($allComOrder)  }}</sup>
                        </h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row layout-top-spacing">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-two" style="
                background: linear-gradient(51deg, #e91e63, #9c27b075);
            ">

                    @php
                        $pro = \App\Models\Product::all();
                    @endphp

                    <div class="widget-heading ">
                        <h5 class="text-light">
                            Total Product
                            <sup style="font-size: 20px;color: #9100ff">{{ $pro->count()  }}</sup>
                        </h5>
                        <a href="{{ route('product.index') }}" class="btn btn-success ml-1" title="Show List">View</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-two" style="
                background: linear-gradient(45deg, magenta, #73dbecf5);
            ">

                    <div class="widget-heading ">
                        <h5 class="text-light">
                           Today's Order
                            <sup style="font-size: 20px;color: #9100ff">{{ $todayOrders->count() }}</sup>
                        </h5>
                        <a href="{{ route('order_today') }}" class="btn btn-warning" title="Show List">View</a>
                    </div>
                </div>
            </div>

            {{-- <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-two" style="
                background: linear-gradient(76deg, yellow, #b4080875);
            ">
                    @php
                        $order = \App\Models\Order::where('status',0)->get();
                    @endphp
                    <div class="widget-heading ">
                        <h5 class="text-danger">
                           Pending Order
                            <sup style="font-size: 20px;color: #9100ff">{{ $order->count() }}</sup>
                        </h5>
                        <a href="{{ route('order_list') }}" class="btn btn-danger" title="Show List">View</a>
                    </div>
                </div>
            </div> --}}

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-two" style="
                background: linear-gradient(76deg, #000000, #ad1616b8);
            ">

                    @php
                        $OrderCencel = \App\Models\OrderCancel::latest()->get();
                    @endphp

                    <div class="widget-heading">
                        <h5 style="color: rgb(255 255 255 / 82%);">
                            Canceled Order
                            <sup style="font-size: 20px;color: #ffffff">{{ $OrderCencel->count() }}</sup>
                        </h5>
                        <a href="{{ route('order_cancel') }}" class="btn btn-sm btn-info ml-1" title="Show List">View</a>
                    </div>
                </div>
            </div>




            {{-- <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-two">
                    @php
                        $cates = \App\Models\Category::where('status',1)->get();
                    @endphp
                    <div class="widget-heading ">
                        <h5 class="text-success">
                         Sub-Category
                            <sup style="font-size: 20px;color: #02009a">{{ $cates->count()  }}</sup>
                        </h5>
                        <a href="{{ route('category.index') }}" class="btn btn-sm btn-dark mt-2" title="Show List">View</a>
                    </div>
                </div>
            </div> --}}

            <div id="tableHover" class="col-lg-12 col-12 layout-spacing">

            </div>

            {{--<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">

                <div class="widget widget-table-two">
                    @php
                        $seller = \App\Models\Seller::all();
                    @endphp
                    <div class="widget-heading">
                        <h5 class="" style="color: #422b02">Total Seller<sup style="font-size: 20px;color: #085a01">{{ $seller->count()  }}</sup></h5>
                        <h5 class="text-center">Registered Seller</h5>
                    </div>

                    <div class="widget-section">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>
                                        <div class="th-section">Name</div>
                                    </th>
                                    <th>
                                        <div class="th-section">Phone Number</div>
                                    </th>
                                    <th>
                                        <div class="th-section">E-mail</div>
                                    </th>
                                    <th>
                                        <div class="th-section">Register Date</div>
                                    </th>
                                </tr>
                                </thead>
                                @php
                                    $sellers = \App\Models\Seller::where('status',1)->latest()->take(5)->get();
                                @endphp
                                <tbody>
                                @forelse($sellers as $seller)
                                    <tr>
                                        <td>
                                            <div class="td-section">{{ $seller->first_name }}</div>
                                        </td>

                                        <td>
                                            <div class="td-section"><span class="">{{ $seller->phone_number }}</span></div>
                                        </td>

                                        <td>
                                            <div class="td-section"><span class="">{{ $seller->email }}</span></div>
                                        </td>

                                        <td>
                                            <div class="td-section">
                                                <span class="badge badge-success">{{ $seller->created_at->diffForHumans()  }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>
                                            <span class="text-center">No Data Found</span>
                                        </td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-two">
                    @php
                        $customer = \App\Models\Customer::all();
                    @endphp
                    <div class="widget-heading">
                        <h5 style="color: #c69a31"> Customer <sup style="font-size: 20px;color: #294729">{{ $customer->count()  }}</sup></h5>
                        <h5 class="text-center">Customer List</h5>
                    </div>
                    <div class="widget-section">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th><div class="th-section">Customer Name</div></th>
                                    <th><div class="th-section">Create Date</div></th>
                                    <th>
                                        <div class="th-section">Status</div>
                                    </th>
                                </tr>
                                </thead>
                                @php
                                    $customers = \App\Models\Customer::latest()->take(5)->get();
                                @endphp
                                <tbody>
                                @forelse($customers as $cus)
                                    <tr>
                                        <td>
                                            <div class="td-section">{{ $cus->name }}</div>
                                        </td>
                                        <td>
                                            <div class="td-section">{{ $cus->created_at->diffForHumans() }}</div>
                                        </td>

                                        <td><div class="td-section"><span class="">{{$cus->status}}</span></div></td>
                                        <td>
                                            <div class="td-section">
                                                @if($cus->status == 1)
                                                    <span class="badge badge-primary">
                                                    Active
                                                </span>
                                                @else
                                                    <span class="badge badge-danger">
                                                    Inactive
                                                </span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty

                                @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>--}}

        </div>

    </div>
@endsection
