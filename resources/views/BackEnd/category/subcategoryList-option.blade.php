<?php $dash.='-- '; ?>

@foreach($subcategories as $subcategory)
    <option value="{{$subcategory->id}}">{{$dash}}{{$subcategory->name}}</option>
    @if(count($subcategory->subCategories))
        @include('BackEnd.category.subcategoryList-option',['subcategories' => $subcategory->subCategories])
    @endif
@endforeach
