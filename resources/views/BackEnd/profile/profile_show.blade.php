@extends('BackEnd.master')

@section('title')
    Profile Customize
@endsection

@section('section')

    <div class="layout-px-spacing">

        <div class="account-settings-container layout-top-spacing">

            <div class="account-content">
                <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">

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

                            <form id="general-info" class="section general-info" method="post" action="{{ route('profile_update',$user) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="info">
                                    <h5 class="text-center text-primary">
                                        <strong>{{ $user->name }}</strong>, Here you can customize your information.<sup><small>(if you want)</small></sup>
                                        <hr/>
                                    </h5>
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-12 col-md-4">
                                                    <div class="upload mt-4 pr-md-4">
                                                        <input type="file" accept="image/*" name="avatar" class="form-control-file" />
                                                        <p class="mt-2"><i class="flaticon-cloud-upload mr-1"></i> Upload Picture</p>
                                                    </div>
                                                </div>
                                                <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="fullName">Your Name</label>
                                                                    <input type="text" name="name" class="form-control mb-4" value="{{ $user->name }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="fullName">Date Of Birth</label>
                                                                    <input type="date" class="form-control mb-4" name="date_of_birth" value="{{ $user->date_of_birth }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="fullName">Your E-mail</label>
                                                                    <input type="text" name="email" class="form-control mb-4" value="{{ $user->email }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="fullName">Contact Number</label>
                                                                    <input type="text" class="form-control mb-4" name="phone_number" value="{{ $user->phone_number }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="profession">Profession</label>
                                                                    <input type="text" class="form-control mb-4" name="profession" placeholder="Some thing cool" value="{{ $user->profession }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="fullName">Create a new password <sup style="color: darkred" title="If you don't want to change your password, Just skip this field">(..?)</sup></label>
                                                                    <input type="password" class="form-control mb-5" name="password">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-success"> Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection




