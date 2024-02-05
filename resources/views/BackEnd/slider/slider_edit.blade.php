@extends('BackEnd.master')

@section('title')
    Slider | Edit
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
                        <h5>Slider Edit</h5>
                        <a class="btn btn-sm float-right mb-3" href="{{ route('slider.index') }}">
                            <i class="fas fa-arrow-left"></i>  Back
                        </a>
                    </div>
                </div>
            </div>

            <div class="offset-1 col-xl-10 col-md-10 col-sm-10 col-10">
                <form action="{{ route('slider.update',$slider) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Slider Name</label>
                        <input type="text" value="{{ $slider->name }}"
                               class="form-control @error('name') is-invalid @enderror" name="name">
                        @error('name')
                        <div class="alert alert-default-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Slider Title</label>
                        <input type="text" value="{{ $slider->title }}"
                               class="form-control @error('title') is-invalid @enderror" name="title">
                        @error('title')
                        <div class="alert alert-default-danger">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="form-group">
                        <label for="section_id">Category</label>
                        <select name="category_id" class="form-control basic" id="">
                            <option value="">==Select==</option>
                            {{-- @foreach (App\Models\Category::where('status',1)->get() as $cate)
                                <option value="{{ $cate->id }}" @if($cate->id == $slider->category_id) selected @endif>
                                    {{ $cate->name }}
                                </option>
                            @endforeach --}}

                            @foreach(App\Models\Category::where('status',1)->where('parent_id', null)->orderBy('name', 'asc')->get() as $cate)
                                        <option value="{{ $cate->id }}" @if($cate->id == $slider->category_id) selected @endif>
                                            {{ $cate->name }}
                                        </option>
                                        @if(!empty($cate->subCategories) && count($cate->subCategories))
                                            @foreach($cate->subCategories as $subCate)

                                                <option value="{{ $subCate->id }}" @if($subCate->id == $slider->category_id) selected @endif>
                                                    ==>{{ $subCate->name }}
                                                </option>

                                                @if(!empty($subCate->subCategories) && count($subCate->subCategories))
                                                    @foreach($subCate->subCategories as $child)

                                                        <option value="{{ $child->id }}" @if($child->id == $slider->category_id) selected @endif>
                                                            ===>{{ $child->name }}
                                                        </option>
                                                        @if(!empty($child->subCategories) && count($child->subCategories))
                                                            @foreach($child->subCategories as $childCate)
                                                                <option value="{{ $childCate->id }}" @if($childCate->id == $slider->category_id) selected @endif>
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

                    <div class="row">

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="name">Previous Image</label>
                                <img src="{{ asset("Back/images/slider/". $slider->image ) }}" height="60" width="60" alt="pro-img">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="name">Slider Image</label> <small style="color: red">[width & height (1920 x 440) px]</small>
                            <input type="file" accept="image/*" class="form-control-file" name="image">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12">
                            <button type="submit" class="btn btn-info mt-4">Update</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>

@endsection

