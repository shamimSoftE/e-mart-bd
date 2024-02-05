@extends('BackEnd.master')

@section('title')
    Shipping Charge Add
@endsection


@section('content')

    <div id="flStackForm" class="col-lg-12 layout-spacing layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                {{-- display success message--}}
                @if(Session::has('sms'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('sms') }}</strong>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                {{-- display success message--}}
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h5>Charge Generate</h5>
                        <a class="btn btn-sm float-right mb-3" href="{{ route('charge.index') }}">
                            <i class="fas fa-list"></i> Charge List
                        </a>
                    </div>
                </div>
            </div>
            {{--<div class="widget-content widget-content-area">--}}
            <div class="offset-1 col-xl-10 col-md-10 col-sm-10 col-10">
                <form action="{{ route('charge.store') }}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" name="city"  placeholder="Such as Dhaka ">
                            </div>
                            @error('city')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Charge</label>
                                <input type="text" class="form-control @error('charges') is-invalid @enderror" name="charges"  placeholder="Such as  tk.50 ">
                            </div>
                            @error('charges')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
            {{-- </div>--}}
        </div>
    </div>

@endsection
