@extends('BackEnd.master')

@section('title')
    Banner Edit
@endsection

@section('section')

<div id="flStackForm" class="col-lg-12 layout-spacing layout-top-spacing">
    <div class="statbox widget box box-shadow" style="margin: 50px 0 250px 0">
        <div class="offset-1 col-xl-10 col-md-10 col-sm-10 col-10" >
            <form action="{{ route('banner_update',$bannerFirst) }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Preview Image</label>
                            <img src="{{ asset("Back/images/banner/". $bannerFirst->image) }}" style="width: 95%;" alt="banner-image" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mt-5">
                            <label>Image <sup style="color: red"> (optional) </sup><small> [Width & Height (1130 x 200)px] </small></label>
                            <input type="file" class="form-control-file" name="image" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="form-group" style="    margin-bottom: 35px;">
                    <button type="submit" style="float: right" class="btn btn-sm btn-primary">Update</button>
                </div>
            </form>
        </div>

    </div>

@endsection

