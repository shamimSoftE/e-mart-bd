@extends('BackEnd.master')

@section('title')
    Order Details View
@endsection

@section('section')

    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

                <div class="widget-content widget-content-area table-responsive">
                    {{-- <div class=""> --}}
                        <h4 class="text-center text-primary " style="margin: 10px 0 10px 0;">
                            Customer Information
                        </h4>
                    {{-- </div> --}}
                    <table class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Mobile Number</th>
                                <th>E-mail</th>
                                {{-- <th>Status</th> --}}
                                {{-- <th class="no-section">Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody>

                            <tr>

                                <td>
                                    @if(!empty($order->customer->name))
                                        {{ $order->customer->name }}
                                    @else
                                        N/A
                                    @endif
                                </td>

                                <td>
                                    @if (!empty($order->customer->phone_number ))
                                        {{ $order->customer->phone_number  }}
                                        @else
                                        N/A
                                    @endif
                                </td>

                                <td>
                                    @if (!empty($order->customer->email  ))
                                    {{ $order->customer->email   }}
                                    @else
                                    N/A
                                @endif
                                </td>

                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            {{-- shiping tabel --}}
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

                <div class="widget-content widget-content-area table-responsive">
                    {{-- <div class=""> --}}
                        <h4 class="text-center text-success " style="margin: 10px 0 10px 0;">
                            Shipping Information
                        </h4>
                    {{-- </div> --}}
                    <table class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Contact Number</th>
                                <th>Address</th>
                                {{-- <th>City</th> --}}
                                <th>Shipping Charge</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>

                                <td>
                                    @if (!empty($order->shipping->name ))
                                        {{ $order->shipping->name  }}
                                    @else
                                        N/A
                                    @endif

                                </td>
                                <td>
                                @if (!empty($order->shipping->mobile ))
                                        {{ $order->shipping->mobile  }}
                                        @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if(!empty( $order->shipping->address))
                                        {{ $order->shipping->address }}
                                    @else
                                        {{ __('N/A') }}
                                    @endif

                                </td>
                                {{-- <td>
                                    @if(!empty( $order->shipping->charge->city))
                                        {{ $order->shipping->charge->city }}

                                        @else
                                        {{ __('N/A') }}
                                    @endif
                                </td> --}}
                                <td>
                                    @if(!empty( $order->shipping_charge))
                                        ৳.{{ $order->shipping_charge }}

                                    @else
                                        ৳.{{ __('00') }}
                                    @endif</td>

                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>

            {{-- order details table --}}
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

                <div class="widget-content widget-content-area table-responsive">
                    {{-- <div class=""> --}}
                        <h4 class="text-center text-info" style="margin: 10px 0 10px 0;">
                            Order Details Information
                        </h4>
                    {{-- </div> --}}
                    <table class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Product Image</th>
                                <th>Quantity</th>
                                <th>Color</th>
                                {{-- <th>Size</th> --}}
                            </tr>
                        </thead>
                        <tbody>

                            @foreach (json_decode($order['products'], true) as $data)

                                <tr>

                                    <td>{{ $data["name"] }}</td>

                                    <td>৳.{{ number_format($data["price"]) }}</td>

                                    <td>
                                        <a data-toggle="modal" data-target="#sectionEdit{{ $data['id'] }}" title="Click to view">
                                            <img style="height:30px;" src="{{asset('Back/images/product/'.$data['attributes']['image'])}}" alt="product-img">
                                        </a>
                                    </td>

                                    <td>{{ $data['quantity'] }}</td>

                                    <td>
                                        @if (!empty($data['attributes']['color_name'] ))
                                            {{ $data['attributes']['color_name']  }}
                                            @else
                                            N/A
                                        @endif
                                    </td>

                                    {{-- <td>
                                        @if (!empty($data->product_size ))
                                            {{ $data->product_size  }}
                                            @else
                                            N/A
                                        @endif
                                    </td> --}}

                                    {{-- modal --}}

                                <div class="modal fade" id="sectionEdit{{ $data['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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

                                {{--// modal --}}

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>


            </div>

        </div>

    </div>

@endsection

