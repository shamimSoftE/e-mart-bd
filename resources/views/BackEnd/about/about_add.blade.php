@extends('BackEnd.master')

@section('title')
    About
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
                        <h5>About Create</h5>
                    </div>
                </div>
            </div>

            <div class="offset-1 col-xl-10 col-md-10 col-sm-10 col-10">
                <form action="{{ route('storeAbout') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Our Mission <sup style="color:red">(*)</sup></label>
                                <textarea name="mission" class="form-control" cols="3">{{ old('mission') }}</textarea>
                            </div>
                            @error('mission')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Our Vission<sup style="color:red">(*)</sup></label>
                                <textarea name="vission" class="form-control" cols="3">{{old('vission') }}</textarea>
                            </div>
                            @error('vission')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">Our Story/About Real-Shop<sup style="color:red">(*)</sup></label>
                                <textarea id="editor" name="our_store" class="form-control" rows="6">{{ old('our_store') }}</textarea>
                            </div>
                            @error('our_store')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name">About Page Image<sup style="color:red">(*)</sup> <small>[Width & Height (933 X 390)px]</small> </label>
                                <input type="file" class="form-control-file" name="logo" accept="image/*">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <button type="submit" class="btn btn-sm btn-primary mt-5">Save</button>
                        </div>
                    </div>

                </form>
            </div>
            {{-- </div>--}}
        </div>
    </div>

@endsection


@section('style')
    <link type="text/css" href="{{ asset('/Back') }}/ckeditor/sample/css/sample.css" rel="stylesheet" media="screen" />
@endsection

@section('script')

    <script>

        $(document).ready(function() {

            $(".tagging").select2({
                tags: true
            });

        });

    </script>

    {{-- ========= ckeditor-script --}}
    <script src="{{ asset('/Back') }}/ckeditor/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                 // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            } )
            .then( editor => {
                window.editor = editor;
            } )
            .catch( err => {
                console.error( err.stack );
            } );
    </script>
@endsection
