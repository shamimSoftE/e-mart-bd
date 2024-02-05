@extends('BackEnd.master')

@section('title')
    Product Edit
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
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h5>Product Edit</h5>
                        <a class="btn btn-md float-right mb-3" href="{{ route('product.index') }}">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
            {{--<div class="widget-section widget-section-area">--}}
            <div class="offset-1 col-xl-10 col-md-10 col-sm-10 col-10">

                <form action="{{ route('product.update',$product->id) }}" method="post" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Product Name<sup style="color:red;" title="Must fill out this">*</sup></label>
                        <input type="text" value="{{ $product->name }}" class="form-control @error('name') is-invalid @enderror" name="name">
                        @error('name')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="form-group mb-1">
                        <label class="mb-0"  for="name">Product Affiliate Link (External Link)</label>
                        <input type="text" class="form-control @error('affiliate_link') is-invalid @enderror " value="{{ $product->affiliate_link }}" name="affiliate_link">
                        @error('affiliate_link')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    <div class="row" style=" margin-bottom: -11px;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control basic" name="category_id" id="category_id">
                                    <option value="">===Select===</option>
                                    @foreach(App\Models\Category::where('status',1)->where('parent_id', null)->orderBy('name', 'asc')->get() as $cat)
                                        <option value="{{ $cat->id }}" @if($product->category_id == $cat->id) selected @endif>
                                            {{ $cat->name }}
                                        </option>
                                        @if(!empty($cat->subCategories) && count($cat->subCategories))
                                            @foreach($cat->subCategories as $subCate)
                                                <option value="{{ $subCate->id }}" @if($product->category_id == $subCate->id) selected @endif>
                                                    ==>{{ $subCate->name }}
                                                </option>
                                                @if(!empty($subCate->subCategories) && count($subCate->subCategories))
                                                    @foreach($cat->subCategories as $child)
                                                        <option value="{{ $child->id }}" @if($product->category_id == $child->id) selected @endif>
                                                            ===>{{ $child->name }}
                                                        </option>
                                                        @if(!empty($child->subCategories) && count($child->subCategories))
                                                            @foreach($child->subCategories as $childCate)
                                                                <option value="{{ $childCate->id }}" @if($product->category_id == $childCate->id) selected @endif>
                                                                    ====>{{ $childCate->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="section_id">Brand<sup style="color:red;">(optional)</sup></label>
                                <select class="form-control  basic" name="brand_id">
                                    <option value="">Select</option>
                                    @foreach(App\Models\Brand::where('status',1)->get() as $brand)
                                        <option value="{{ $brand->id }}"
                                            @if($brand->id == $product->brand_id) selected @endif>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Model No<sup style="color:red;">(optional)</sup></label>
                                <input type="text" class="form-control" value="{{  $product->model_name }}" name="model_name">
                                @error('model_name')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> --}}
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Delivery Days<sup style="color:red;">(optional)</sup></label>
                                <input type="number" class="form-control @error('delivery') is-invalid @enderror" value="{{ $product->delivery }}" name="delivery">
                                @error('delivery')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="section_id">Warranty<sup style="color:red;">(optional)</sup></label>
                                <input type="text" class="form-control @error('warranty') is-invalid @enderror" value="{{ $product->warranty }}" name="warranty">
                                @error('warranty')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Regular Price<sup style="color:red;" title="Must fill out this">*</sup></label>
                                <input type="number" value="{{ $product ->regular_price }}" class="form-control @error('regular_price') is-invalid @enderror" name="regular_price">
                                @error('regular_price')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Special Price<sup style="color:red;" title="Must fill out this">*</sup></label>
                                <input type="number" value="{{ $product ->special_price }}" class="form-control @error('special_price') is-invalid @enderror" name="special_price">
                                @error('special_price')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Product Qty<sup style="color:red;" title="Must fill out this">*</sup></label>
                                <input type="number" value={{ $product ->quantity }} class="form-control" name="quantity">
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


                    <div class="form-group" style=" margin-bottom: -11px; ">
                        <label for="section_id">Section<sup style="color:red;">(optional)</sup></label>
                        <select class="form-control basic js-example-basic-multiple" name="section_id[]"   multiple="multiple">
                            @foreach(App\Models\Section::where('status',1)->get() as $m_content)
                                <option value="{{ $m_content->id }}"
                                    @if($product->section_id != null) @if(in_array($m_content->id, json_decode($product->section_id, TRUE))) {{"selected"}} @endif @endif  >
                                    {{ $m_content->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" style=" margin-bottom: -11px; ">
                        <label for="name">Product Color <sup style="color:red;">[optional]</sup></label>
                        <select class="form-control basic tagging" multiple="multiple" name="color_id[]">
                        {{--<select class="form-control basic" name="color_id">--}}

                            @foreach(App\Models\Color::where('status',1)->get() as $color)
                                <option value="{{ $color->id }}"
                                        @if($product->color_id != null)
                                            @if(in_array($color->id, json_decode($product->color_id, TRUE)))
                                            {{"selected"}}
                                            @endif
                                        @endif
                                        >
                                    {{ $color->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" style=" margin-bottom: -11px; ">
                        <label for="name">Product Size <sup style="color:red;">[optional]</sup></label>
                        <select class="form-control basic tagging" multiple="multiple" name="size_id[]">
                            <option value="S"
                                    @if($product->size != null)
                                        @if(in_array('S', json_decode($product->size, TRUE)))
                                            {{"selected"}}
                                        @endif
                                    @endif
                                    >
                                S
                            </option>
                            <option value="M"
                                    @if($product->size != null)
                                        @if(in_array('M', json_decode($product->size, TRUE)))
                                            {{"selected"}}
                                        @endif
                                    @endif
                                    >
                                M
                            </option>
                            <option value="L"
                                    @if($product->size != null)
                                        @if(in_array('L', json_decode($product->size, TRUE)))
                                            {{"selected"}}
                                        @endif
                                    @endif
                                    >
                                L
                            </option>
                            <option value="XL"
                                    @if($product->size != null)
                                        @if(in_array('XL', json_decode($product->size, TRUE)))
                                            {{"selected"}}
                                        @endif
                                    @endif
                                    >
                                XL
                            </option>
                        </select>
                    </div>


                    {{-- <div class="form-group" id="PreView" style="display: block">
                        <label for="omq" title="Minimum Order Quantity">MOQ<sup style="color:red;">Optional</sup></label>
                        <input type="number" class="form-control" name="omq" value="{{ $product->omq }}">
                        @error('omq')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div> --}}



                    {{-- <div class="form-group">
                        <label for="name">Warranty<sup style="color:red;">(optional)</sup></label>
                        <input type="text" class="form-control" name="warranty" value="{{ $product->warranty }}">
                    </div>

                    <div class="form-group">
                        <label for="name">Product Delivery Days<sup style="color:red;">(optional)</sup></label>
                        <input type="number" class="form-control" value="{{ $product->delivery }}" name="delivery">
                        @error('delivery')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="form-group mb-0">
                        <label  class="form-control-plaintext">Product Description<sup style="color:red;" title="Must fill out this">*</sup></label>
                        <textarea rows="5" class="jqte-test" id="editor" name="long_description">{{ $product ->long_description }}</textarea>
                        @error('long_description')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-0">
                        <label  class="form-control-plaintext">Product Additional Information<sup style="color:red;" title="Must fill out this">*</sup></label>
                        <input type="text" name="short_description" value="{{ $product ->short_description }}"
                               class="form-control" id="short_description">
                        @error('short_description')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-0">
                        <label  class="form-control-plaintext">Product Return Police<sup style="color:red;" title="Must fill out this">[optional]</sup></label>
                        <input type="text" name="return_policy" value="{{ $product ->return_policy }}"
                               class="form-control @error('return_policy') is-invalid @enderror" id="return_policy">
                        @error('return_policy')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group mb-0">
                        <label  class="form-control-plaintext">Product Tag/SEO Tag<sup style="color:red;" title="Must fill out this">*</sup></label>
                        <input type="text" name="p_tag" value="{{ $product ->p_tag }}"
                               class="form-control" id="p_tag">
                        @error('p_tag')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <?php
                        $photos = json_decode($product->image)
                    ?>

                    <div class="form-group row">
                        @foreach ($photos as $key => $item)
                            <div id="image{{ $key }}" class="float-right mr-1">

                                <button style="margin-left: -17px;" onclick="closeImage({{ $key }})"  type="button" class="close close_image" aria-label="Close">
                                    <span  aria-hidden="true">&times;</span>
                                </button>
                                <img style="height: 100px;" src="{{asset('Back/images/product/'.$item)}}" alt="">
                                <input type="hidden" value="{{ $item }}"  name="old_image[]">
                            </div>
                        @endforeach
                    </div>

                    <div class="row" >
                        <div class="col-md-lg-12 col-md-12 col-sm-12" style=" margin-bottom: -15px; ">
                            <div class="form-group">
                                <label for="name">Product Image<sup style="color:red;" title="Must fill out this">*</sup>[Width & Height 218 x 220 px]</label>
                                <input type="file" accept="image/*" multiple value="{{ old('image') }}" class="form-control-file @error('image') is-invalid @enderror" name="image[]">
                                @if(Session::has('img_error'))
                                    <p class='text-danger'>
                                        {{ Session::get('img_error') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        {{-- <div class="col-md-lg-3 col-md-3 col-sm-12">
                            <div class="form-check form-switch mt-5">
                                <input class="form-check-input" value="1" @if($product->affiliate_link == 1) checked @endif name="affiliate_link"  type="checkbox" role="switch" id="affiliate_link">
                                <label class="mb-0"  class="form-check-label" for="affiliate_link">Affiliate Product</label>
                            </div>
                        </div> --}}
                        <div class="col-md-lg-3 col-md-3 col-sm-12">
                            <div class="form-check form-switch mt-5">
                                <input class="form-check-input" value="1" @if($product->cod == 1) checked @endif name="cod" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Cash On Delivery</label>
                            </div>
                        </div>
                        <div class="col-md-lg-6 col-md-6 col-sm-12 mt-5">
                            <button type="submit" class="btn btn-primary ">Update</button>
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
    <script src="{{ asset('/Back') }}/ckeditor/ckeditor.js"></script>


    <script>
        $(document).ready(function() {

            $('#inputValue').change(function (){
                let inputValue = $(this).val();

                //  alert(inputValue);
                if(inputValue == 7)
                {
                    $.ajax({
                        success:function (resp){

                            $("#PreView").css("display", "block");

                        },error:function (){
                            alert('Some thing is wrong');
                        }
                    })
                }else{
                    $("#PreView").css("display", "none");
                }


            });
        });
    </script>

    {{--========= ckeditor script--}}
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
