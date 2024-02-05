@extends('BackEnd.master')

@section('title')
    Affliate Product List
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
                         <a class="btn btn-sm float-right mt-3 mr-4" href="{{ route('product.create') }}">
                            <i class="fas fa-plus-circle"></i> Product Add
                        </a>

                    </div>
                    <table id="zero-config" class="table dt-table-hover" style="width:100%">

                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Regular Price</th>
                            <th>Special Price</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Section</th>
                            <th>Status</th>
                            <th class="no-content">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($products as $key=> $pro)
                            <?php
                                $photos = json_decode($pro->image)
                            ?>
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $pro->name }}</td>
                                <td>{{ $pro->quantity }}</td>
                                <td>
                                    ৳.
                                    @if (isset($pro->regular_price))
                                        {{ $pro->regular_price }}
                                        @else
                                        00.00
                                    @endif

                                </td>
                                <td>
                                    ৳.
                                    @if (isset($pro->special_price))
                                    {{ $pro->special_price }}
                                    @else
                                    00.00
                                @endif

                                </td>
                                <td>
                                    @foreach ($photos as $key => $item)
                                        @if ($key == 0)
                                            <a data-toggle="modal" data-target="#viewImage{{ $pro->id }}" title="Click to view">
                                                <img style="height:30px;" src="{{asset('Back/images/product/'.$item)}}" alt="nai">
                                            </a>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @if (!empty($pro->category->name))
                                        {{ $pro->category->name }}
                                    @endif
                                </td>
                                <td>

                                    @if(!empty($pro['section_id']))

                                        <ul class="form-inline">
                                            @foreach(App\Models\Section::where('status',1)->get() as $cont)

                                                @if(in_array($cont->id, json_decode($pro['section_id'], TRUE)))
                                                    <li>
                                                        {{ $cont->title }}
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @else
                                        <ul class="form-inline">
                                            <li>
                                                N/A
                                            </li>
                                        </ul>
                                    @endif
                                </td>
                                <td>
                                    @if($pro->status == 1)
                                        <a class="btn text-success" href="{{ route('pro_status',$pro->id) }}">
                                            <i class="fas fa-arrow-up"></i>
                                        </a>
                                    @else
                                        <a class="btn text-danger" href="{{ route('pro_status',$pro->id) }}">
                                            <i class="fas fa-arrow-down"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn" onclick="event.preventDefault();
                                        if(confirm('Are you really want to delete?')){
                                        document.getElementById('product-delete-{{ $pro->id }}').submit()
                                        }">
                                        <span class="fas fa-trash text-danger" title="Destroy"></span>
                                        <form method="post" action="{{ route('product.destroy',$pro->id) }}" id="{{ 'product-delete-'.$pro->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </a>

                                    <a class="btn" href="{{ route('product.edit',$pro->id) }}" >
                                        <i class="fas fa-pencil-alt" title="Edit"></i>
                                    </a>
                                </td>

                                {{-- modal --}}
                                <div class="modal fade" id="viewImage{{ $pro->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">{{ $pro->name }} Pohots</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body d-flex justify-content-center">
                                                @foreach ($photos as $key => $item)
                                                    <img style="height:150px; padding:10px;" src="{{asset('Back/images/product/'.$item)}}" alt="nai">
                                                @endforeach
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
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Regular Price</th>
                            <th>Special Price</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Section</th>
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

