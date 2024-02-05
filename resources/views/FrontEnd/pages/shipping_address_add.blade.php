@extends('FrontEnd.master')

@section('title', 'Shipping Address Add')

@section('content')



    <main class="main">
        <div class="page-header text-center" style="background-image: url('{{ asset('Front') }}/assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Shipping Address<span>Add</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->


        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Add</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shipping Address</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="cart">
                <div class="container">
                    <div class="row">
                        <div class="offset-1 col-lg-10 col-md-10 col-lg-10">
                            <div class="card" style="box-shadow: -1px 6px 7px 3px #bf8bb1;">
                                <div class="card-body">

                                    <form action="{{ route('address_store') }}" method="POST" class="register-form outer-top-xs mt-3" role="form">
                                        @csrf

                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="info-title">Name <span style="color: red">*</span></label>
                                                    <input type="text" class="form-control input-form unicase-form-control text-input @error('name') is-invalid @enderror" value="{{ auth()->user()->name }}" name="name">
                                                    @error('name')
                                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="info-title">Phone Number <span style="color: red">*</span></label>
                                                    <input type="text" class="form-control input-form unicase-form-control text-input @error('mobile') is-invalid @enderror" value="{{ auth()->user()->phone_number }}" name="mobile">
                                                    @error('mobile')
                                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="info-title">Address <span style="color: red">*</span></label>
                                                    <input type="text" class="form-control input-form unicase-form-control text-input @error('address') is-invalid @enderror" value="{{ old('address') }}" name="address">
                                                    @error('address')
                                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <label class="info-title">City <span style="color: red">*</span></label>
                                                <div class="form-group">
                                                    {{-- <input class="form-check-input" type="radio" name="city" value="dhaka" id="defaultCheck1">
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        In Dhaka
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="city" value="other" id="defaultCheck1">
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        Outsite Dhaka
                                                    </label> --}}
                                                    <select class="form-control input-form" name="delivery_charge_id">
                                                        <option selected>=Select=</option>
                                                        @foreach(App\Models\DeliveryCharge::where('status',1)->get() as $charge)
                                                            <option value="{{ $charge->id }}">{{ $charge->city }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                                {{-- <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="info-title">Pincode <span style="color: red">*</span></label>
                                                        <input type="text" class="form-control unicase-form-control text-input @error('pincode') is-invalid @enderror" value="{{ old('pincode') }}" name="pincode">
                                                        @error('pincode')
                                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> --}}

                                            <button type="submit" class="btn btn-primary form-button">Submit</button>

                                        </div>
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
