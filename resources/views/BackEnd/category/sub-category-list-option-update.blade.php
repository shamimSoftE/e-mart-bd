<?php $dash.='-- '; ?>
@foreach($subcategories as $subcategory)
    @if($cate->id != $subcategory->id )
        <option value="{{$subcategory->id}}" @if($cate->parent_id == $subcategory->id ) selected @endif >
            {{$dash}}{{$subcategory->name}}
        </option>
    @endif
    @if(count($subcategory->subcategory))
        @include('BackEnd.category.sub-category-list-option-update',['subcategories' => $subcategory->subcategory])
    @endif
@endforeach
