@extends('BackEnd.master')

@section('title')
    Canceled Order List
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
                             Canceled Order List
                        </h4>
                    </div>
                    <table id="zero-config" class="table dt-table-hover" style="width:100%">

                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Customer Name</th>
                            <th>Contact Number</th>
                            <th class="no-content">Order Cancel Reason</th>
                            {{-- <th class="no-content">Actions</th> --}}
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($canceled as $key=> $order)



                            <tr>
                                <td>{{ ++$key }}</td>

                                <td>
                                    @if(!empty($order->order->shipping->name))
                                    {{ $order->order->shipping->name }}
                                    @else
                                        N/A
                                    @endif
                                </td>

                                <td>
                                    @if(!empty($order->order->shipping->mobile))
                                    {{ $order->order->shipping->mobile }}
                                    @else
                                        N/A
                                    @endif
                                </td>

                                <td>
                                    @if(!empty($order->cancel_reason))
                                    {{ $order->cancel_reason }}
                                    @else
                                        N/A
                                    @endif
                                </td>

                                {{-- <td>
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
                                </td> --}}

                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Customer Name</th>
                            <th>Contact Number</th>
                            <th>Order Cancel Reason</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>

    </div>

@endsection

