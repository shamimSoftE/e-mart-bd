@extends('BackEnd.master')

@section('title')
    Color List
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
                        <a class="btn btn-sm float-right mt-4 mr-4" href="{{ route('color.create') }}">
                            <i class="fas fa-plus-circle"></i> Color Add
                        </a>
                    </div>
                    <table id="zero-config" class="table dt-table-hover" style="width:100%">

                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th class="no-content">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($colors as $color)
                            <tr>

                                <td>{{ $color->id }}</td>
                                <td>{{ $color->name }}</td>
                                <td>
                                    @if($color->status == '1')
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
                                        document.getElementById('color-delete-{{ $color->id }}').submit()
                                        }">
                                        <span class="fas fa-trash text-danger" title="Destroy"></span>
                                        <form method="post" action="{{ route('color.destroy',$color->id) }}" id="{{ 'color-delete-'.$color->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </a>

                                    {{-- @if($color->status == 1)
                                        <a class="btn btn-sm text-success" href="">
                                            <i class="fas fa-arrow-up"></i>
                                        </a>
                                    @else
                                        <a class="btn btn-sm text-danger" href="{{ route('color_show',$color->id) }}">
                                            <i class="fas fa-arrow-down"></i>
                                        </a>
                                    @endif --}}
                                    <a class="btn" data-toggle="modal" data-target="#colorEdit{{ $color->id }}">
                                        <i class="fas fa-pencil-alt" title="Edit"></i>
                                    </a>
                                </td>
                                {{-- modal --}}

                                <div class="modal fade" id="colorEdit{{ $color->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">color Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('color.update',$color) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="hidden" name="id" value="{{ $color->id }}">
                                                        <input type="text" class="form-control" id="name" name="name" value="{{ $color->name }}">
                                                    </div>

                                                    <button type="submit" class="btn btn-sm btn-primary float-right">Update</button>
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
                            <th>ID</th>
                            <th>Name</th>
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

