@extends('FrontEnd.master')

@section('title', 'bKash Manually Payment')

@section('content')

    <div class="row">
        <div class="col-lg-12 col-md-12  col-sm-12 ">
            <div class="card mt-5">
                <div class="card-header">
                    @php
                        $info = App\Models\SiteInfo::where('status',1)->first();
                    @endphp
                    <h4 style="color: #90000d;">Please sent money in this number. Then complete this form. </h4>
                    <div class="form-inline">
                        @if(!empty($info->marcent_number))
                            <strong> Merchant Number: </strong> <span>{{ $info->marcent_number}}</span>
                        @else
                            <strong>Merchant Number: </strong> <span>01631*****1</span>
                        @endif
                        <br>
                        <strong>You must pay:</strong> <span>TK.{{ $data['grandTotal'] }}</span>
                    </div>

                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('bkash_payment') }}">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 ">
                                <div class="form-group">
                                    <label for="">Sender Number</label>
                                    <input type="text" class="form-control" name="sender_number" placeholder="">

                                    <input type="hidden" name="marcent_number" value="{{ $info->marcent_number}}">
                                    <input type="hidden" name="grandTotal" value="{{ $data['grandTotal'] }}">
                                    <input type="hidden" name="shipping_charge" value="{{ $data['shipping_charge'] }}">
                                    <input type="hidden" name="shipping_id" value="{{ $data['shipping_id'] }}">
                                    <input type="hidden" name="payment_type" value="{{ $data['payment_type'] }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 ">
                                <div class="form-group">
                                    <label for="">Transaction Number</label>
                                    <input type="text" class="form-control" name="transaction_number" placeholder="">
                                </div>
                            </div>
                        </div>
                        <button style="float: right" class="btn btn-success mt-2">Submit</button>
                        {{-- <button class="btn btn-success" id="bKash_button">Pay</button> --}}
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection
