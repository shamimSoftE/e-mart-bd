@extends('FrontEnd.master')

@section('title', 'Order Complete')

@section('content')

<div class="row" >
    <div class="col-6">
        <img src="{{ asset('Front')}}/giphy.gif" height="500px">
    </div>
    <div class="col-6 mt-5 p-4">
        <h3 class=" text-uppercase" style="font-family:Cursive ">
            we are trying to deliver it as soon as possible. Keep claim with us
        </h3>
        <a href="{{ route('home') }}" style="border-radius: 50px;" class="btn btn-warning text-white mt-5 pr-2">Back</a>
        <a href="{{ route('customer_dashboard') }}" style="border-radius: 50px;" class="btn btn-success text-white mt-5 pr-2">See your order details</a>
    </div>
</div>


@endsection
