@extends('BackEnd.master')

@section('title')
    Shipping Charge List
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
                        <a class="btn btn-sm float-right mt-4 mr-4" href="{{ route('charge.create') }}">
                            <i class="fas fa-plus-circle"></i> Shipping Charge Add
                        </a>
                    </div>
                    <table id="zero-config" class="table dt-table-hover" style="width:100%">

                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>City</th>
                            <th>Charge</th>
                            <th>Status</th>
                            <th class="no-content">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($charges as $key => $charge)
                            <tr>

                                <td>{{ $key }}</td>
                                <td>{{ $charge->city }}</td>
                                <td>TK.{{ $charge->charge }}</td>
                                <td>
                                    @if($charge->status == 1)
                                        <a class="btn btn-sm text-success" href="{{ route('charge_status',$charge->id) }}">
                                            <i class="fas fa-arrow-up"></i>
                                        </a>
                                    @else
                                        <a class="btn btn-sm text-danger" href="{{ route('charge_status',$charge->id) }}">
                                            <i class="fas fa-arrow-down"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn" onclick="event.preventDefault();
                                        if(confirm('Are you really want to delete?')){
                                        document.getElementById('charge-delete-{{ $charge->id }}').submit()
                                        }">
                                        <span class="fas fa-trash text-danger" title="Destroy"></span>
                                        <form method="post" action="{{ route('charge.destroy',$charge->id) }}" id="{{ 'charge-delete-'.$charge->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </a>


                                    <a class="btn" data-toggle="modal" data-target="#chargeEdit{{ $charge->id }}">
                                        <i class="fas fa-pencil-alt" title="Edit"></i>
                                    </a>
                                </td>
                                {{-- modal --}}

                                <div class="modal fade" id="chargeEdit{{ $charge->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">charge Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('charge.update',$charge->id) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label>City</label>
                                                                {{-- <input type="hidden" name="id"  value="{{ $charge->id }}"> --}}
                                                                <input type="text" class="form-control" name="city"  value="{{ $charge->city }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label>Charge</label>
                                                                <input type="text" class="form-control" name="charge"  value="{{ $charge->charge }}">
                                                            </div>
                                                        </div>
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
                            <th>SL</th>
                            <th>City</th>
                            <th>Charge</th>
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

