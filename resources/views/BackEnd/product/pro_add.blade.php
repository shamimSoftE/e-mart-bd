@extends('BackEnd.master')

@section('title')
    Product Add
@endsection

@section('style')
    <style>
        .form-control { height: calc(1em + 1rem + 2px) !important;}

        /* select2 */
        .select2-container .select2-selection--single .select2-selection__rendered { padding: 5px 10px !important; height: calc(1em + 1rem + 2px) !important;  }
        .select2-container--default .select2-selection--single .select2-selection__arrow { top: 4px !important;  }


        /* select multiple */
        .select2-container--default .select2-selection--multiple { background-color: white !important; font-size: 13px !important; padding: 1px 16px !important;  font-weight: 600 !important;  }
        .select2-container .select2-selection--multiple { min-height: 25px !important; }
    </style>
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
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <h5>Create Product</h5>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <a class="btn btn-md float-right" href="{{ route('product.index') }}">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
            {{--<div class="widget-section widget-section-area">--}}
            <div class="offset-1 col-xl-10 col-md-10 col-sm-10 col-10">

                <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                    @csrf
                    {{-- @method('PUT') --}}
                    <div class="form-group mb-1">
                        <label class="mb-0"  for="name">Product Name<sup style="color:red;" title="Must fill out this">*</sup></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror " value="{{ old('name') }}" name="name" required>
                        @error('name')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="form-group mb-1">
                        <label class="mb-0"  for="name">Product Affiliate Link (External Link)</label>
                        <input type="text" class="form-control @error('affiliate_link') is-invalid @enderror " value="{{ old('affiliate_link') }}" name="affiliate_link">
                        @error('affiliate_link')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    <div class="row" style=" margin-bottom: -11px; ">
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="mb-0" >Category</label>
                                <select class="form-control basic" name="category_id" >
                                    <option value="0">===Select===</option>
                                    @foreach(App\Models\Category::where('status',1)->where('parent_id', null)->orderBy('name', 'asc')->get() as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @if(!empty($cat->subCategories) && count($cat->subCategories))
                                            @foreach($cat->subCategories as $subCate)
                                                <option value="{{ $subCate->id }}">==>{{ $subCate->name }}</option>
                                                @if(!empty($subCate->subCategories) && count($subCate->subCategories))
                                                    @foreach($cat->subCategories as $child)
                                                        <option value="{{ $child->id }}">===>{{ $child->name }}</option>
                                                        @if(!empty($child->subCategories) && count($child->subCategories))
                                                            @foreach($child->subCategories as $childCate)
                                                                <option value="{{ $childCate->id }}">====>{{ $childCate->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="mb-0"  for="section_id">Brand</label>
                                <select class="form-control  basic" name="brand_id">
                                    <option value="">Select</option>
                                    @foreach(App\Models\Brand::where('status',1)->get() as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-0" >Delivery Days</label>
                                <input type="number" class="form-control @error('delivery') is-invalid @enderror" value="{{ old('delivery') }}" name="delivery">
                                @error('delivery')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-0"  for="section_id">Warranty</label>
                                <input type="text" class="form-control @error('warranty') is-invalid @enderror" value="{{ old('warranty') }}" name="warranty">
                                @error('warranty')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group mb-0">
                                <label class="mb-0"  for="name">Regular Price<sup style="color:red;" title="Must fill out this">*</sup></label>
                                <input type="number" class="form-control @error('regular_price') is-invalid @enderror" value="{{ old('regular_price') }}" name="regular_price">
                                @error('regular_price')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-0">
                                <label class="mb-0"  for="name">Special Price</label>
                                <input type="number" class="form-control @error('spacial_price') is-invalid @enderror" value="{{ old('spacial_price') }}" name="spacial_price">
                                @error('spacial_price')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-0">
                                <label class="mb-0"  for="name">Product Qty<sup style="color:red;" title="Must fill out this">*</sup></label>
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" name="quantity">
                                @error('quantity')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-0" id="PreView" style="display: block">
                                <label class="mb-0"  for="omq" title="Minimum Order Quantity">MOQ<sup style="color:red;">Optional</sup></label>
                                <input type="number" class="form-control" name="omq" value="{{ old('omq') }}">
                                @error('omq')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    {{-- <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="mb-0"  for="name">Product Qty<sup style="color:red;" title="Must fill out this">*</sup></label>
                                <input type="number" class="form-control" name="quantity" value="{{ old('quantity') }}">
                                @error('quantity')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-0" id="PreView" style="display: block">
                                <label class="mb-0"  for="omq" title="Minimum Order Quantity">MOQ<sup style="color:red;">Optional</sup></label>
                                <input type="number" class="form-control" name="omq" value="{{ old('omq') }}">
                                @error('omq')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="mb-0"  for="name">Product Delivery Days</label>
                                <input type="number" class="form-control @error('delivery') is-invalid @enderror" value="{{ old('delivery') }}" name="delivery">
                                @error('delivery')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div> --}}

                    <div class="form-group mt-1 mb-0">
                        <label class="mb-0"  for="multi_contents">Multi Section</label>
                        <select class="form-control basic js-example-basic-multiple" id="inputValue" name="section_id[]" multiple="multiple">
                            @foreach(App\Models\Section::where('status',1)->get() as $m_section)
                                <option value="{{ $m_section->id }}">{{ $m_section->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-0" style="margin: -15px 0 !important;">
                        <label class="mb-0"  for="name">Product Color </label>
                        <select class="form-control basic tagging" multiple="multiple" name="color_id[]">
                            @foreach(App\Models\Color::where('status',1)->get() as $color)
                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-0" style="margin-bottom: -15px !important">
                        <label class="mb-0"  for="name">Product Size </label>
                        <select class="form-control basic tagging" multiple="multiple" name="size_id[]">
                            <option value="S">{{ __('S') }}</option>
                            <option value="M">{{ __('M') }}</option>
                            <option value="L">{{ __('L') }}</option>
                            <option value="XL">{{ __('XL') }}</option>
                        </select>
                    </div>

                    <div class="form-group mb-0 mt-0">
                        <label class="mb-0"   class="form-control-plaintext">Product Description<sup style="color:red;" title="Must fill out this">*</sup></label>
                        <textarea rows="5" class="jqte-test" id="editor" name="long_description">{{ old('long_description') }}</textarea>
                        @error('long_description')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-0 mt-1">
                        <label class="mb-0"   class="form-control-plaintext">Product Additional Information<sup style="color:red;" title="Must fill out this">*</sup></label>
                        <input type="text" name="short_description" value="{{ old('short_description') }}"
                               class="form-control @error('short_description') is-invalid @enderror" id="short_description">
                        @error('short_description')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-1 mb-0">
                        <label class="mb-0"   class="form-control-plaintext">Product Return Police<sup style="color:red;" title="Must fill out this">[optional]</sup></label>
                        <input type="text" name="return_policy" value="{{ old('return_policy') }}"
                               class="form-control @error('return_policy') is-invalid @enderror" id="return_policy">
                        @error('return_policy')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-1">
                        <label class="mb-0"   class="form-control-plaintext">Product Tag/ SEO Tag<sup style="color:red;" title="Must fill out this">*</sup></label>
                        <input type="text" name="p_tag" value="{{ old('p_tag') }}"
                               class="form-control @error('p_tag') is-invalid @enderror" id="p_tag">
                        @error('p_tag')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-lg-12 col-md-12 col-sm-12">
                            <div class="form-group mb-0">
                                <label class="mb-0"  for="name">Product Image<sup style="color:red;" title="Must fill out this">*</sup> [Width & Height 218 x 220 px]</label>
                                <input type="file" accept="image/*" multiple value="{{ old('image') }}" class="form-control-file @error('image') is-invalid @enderror" name="image[]">
                                @if(Session::has('img_error'))
                                    <p class='text-danger'>
                                        {{ Session::get('img_error') }}
                                    </p>
                                @endif
                                @error('image')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="col-md-lg-4 col-md-4 col-sm-12">
                            <div class="form-group mb-0">
                                <label class="mb-0"  for="name">Product Review </label>
                                <div class="form-inline">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="1" name="review" id="flexRadioDefault1">
                                        <label class="mb-0"  class="form-check-label" for="flexRadioDefault1">
                                            1<sup style="background-color: red">*</sup>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="2" name="review" id="flexRadioDefault2">
                                        <label class="mb-0"  class="form-check-label" for="flexRadioDefault2">
                                            2<sup style="background-color: red">*</sup>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="3" name="review" id="flexRadioDefault3">
                                        <label class="mb-0"  class="form-check-label" for="flexRadioDefault3">
                                            3<sup style="background-color: red">*</sup>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="4" name="review" id="flexRadioDefault4">
                                        <label class="mb-0"  class="form-check-label" for="flexRadioDefault4">
                                            4<sup style="background-color: red">*</sup>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="5" name="review" id="flexRadioDefault5">
                                        <label class="mb-0"  class="form-check-label" for="flexRadioDefault5">
                                            5<sup style="background-color: red">*</sup>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        {{-- <div class="col-md-lg-3 col-md-3 col-sm-12">
                            <div class="form-check form-switch mt-5">
                                <input class="form-check-input" value="1" name="affiliate_link"  type="checkbox" role="switch" id="affiliate_link">
                                <label class="mb-0"  class="form-check-label" for="affiliate_link">Affiliate Product</label>
                            </div>
                        </div> --}}

                        <div class="col-md-lg-3 col-md-3 col-sm-12">
                            <div class="form-check form-switch mt-5">
                                <input class="form-check-input" value="1" name="cod" checked type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                <label class="mb-0"  class="form-check-label" for="flexSwitchCheckDefault">Cash On Delivery</label>
                            </div>
                        </div>
                        <div class="col-md-lg-6 col-md-6 col-sm-12 mt-5">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
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


