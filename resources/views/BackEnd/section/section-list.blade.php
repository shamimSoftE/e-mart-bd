@extends('BackEnd.master')

@section('title')
    Section List
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
                        <a class="btn btn-sm float-right mt-3 mr-4" href="{{ route('section.create') }}">
                           <i class="fas fa-plus-circle"></i> Section Add
                        </a>
                    </div>
                    <table id="zero-config" class="table dt-table-hover" style="width:100%">

                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Title</th>
                           {{-- <th>Commission</th>--}}
                            <th>Status</th>
                            <th class="no-content">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach($sections as $section)
                                <tr>

                                    <td>{{ $i++ }}</td>
                                    <td>{{ $section->title }}</td>
{{--                                    <td>{{ $section->commission }} <b>%</b></td>--}}
                                    <td>
                                        @if($section->status == 1)
                                            <a class="btn btn-sm text-success" href="{{ route('section_status',$section->id) }}" title="Active">
                                                <i class="fas fa-arrow-up"></i>
                                            </a>
                                        @else
                                            <a class="btn btn-sm text-danger" href="{{ route('section_status',$section->id) }}" title="Hide">
                                                <i class="fas fa-arrow-down"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn" onclick="event.preventDefault();
                                            if(confirm('Are you really want to delete?')){
                                            document.getElementById('con-delete-{{ $section->id }}').submit()
                                            }">
                                            <span class="fas fa-trash text-danger" title="Destroy"></span>
                                            <form method="post" action="{{ route('section.destroy',$section->id) }}" id="{{ 'con-delete-'.$section->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </a>

                                        <a class="btn" data-toggle="modal" data-target="#contentEdit{{ $section->id }}">
                                            <i class="fas fa-pencil-alt" title="Edit"></i>
                                        </a>
                                    </td>
                                    {{-- modal --}}

                                    <div class="modal fade" id="contentEdit{{ $section->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Content Edit</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('section.update',$section) }}" method="post">
                                                        @csrf
                                                        @method('PUT')

                                                            <input type="number" class="form-control" name="id" value="{{ $section->id }}" hidden readonly>


                                                        <div class="form-group mb-3">
                                                            <label for="name">Section Name</label>
                                                            <input type="text" class="form-control" name="title"  placeholder="Section Name" value="{{ $section->title }}">
                                                        </div>

                                                       {{-- <label for="name">Commission<sup style="color:red;">(by %)</sup></label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" min="0" max="99" value="{{ $section->commission }}" class="form-control @error('model_name') is-invalid @enderror" placeholder="commission" aria-label="commission" aria-describedby="commission" name="commission">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text" id="commission">%</span>
                                                            </div>
                                                            @error('model_name')
                                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                            @enderror
                                                        </div>--}}

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
                            <th>Sl</th>
                            <th>Title</th>
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

