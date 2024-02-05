@extends('BackEnd.master')

@section('title')
    Contact-SMS-List
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
                        <h3 style="margin: 10px 0 0 15px;">Message List</h3>
                    </div>
                    <table id="zero-config" class="table dt-table-hover" style="width:100%">

                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th class="no-content">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i = 1)
                        @foreach($conSMS as $sms)
                            <tr>

                                <td>{{ $i++ }}</td>
                                <td>{{ $sms->name }}</td>
                                <td>{{ $sms->email }}</td>
                                <td>{{ $sms->phone_number }}</td>

                                <td>
                                    <a title="Click To Read More" data-toggle="modal" data-target="#sms{{ $sms->id }}"
                                        style="background:black;color: white ">
                                        {{ Str::words($sms->sms, 5) }}
                                    </a>
                                </td>
                                <td>
                                    {{ $sms->created_at->diffForHumans() }}
                                </td>

                                <td>
                                    <a class="btn" onclick="event.preventDefault();
                                        if(confirm('Are you really want to delete?')){
                                        document.getElementById('sms-delete-{{ $sms->id }}').submit()
                                        }">
                                        <span class="fas fa-trash text-danger" title="Destroy"></span>
                                        <form method="post" action="{{ route('sms_delete',$sms->id) }}" id="{{ 'sms-delete-'.$sms->id }}">
                                            @csrf
                                            {{-- @method('DELETE') --}}
                                        </form>
                                    </a>
                                </td>

                                {{-- modal --}}
                                <div class="modal fade" id="sms{{ $sms->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">{{ $sms->subject }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    {{ $sms->sms }}
                                                </p>
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
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Phone</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>

    </div>

@endsection

