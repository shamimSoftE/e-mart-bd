@extends('BackEnd.master')

@section('title')
    Sub Category List
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
                        <a class="btn btn-sm float-right mt-3 mr-4" href="{{ route('sub-category.create') }}">
                            <i class="fas fa-plus-circle"></i>Sub Category Add
                        </a>
                    </div>
                    <table id="zero-config" class="table dt-table-hover" style="width:100%">

                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            {{--<th>Image</th>--}}
                            <!--<th>Status</th>-->
                            <th class="no-content">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i = 1)

                        @foreach($categories as $category)
                            @if(!empty(count($category->subCategories)))
                                @foreach($category->subCategories as $subCates)
                                    <tr>

                                        <td>{{ $i++ }}</td>

                                        <td>
                                            {{ $category->name }}
                                        </td>
                                        <td>
                                            {{ $subCates->name }}
                                        </td>
                                        <!--<td>-->
                                        <!--    @if($subCates->status == '1')-->
                                        <!--        <ul class="form-inline">-->
                                        <!--            <li class="text-success"></li>-->
                                        <!--            Visible-->
                                        <!--        </ul>-->
                                        <!--    @else-->
                                        <!--        <ul class="form-inline">-->
                                        <!--            <li class="text-danger"></li>-->
                                        <!--            Hide-->
                                        <!--        </ul>-->
                                        <!--    @endif-->
                                        <!--</td>-->
                                        <td>
                                            <a class="btn" onclick="event.preventDefault();
                                                if(confirm('Are you really want to delete?')){
                                                document.getElementById('category-delete-{{ $subCates->id }}').submit()
                                                }">
                                                <span class="fas fa-trash text-danger" title="Destroy"></span>
                                                <form method="post" action="{{ route('sub-category.destroy',$subCates->id) }}" id="{{ 'category-delete-'.$subCates->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </a>

                                            <!--@if($subCates->status == 1)-->
                                            <!--    <a class="btn text-success" href="{{ route('category_inactive',$subCates->id) }}">-->
                                            <!--        <i class="fas fa-arrow-up"></i>-->
                                            <!--    </a>-->
                                            <!--@else-->
                                            <!--    <a class="btn text-danger" href="{{ route('category_active',$subCates->id) }}">-->
                                            <!--        <i class="fas fa-arrow-down"></i>-->
                                            <!--    </a>-->
                                            <!--@endif-->
                                            <a class="btn" href="{{ route('sub-category.edit',$subCates->id) }}">
                                                <i class="fas fa-pencil-alt" title="Edit"></i>
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            @endif
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <!--<th>Status</th>-->
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>

    </div>

@endsection

