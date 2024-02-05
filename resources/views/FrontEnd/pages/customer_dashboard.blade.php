@extends('FrontEnd.master')

@section('title', 'Dashboard')

@section('content')

<main class="main">
    <div class="page-header text-center" style="background-image: url('{{ asset('Front') }}/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">{{ auth()->user()->name }}'s Dashboard</h1>
        </div>
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ auth()->user()->name }}'s Dashboard</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    <aside class="col-md-4 col-lg-3">
                        <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab" href="#tab-dashboard" role="tab" aria-controls="tab-dashboard" aria-selected="true">Dashboard</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders" role="tab" aria-controls="tab-orders" aria-selected="false">Orders</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="tab-address-link" data-toggle="tab" href="#tab-address" role="tab" aria-controls="tab-address" aria-selected="false">Adresses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false">Account Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('customer_logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Sign Out
                            </a>
                             {{-- logout form --}}
                             <form id="logout-form" action="{{ route('customer_logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            </li>
                        </ul>
                    </aside>

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
                                <p>Hello <span class="font-weight-normal text-dark">{{ auth()->user()->name }}</span>
                                <br>
                                From your account dashboard you can view your
                                <a href="#tab-orders" class="tab-trigger-link link-underline">recent orders</a>
                                , manage your
                                <a href="#tab-address" class="tab-trigger-link">shipping addresses</a>
                                , and
                                <a href="#tab-account" class="tab-trigger-link">edit your password and account details</a>.</p>
                            </div>


                            <div class="tab-pane fade" id="tab-orders" role="tabpanel" aria-labelledby="tab-orders-link">
                                @if(!empty($orders) && $orders->count() > 0 )
                                    <div class="row">
                                        <div class="col-12 col-sm-12">
                                            <div class="table-responsive">

                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Item Image</th>
                                                        <th scope="col">Contact Number</th>
                                                        <th scope="col">Shipping Charge</th>
                                                        <th scope="col">Order Total</th>
                                                        <th scope="col">Payment Type</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($orders as $key=> $order)

                                                            @php
                                                                $cancel = App\Models\OrderCancel::where('user_id', auth()->user()->id)->where('order_id', $order->id)->get();
                                                            @endphp

                                                            @if($cancel->count()< 1)

                                                                @foreach (json_decode($order['products'], true) as $data)
                                                                    <tr>
                                                                        <td >{{ ++$key }}</td>
                                                                        <td>
                                                                            <a data-toggle="modal" data-target="#order{{ $data['id'] }}" title="click to view - {{ $data['name'] }}">
                                                                                <img style="height:45px;" src="{{asset('Back/images/product/'.$data['attributes']['image'])}}" alt="product-img">
                                                                            </a>
                                                                        </td>
                                                                        <td>
                                                                            @if (!empty($order->shipping->mobile))
                                                                            {{ $order->shipping->mobile }}
                                                                                @else
                                                                                {{ N/A }}
                                                                            @endif
                                                                        </td>
                                                                        <td> ৳ {{ $order->shipping_charge }}</td>
                                                                        <td> ৳ {{ number_format($order->grand_total) }}</td>
                                                                        <td> {{ $order->payment_type }}</td>

                                                                        @php
                                                                            $review = App\Models\Review::where('customer_id', auth()->user()->id)->where('product_id', $data['id'])->get();
                                                                        @endphp

                                                                        <td>
                                                                            @if ($order->status == 0)
                                                                                <a href="#" style="float: right" class="text-warning">Pending</a>

                                                                                @elseif ($order->status == 1)
                                                                                    <a style="float: right" href="#" class="text-primary">Packaging</a>
                                                                                @elseif ($order->status == 2)
                                                                                    <a style="float: right" href="#" class="text-info">Shipping</a>
                                                                                @else
                                                                                <a style="float: right" href="#" disabled class="text-success">Delivered</a>
                                                                            @endif
                                                                        </td>



                                                                        <td>
                                                                            @if ($order->status == 0)
                                                                                <a href="#" data-toggle="modal" data-target="#orderCancel{{ $order->id }}" class="btn ml-1 text-danger">Cancel Order</a>
                                                                            @elseif ($order->status == 3)

                                                                                @if($review->count() < 1)
                                                                                    <a href="" class="ml-5" data-toggle="modal" data-target="#review{{ $data['id'] }}"  title="Add a Review">
                                                                                        REVIEW
                                                                                    </a>
                                                                                    @else
                                                                                    <a href="#" class="ml-5" disabled style="color: #af1d96;">REVIEWED</a>
                                                                                @endif
                                                                            @endif
                                                                        </td>
                                                                    </tr>

                                                                    {{-- modal view image--}}
                                                                    <div class="modal fade" id="order{{ $data['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLongTitle">{{ $data['name'] }} - Photos</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <img style="width:90%; padding:10px;" src="{{asset('Back/images/product/'.$data['attributes']['image'])}}" alt="product photo">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    {{-- modal review--}}

                                                                        <div class="modal fade" id="review{{ $data['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLongTitle"> Give us a feed back about this order</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div class="card">
                                                                                            <div class="card-body">
                                                                                                <form method="post" action="{{ route('review_store') }}" enctype="multipart/form-data">
                                                                                                    @csrf
                                                                                                    <div class="form-group">
                                                                                                        <label for="title">Title(*)</label>
                                                                                                        <input type="text" name="title" class="form-control" placeholder="Such as good producs" required>
                                                                                                        <input type="hidden" name="customer_id" value="{{ auth()->user()->id }}">
                                                                                                        <input type="hidden" name="product_id" value="{{ $data['id'] }}">
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label>Description (optional)</label>
                                                                                                        <textarea name="description" class="form-control" cols="15" rows="5" ></textarea>
                                                                                                    </div>
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-lg-6 col-md-6 col-sm-12">
                                                                                                            <div class="form-group">
                                                                                                                <label>Item Image(optional)</label>
                                                                                                                <input type="file" accept="image/*" name="image" class="form-control-file">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-lg-6 col-md-6 col-sm-12">
                                                                                                            <div class="form-group">
                                                                                                                <label for="name">{{ __('Rate This Product') }}(*)</label>
                                                                                                                <select name="review" id="" class="form-control" required>
                                                                                                                    <option value="1">1</option>
                                                                                                                    <option value="2">2</option>
                                                                                                                    <option value="3">3</option>
                                                                                                                    <option value="4">4</option>
                                                                                                                    <option value="5" selected>5</option>
                                                                                                                </select>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <button type="submit" class="btn btn-info float-right">Submit</button>
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        {{-- order cancel modal --}}
                                                                        <div class="modal fade" id="orderCancel{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLongTitle" > Please tell us why you want to cancel this order?</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div class="card">
                                                                                            <div class="card-body">
                                                                                                <form method="post" action="{{ route('orderCancelStore') }}">
                                                                                                    @csrf

                                                                                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                                                                    <input type="hidden" name="order_id" value="{{ $order->id }}">

                                                                                                    <div class="form-group">
                                                                                                        <label style="color: black">Order Cancel Reason</label>
                                                                                                        <textarea name="cancel_reason" class="form-control" cols="15" rows="5" ></textarea>
                                                                                                    </div>

                                                                                                    <button type="submit" class="btn btn-info float-right">Send</button>
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                @endforeach
                                                            @endif
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    @else
                                        <p>No order has been made yet.</p>
                                        <a href="{{ url('/') }}" class="btn btn-outline-primary-2"><span>GO SHOP</span><i class="icon-long-arrow-right"></i></a>
                                @endif
                            </div>

                            <div class="tab-pane fade" id="tab-address" role="tabpanel" aria-labelledby="tab-address-link">
                                <p>The following addresses will be used on the checkout page by default.</p>

                                <div class="row">
                                    <div class="offset-1 col-lg-9 col-sm-10">
                                        <div class="card card-dashboard">
                                            <div class="card-body">
                                                <h3 class="card-title">Shipping Address</h3>

                                                <p>
                                                @if(isset($shippingAddress) && $shippingAddress != null)
                                                    {{ $shippingAddress->name }}
                                                    <br>

                                                {{ $shippingAddress->address }}<br>
                                                {{ $shippingAddress->mobile }}<br>
                                                @endif
                                                {{ auth()->user()->email }}<br>
                                                <a href="{{ route('shipping_edit',auth()->user()->id) }}">Edit <i class="icon-edit"></i></a></p>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="tab-pane fade" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">
                                <form action="{{ route('update_customerInfo', auth()->user()->id) }}" method="POST">
                                    @csrf

                                    <label>Display Name *</label>
                                    <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" required>
                                    <small class="form-text">This will be how your name will be displayed in the account section and in reviews</small>
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <input type="hidden" name="id" value="{{ auth()->user()->id }}">

                                    <label>Email address *</label>
                                    <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" required>
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <label>New password (leave blank to leave unchanged)</label>
                                    <input type="password" class="form-control" name="password">
                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <label>Confirm new password</label>
                                    <input type="password" class="form-control mb-2" name="password_confirmation">
                                    @error('password_confirmation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>SAVE CHANGES</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection
