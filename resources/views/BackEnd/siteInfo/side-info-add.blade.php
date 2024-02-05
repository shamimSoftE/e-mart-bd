@extends('BackEnd.master')

@section('title')
    Site-Info-Add
@endsection


@section('section')

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
                        <h5>Site-Info-Generate</h5>
                        <a class="btn btn-sm float-right mb-3" href="{{ route('site.index') }}">
                            <i class="fas fa-list"></i> Site-Info-List
                        </a>
                    </div>
                </div>
            </div>
            {{--<div class="widget-section widget-section-area">--}}
            <div class="offset-1 col-xl-10 col-md-10 col-sm-10 col-10">
                <form action="{{ route('site.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Site Name<sup style="color:red;" title="Must fill out this">*</sup></label>
                                <input type="text" class="form-control @error('site_name') is-invalid @enderror" name="site_name"  placeholder=" site name">
                            </div>
                            @error('site_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Site Address<sup style="color:red;" title="Must fill out this">*</sup></label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"  placeholder=" site address">
                            </div>
                            @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Facebook<sup style="color:red;" title="Must fill out this">*</sup></label>
                                <input type="text" class="form-control @error('facebook_link') is-invalid @enderror" name="facebook_link"  placeholder=" facebook link">
                            </div>
                            @error('facebook_link')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Twitter<sup style="color:red;">(optional)</sup></label>
                                <input type="text" class="form-control " name="twitter_link"  placeholder="twitter link">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Instagram<sup style="color:red;">(optional)</sup></label>
                                <input type="text" class="form-control " name="instagram_link"  placeholder=" instagram link">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">YouTube<sup style="color:red;">(optional)</sup></label>
                                <input type="text" class="form-control" name="youtube_link"  placeholder=" youtube link">
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Contact Number<sup style="color:red;">*</sup></label>
                                <input type="text" class="form-control @error('contact_number') is-invalid @enderror" name="contact_number"  placeholder=" contact_number">
                            </div>
                            @error('contact_number')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Site E-mail<sup style="color:red;">*</sup></label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"  placeholder=" email link">
                            </div>
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Site Logo<sup style="color:red;" title="Must fill out this">*</sup><small style="color: red">[Width & Height (223X36)px ]</small></label>
                                <input type="file" class="form-control-file" name="logo" accept="image/*">
                            </div>
                            @error('logo')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">App Logo<sup style="color:red;" title="Must fill out this">*</sup><small style="color: red">[Width & Height (376X90)px ]</small></label>
                                <input type="file" class="form-control-file" name="app_logo" accept="image/*">
                            </div>
                            @error('logo')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Site Description</label>
                                <textarea name="site_about" class="form-control" cols="15" rows="5">{{ old('site_about') }}</textarea>
                            </div>
                        </div>
                    </div>

                        <button type="submit" class="btn btn-primary mt-5">Submit</button>

                    </div>

                </form>
            </div>
            {{-- </div>--}}
        </div>
    </div>

@endsection
