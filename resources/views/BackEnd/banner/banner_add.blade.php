@extends('BackEnd.master')

@section('title')
    Banner Add
@endsection

@section('section')

    <div id="flStackForm" class="col-lg-12 layout-spacing layout-top-spacing">
        <div class="statbox widget box box-shadow" style="margin: 100px 0 250px 0;">

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
                        <h5>Banner Generate</h5>
                        <a class="btn btn-sm float-right mb-3" href="{{ route('banner.index') }}">
                            <i class="fas fa-list"></i> Banner List
                        </a>
                    </div>
                </div>
            </div>

            <div class="offset-1 col-xl-10 col-md-10 col-sm-10 col-10">
                <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Section <sup style="color: red"> (*) </sup></label>
                                <select name="section_id" class="form-control basic" id="" class="form-control">
                                    <option value="">==Select==</option>
                                    @foreach (App\Models\Section::where('status',1)->get() as $sec)
                                        <option value="{{ $sec->id }}"> {{ $sec->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Image <sup style="color: red"> (*) </sup><small> [Width & Height 1130 x 200 px] </small></label>
                                <input type="file" class="form-control-file" name="image" accept="image/*">
                            </div>
                        </div>
                    </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary mt-3" style="float: right">Submit</button>
                        </div>

                    </div>
                </form>
            </div>
            {{-- </div>--}}
        </div>
    </div>

@endsection
