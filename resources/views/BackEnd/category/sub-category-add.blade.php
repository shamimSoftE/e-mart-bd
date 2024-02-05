@extends('BackEnd.master')

@section('title')
    Sub-Category Add
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
                        <h5>Sub Category Create</h5>
                        <a class="btn btn-sm float-right mb-3" href="{{ route('sub-category.index') }}">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
            {{--<div class="widget-section widget-section-area">--}}
            <div class="offset-1 col-xl-10 col-md-10 col-sm-10 col-10">
                <form action="{{ route('sub-category.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name"  placeholder="Category name">
                    </div>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Select parent category [optional]</label>
                        <select type="text" name="parent_id" class="form-control">
                            <option value="">None</option>
                            @if(!empty($categories))
                                @foreach($categories as $category)
                                    <?php $dash=''; ?>
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @if(!empty($category->subCategories) && count($category->subCategories))
                                        @include('BackEnd.category.subcategoryList-option',['subcategories' => $category->subCategories])
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
            {{-- </div>--}}
        </div>
    </div>

@endsection
