@extends('FrontEnd.master')

@section('title', 'Shipping Address Edit')

@section('content')



    <main class="main">
        <div class="page-header text-center" style="background-image: url('{{ asset('Front') }}/assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Shipping Address<span style="color: #f900b6">Edit</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->


        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#" style="color: #f900b6">Edit</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shipping Address</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="cart">
                <div class="container">
                    <div class="row">
                        <div class="offset-1 col-lg-10 col-md-10 col-lg-10">
                            <div class="card" style="box-shadow: 0px 0px 20px 3px #f900b61f;border-radius: 15px;">
                                <div class="card-header">
                                    <h3 class="text-center pt-3">Shipping Information</h3>
                                </div>
                                <div class="card-body">
                                    @if (isset($shipping))

                                        <form action="{{ route('shipping_address_update',$shipping->id) }}" method="POST" class="register-form outer-top-xs mt-3" role="form">
                                            @csrf

                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="info-title">Name <span style="color: red">*</span></label>
                                                        <input type="text" class="form-control unicase-form-control input-form text-input @error('name') is-invalid @enderror" value="{{ $shipping->name }}" name="name">
                                                        {{-- <input type="hidden" value="{{ auth()->user()->id }}" name="id"> --}}
                                                        @error('name')
                                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="info-title">Phone Number <span style="color: red">*</span></label>
                                                        <input type="text" class="form-control unicase-form-control input-form text-input @error('mobile') is-invalid @enderror" value="{{ $shipping->mobile }}" name="mobile">
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
                                                        <input type="text" class="form-control unicase-form-control input-form text-input @error('address') is-invalid @enderror" value="{{$shipping->address }}" name="address">
                                                        @error('address')
                                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <label class="info-title">City <span style="color: red">*</span></label>
                                                    <div class="form-group">
                                                        <select class="form-control input-form" name="delivery_charge_id">
                                                            <option selected>=Select=</option>
                                                            @foreach(App\Models\DeliveryCharge::where('status',1)->get() as $charge)
                                                                <option value="{{ $charge->id }}" @if ($shipping->delivery_charge_id == $charge->id) selected @endif>
                                                                    {{ $charge->city }}
                                                                </option>
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

                                                <button type="submit" class="btn btn-primary form-button" >Update</button>

                                            </div>
                                        </form>
                                        @else
                                        <form action="{{ route('address_store') }}" method="POST" class="register-form outer-top-xs mt-3" role="form">
                                            @csrf

                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="info-title">Name <span style="color: red">*</span></label>
                                                        <input type="text" class="form-control unicase-form-control input-form text-input @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name">
                                                        {{-- <input type="hidden" value="{{ auth()->user()->id }}" name="id"> --}}
                                                        @error('name')
                                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="info-title">Phone Number <span style="color: red">*</span></label>
                                                        <input type="text" class="form-control unicase-form-control input-form text-input @error('mobile') is-invalid @enderror" value="{{ old('mobile') }}" name="mobile">
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
                                                        <input type="text" class="form-control unicase-form-control input-form text-input @error('address') is-invalid @enderror" value="{{ old('address') }}" name="address">
                                                        @error('address')
                                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <label class="info-title">City <span style="color: red">*</span></label>
                                                    <div class="form-group">
                                                        <select class="form-control input-form" name="delivery_charge_id">
                                                            <option selected>=Select=</option>
                                                            @foreach(App\Models\DeliveryCharge::where('status',1)->get() as $charge)
                                                                <option value="{{ $charge->id }}">
                                                                    {{ $charge->city }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary form-button" >Update</button>

                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


@endsection
