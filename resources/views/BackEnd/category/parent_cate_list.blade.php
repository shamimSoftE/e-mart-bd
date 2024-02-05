@extends('BackEnd.master')

@section('title')
    Category List
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
                        <a class="btn btn-sm float-right mt-3 mr-4" data-toggle="modal" data-target="#parentCateAdd">
                            <i class="fas fa-plus-circle"></i> Category Add
                        </a>
                    </div>


                    {{-- modal add --}}

                    <div class="modal fade" id="parentCateAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Category Add</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('parent_cate_store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                                            @error('name')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Image</label>
                                            <input type="file" accept="image/*" class="form-control @error('category_img') is-invalid @enderror" name="category_img">
                                            @error('category_img')
                                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary float-right">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--end modal add --}}


                    <table id="zero-config" class="table dt-table-hover" style="width:100%">

                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Menu Category</th>
                            <th class="no-content">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i = 1)

                        @foreach($categories as $category)

                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    {{ $category->name }}
                                </td>
                                <td>
                                    @if(isset($category->category_img))
                                        <img src="{{ asset('Back/images/category/'.$category->category_img )}}" style="height: 40px;" alt="">
                                    @endif
                                </td>

                                <td>
                                    @if($category->status == '1')
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
                                <?php
                                    $cateData = [
                                        'id' => $category->id,
                                        'menu_cate' => $category->menu_cate,
                                        ];
                                ?>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" onclick="makeMenuCate({{ json_encode($cateData) }})" id="top_category_{{ $category->id }}"
                                        @if($category->menu_cate == 1) checked @endif >
                                        <label class="custom-control-label" for="top_category_{{ $category->id }}">Add Menu</label>
                                    </div>
                                </td>
                                <td>
                                    <a class="btn" onclick="event.preventDefault();
                                        if(confirm('Are you really want to delete?')){
                                        document.getElementById('category-delete-{{ $category->id }}').submit()
                                        }">
                                        <span class="fas fa-trash text-danger" title="Destroy"></span>
                                        <form method="post" action="{{ route('parent_cate_destroy',$category->id) }}" id="{{ 'category-delete-'.$category->id }}">
                                            @csrf
                                            @method('HEAD')
                                        </form>
                                    </a>

                                    @if($category->status == 1)
                                        <a class="btn text-success" href="{{ route('parent_status',$category->id) }}">
                                            <i class="fas fa-arrow-up"></i>
                                        </a>
                                    @else
                                        <a class="btn text-danger" href="{{ route('parent_status',$category->id) }}">
                                            <i class="fas fa-arrow-down"></i>
                                        </a>
                                    @endif
                                    <a class="btn" data-toggle="modal" data-target="#parentCateEdit{{ $category->id }}">
                                        <i class="fas fa-pencil-alt" title="Edit"></i>
                                    </a>
                                </td>
                            </tr>


                            {{-- modal --}}

                            <div class="modal fade" id="parentCateEdit{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Category Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('parent_cate_update',$category) }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('POST')
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="hidden" name="id" value="{{ $category->id }}">
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="name">Image</label>
                                                            <input type="file" accept="image/*" class="form-control @error('category_img') is-invalid @enderror" name="category_img">
                                                            @error('category_img')
                                                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group mt-4">
                                                            <label for="name">Preview</label>
                                                            <img src="{{ asset('Back/images/category/'.$category->category_img )}}" style="height: 50px;" alt="">
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

                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Category</th>
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

@section('script')
    <script>
        function makeMenuCate(data)
        {
            let id = data.id;
            let menu_cate = data.menu_cate;
            $.ajax({
                url: '/meke_menu_cate',
                type: "GET",
                data: {
                    id: id,
                    menu_cate: menu_cate,
                },
                success: function(res) {
                    if (res.sms) {
                        alert(res.sms);
                    }
                }
            });
        }
    </script>
@endsection

