@extends('BackEnd.master')

@section('title')
    Site-Info-Edit
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
                        <h5>Site-Info-Edit</h5>
                        <br/>
                        {{-- <a class="btn btn-dark float-right mb-3" href="{{ route('site.index') }}">
                            <i class="fas fa-list"></i> Site-Info-List
                        </a> --}}
                    </div>
                </div>
            </div>
            {{--<div class="widget-section widget-section-area">--}}
            <div class="offset-1 col-xl-10 col-md-10 col-sm-10 col-10">
                <form action="{{ route('site.update',$site) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Site Name</label>
                                <input type="text" class="form-control" name="site_name"  value="{{ $site->site_name }}">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Site Address</label>
                                <input type="text" class="form-control" name="address"  value="{{ $site->address }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">FaceBook</label>
                                <input type="text" class="form-control" name="facebook_link"  value="{{ $site->facebook_link }}">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Twitter</label>
                                <input type="text" class="form-control" name="twitter_link"  value="{{ $site->twitter_link }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Instagram</label>
                                <input type="text" class="form-control" name="instagram_link"  value="{{ $site->instagram_link }}">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Youtube</label>
                                <input type="text" class="form-control" name="youtube_link"  value="{{ $site->youtube_link }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Contact Number</label>
                                <input type="text" class="form-control" name="contact_number"  value="{{ $site->contact_number }}">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Email</label>
                                <input type="text" class="form-control" name="email"  value="{{ $site->email }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">e-Cad ID</label>
                                <input type="text" class="form-control" name="e_cad_id"  value="{{ $site->e_cad_id }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">TIN</label>
                                <input type="text" class="form-control" name="tin"  value="{{ $site->tin }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Trade Licence No</label>
                                <input type="text" class="form-control" name="trade_licence_no"  value="{{ $site->trade_licence_no }}">
                            </div>
                        </div>

                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">App Link</label>
                                <input type="text" class="form-control" name="app_link"  value="{{ $site->app_link }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Developed By</label>
                                <input type="text" class="form-control" name="developed_by"  value="{{ $site->developed_by }}">
                            </div>
                        </div>
                    </div>

                   <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Site Logo Preview</label>
                                <img src="{{ asset("Back/images/logo/".$site->logo) }}" height="50px" style="background-color: black" alt="site-logo">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Site Logo <small style="color: red">[Width & Height (223X36)px ]</small></label>
                                <input type="file" class="form-control-file" name="logo" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Site App Logo Preview </label>
                                <img src="{{ asset("Back/images/logo/appLogo/".$site->app_logo) }}" height="50px" style="background-color: black" alt="site-logo">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">App Logo <small style="color: red">[Width & Height (376X90)px ]</small></label>
                                <input type="file" class="form-control-file" name="app_logo" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Site Description </label>
                                <textarea name="site_about" class="form-control" cols="15" rows="5">{{ $site->site_about }}</textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                </form>
            </div>
            {{-- </div>--}}
        </div>
    </div>

@endsection
