@extends('BackEnd.master')

@section('title')
    Slider | List
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
                        <a class="btn btn-sm float-right mt-3 mr-4" href="{{ route('slider.create') }}">
                           <i class="fas fa-plus-circle"></i> Slider Add
                        </a>
                    </div>
                    <table id="zero-config" class="table dt-table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Title</th>

                                <th>Image</th>
                                <th>Category</th>
                                <th>Created Time</th>
                                <th>Status</th>
                                <th class="no-content">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($sliders as $slide)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        @if(!empty($slide->name))
                                        {{ $slide->name }}
                                        @else
                                            {{ __('Null') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($slide->title))
                                            {{ $slide->title }}
                                        @else
                                            {{ __('Null') }}
                                        @endif

                                    </td>

                                    <td>
                                        <a data-toggle="modal" data-target="#sectionEdit{{ $slide->id }}" title="Click to view">
                                            <img src="{{ asset("Back/images/slider/".$slide->image) }}" height="90px" alt="slider-img">
                                        </a>
                                    </td>
                                    <td>
                                        @if(!@empty($slide->category->name))
                                        {{ $slide->category->name }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $slide->created_at->diffForHumans() }}
                                    </td>
                                    <td>
                                        @if($slide->status == 1)
                                            <a href="{{ route('slider_status',$slide->id) }}" title="Click To Hide" class="btn text-info">
                                                <i class="fas fa-arrow-up nav-icon"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('slider_status',$slide->id) }}" title="Click To Public" class="btn text-dark">
                                                <i class="fas fa-arrow-down nav-icon"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="" title="Delete" class="btn text-danger"
                                           onclick="event.preventDefault()
                                            if (confirm('Are you really want to delete this?')){
                                            document.getElementById('slide-del{{ $slide->id }}').submit();
                                            }">
                                            <i class="fas fa-trash nav-icon"></i>
                                            <form method="post" action="{{ route('slider.destroy',$slide->id) }}" id="{{ 'slide-del'.$slide->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </a>

                                        <a href="{{ route('slider.edit',$slide->id) }}" title="Change this" class="btn text-success">
                                            <i class="fas fa-edit nav-icon"></i>
                                        </a>


                                    </td>
                                </tr>

                                {{-- modal --}}

                                <div class="modal fade" id="sectionEdit{{ $slide->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Slider Photo</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{ asset("Back/images/slider/".$slide->image) }}" style="width: 90%;height: 90%;" alt="slider-img">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{--// modal --}}

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Title</th>

                                <th>Image</th>
                                <th>Category</th>
                                <th>Created Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
