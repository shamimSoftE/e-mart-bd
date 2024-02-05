@extends('BackEnd.master')

@section('title')
    Slider Add
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
                        <h5>Slider Generate</h5>
                        <a class="btn btn-sm float-right mb-3" href="{{ route('slider.index') }}">
                            <i class="fas fa-arrow-left"></i>  Back
                        </a>
                    </div>
                </div>
            </div>
            {{--<div class="widget-section widget-section-area">--}}
            <div class="offset-1 col-xl-10 col-md-10 col-sm-10 col-10">
                <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Slider Name<sup style="color:red;"> (optional)</sup></label>
                        <input type="text" value="{{ old('name') }}"
                               class="form-control @error('name') is-invalid @enderror" name="name">
                        @error('name')
                        <div class="alert alert-default-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Slider Title<sup style="color:red;"> (optional)</sup></label>
                        <input type="text" value="{{ old('title') }}"
                               class="form-control @error('title') is-invalid @enderror" name="title">
                        @error('title')
                        <div class="alert alert-default-danger">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="form-group">
                        <label for="section_id">Category<sup style="color:red;" title="Must fill out this">*</sup></label>

                        <select name="category_id" class="form-control basic" id="">
                            <option value="">==Select==</option>
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
                        <div class="alert alert-default-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <div class="form-group">
                                <label for="name">Slider Image<sup style="color:red;" title="Must fill out this">*</sup><small style="color: red">[width & height (1920 x 440) px]</small></label>
                                <input type="file" accept="image/*" value="{{ old('image') }}"
                                       class="form-control-file @error('image') is-invalid @enderror" name="image">
                                @error('image')
                                <div class="alert alert-default-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

