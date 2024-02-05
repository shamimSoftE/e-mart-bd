@extends('BackEnd.master')

@section('title')
    Banner List
@endsection

@section('section')

    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
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
                <div class="widget-content widget-content-area br-6">
                    <div class="">
                        <a class="btn btn-sm float-right mt-3 mr-4" href="{{ route('banner.create') }}">
                            <i class="fas fa-plus-circle"></i> Banner Add
                        </a>
                    </div>
                    <table id="zero-config" class="table dt-table-hover" style="width:100%">

                        <thead>
                        <tr>
                            <th>Sl</th>
                            {{-- <th>Title</th>
                            <th>Excerpt</th> --}}
                            <th>Section</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th class="no-content">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i = 1)
                        @foreach($banners as $banner)
                            <tr>

                                <td>{{ $i++ }}</td>
                                {{-- <td>
                                    @if(!empty($banner->name))
                                        {{ $banner->name }}
                                    @else
                                        {{ __('N/A') }}
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($banner->title))
                                        {{ $banner->title }}
                                    @else
                                        {{ __('N/A') }}
                                    @endif
                                </td> --}}
                                <td>
                                    @if(!empty($banner->section->title))
                                        {{ $banner->section->title }}
                                    @else
                                        {{ __('N/A') }}
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($banner->image))
                                        <img src="{{ asset("Back/images/banner/". $banner->image) }}" height="100px" alt="image">
                                    @else
                                        {{ __('N/A') }}
                                    @endif

                                </td>
                                <td>
                                    @if($banner->status == '1')
                                        <ul class="form-inline">
                                            <li class="text-success"></li>
                                            Visible
                                        </ul>
                                    @else
                                        <ul class="form-inline">
                                            <li class="text-danger"></li>
                                            Hide
                                        </ul>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn" onclick="event.preventDefault();
                                            if(confirm('Are you really want to delete?')){
                                            document.getElementById('banner-delete-{{ $banner->id }}').submit()
                                            }">
                                        <span class="fas fa-trash text-danger" title="Destroy"></span>
                                        <form method="post" action="{{ route('banner.destroy',$banner->id) }}" id="{{ 'banner-delete-'.$banner->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </a>

                                    @if($banner->status == 1)
                                        <a class="btn btn-sm text-success" href="{{ route('banner_status',$banner->id) }}">
                                            <i class="fas fa-arrow-up"></i>
                                        </a>
                                    @else
                                        <a class="btn btn-sm text-danger" href="{{ route('banner_status',$banner->id) }}">
                                            <i class="fas fa-arrow-down"></i>
                                        </a>
                                    @endif
                                    <a class="btn" data-toggle="modal" data-target="#bannerEdit{{ $banner->id }}">
                                        <i class="fas fa-pencil-alt" title="Edit"></i>
                                    </a>
                                </td>
                                {{-- modal --}}

                                <div class="modal fade" id="bannerEdit{{ $banner->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Banner Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('banner.update',$banner) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Section <sup style="color: red">*</sup></label>
                                                                <select name="section_id" id="" class="form-control">
                                                                    <option value="">==Select==</option>
                                                                    @foreach (App\Models\Section::where('status',1)->get() as $sec)
                                                                        <option value="{{ $sec->id }}" @if ($sec->id == $banner->section_id) selected @endif>
                                                                            {{ $sec->title }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                {{-- <label for="name">Preview Image</label> --}}
                                                                <img src="{{ asset("Back/images/banner/". $banner->image) }}" style="height:150px; width:90%" />

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label for="name"> Image</label>
                                                                <input type="file" class="form-control-file" name="image" value="{{ old('image') }}" accept="image/*">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-sm btn-primary mt-5">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{--// modal --}}

                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Sl</th>
                            {{-- <th>Title</th>
                            <th>Excerpt</th> --}}
                            <th>Image</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>

    </div>

@endsection

