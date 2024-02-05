@extends('BackEnd.master')

@section('title')
Todays Order List
@endsection

@section('section')

    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                {{-- display error message --}}
                @if(Session::has('sms'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('sms') }}</strong>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                {{-- //display error message --}}
                <div class="widget-content widget-content-area br-6">
                    <div class="">
                        <h4 class="text-success text-center mt-3">
                            Todays Order List
                        </h4>
                    </div>
                    <table id="zero-config" class="table dt-table-hover" style="width:100%">

                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Customer Name</th>
                            <th>Contact Number</th>
                            <th>Order Total</th>
                            <th>Payment Type</th>
                            <th>Shippin Address</th>
                            <th>Status</th>
                            <th class="no-content">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($todayOrders as $key=> $order)
                            @php
                                $cancel = App\Models\OrderCancel::where('user_id', auth()->user()->id)->where('order_id', $order->id)->get();
                            @endphp
                            @if($cancel->count()< 1)

                                <tr>
                                    <td>{{ ++$key }}</td>

                                    <td>
                                        @if(!empty($order->customer->name))
                                        {{ $order->customer->name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    <td>
                                        @if (!empty($order->shipping->mobile))
                                                {{ $order->shipping->mobile }}
                                            @else
                                            {{ N/A }}
                                        @endif
                                    </td>

                                    <td>
                                        ৳.{{ number_format($order->grand_total) }}
                                    </td>

                                    <td>
                                        {{ $order->payment_type }}
                                    </td>

                                    <td>
                                        @if(!empty($order->shipping->address))
                                            {{$order->shipping->address}}
                                            @else
                                            N/A
                                        @endif
                                    </td>

                                    <td>
                                        @if ($order->status == 0)
                                        <a href="{{ route('order_status',$order->id) }}" class="btn btn-sm btn-primary">Pending</a>

                                        @elseif ($order->status == 1)
                                            <a href="{{ route('order_status',$order->id) }}" class="btn btn-sm btn-success">Packaging</a>
                                        @elseif ($order->status == 2)
                                            <a href="{{ route('order_status',$order->id) }}" class="btn btn-sm btn-success">Shipping</a>
                                        @else
                                        <a href="#" disabled class="btn btn-sm btn-success">Delivered</a>

                                        @endif
                                    </td>
                                    <td>

                                        @if($order->status == 3)

                                        @else
                                            <a title="Delete" class="btn" onclick="event.preventDefault();
                                                    if(confirm('Are you really want to delete?')){
                                                    document.getElementById('order-delete-{{ $order->id }}').submit()
                                                    }">
                                                <span class="fas fa-trash text-danger" ></span>
                                                <form method="post" action="{{ route('order_destroy',$order->id) }}" id="{{ 'order-delete-'.$order->id }}">
                                                    @csrf
                                                    @method('POST')
                                                </form>
                                            </a>
                                        @endif

                                        <a class="btn text-dark" target="_blank" href="{{ route('order_invoice',$order->id) }}" title="Print Order Invoice">
                                            <i class="fas fa-print"></i>
                                        </a>

                                        <a class="btn text-primary" href="{{ route('order_view',$order->id) }}" title="View Order">
                                            <i class="fas fa-search-plus"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Customer Name</th>
                            <th>Contact Number</th>
                            <th>Order Total</th>
                            <th>Payment Type</th>
                            <th>Shippin Address</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>

    </div>

@endsection

