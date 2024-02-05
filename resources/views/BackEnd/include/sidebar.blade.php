<div class="sidebar-wrapper sidebar-theme" >

    <nav id="sidebar">
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">

            @if(auth()->user()->status == 1 )
                @php
                    $prefix = Request::route()->getPrefix();
                    $route = Route::current()->getName();
                @endphp

                <li class="menu" title="This is Category">
                    <a href="#app" data-toggle="collapse" data-active="" aria-expanded="{{ ($prefix == '/parent') ? 'true' : 'false' }}" class="{{ ($prefix == '/parent') ? 'dropdown-toggle' : 'dropdown-toggle collapsed' }}">
                        <div class="">
                            <span >Category</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="{{ ($route == 'category_parent') ? 'submenu list-unstyled collapse show' : 'collapse submenu list-unstyled' }}" id="app" data-parent="#accordionExample">
                        <li>
                            <a href="{{ route('category_parent') }}" > List </a>
                        </li>
                    </ul>
                </li>

                <li class="menu" title="This is Category">
                    <a href="#subCate" data-toggle="collapse" data-active="" aria-expanded="{{ ($prefix == '/sub-category') ? 'true' : 'false' }}" class="{{ ($prefix == '/sub-category') ? 'dropdown-toggle' : 'dropdown-toggle collapsed' }}">
                        <div class="">
                            <span >Sub-Category</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="{{ ($route == 'sub-category.index') ? 'submenu list-unstyled collapse show' : 'collapse submenu list-unstyled' }}" id="subCate" data-parent="#accordionExample">
                        <li>
                            <a href="{{ route('sub-category.index') }}"  > List </a>
                        </li>
                    </ul>
                </li>

                <li class="menu" title="You can create/show Section here">
                    <a href="#sec" data-toggle="collapse" data-active="" aria-expanded="{{ ($prefix == '/section') ? 'true' : 'false' }}" class="{{ ($prefix == '/section') ? 'dropdown-toggle' : 'dropdown-toggle collapsed' }}">
                        <div class="">
                            <span>Section</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="{{ ($route == 'section.index') ? 'submenu list-unstyled collapse show' : 'collapse submenu list-unstyled' }}" id="sec" data-parent="#accordionExample">
                        <li>
                            <a href="{{ route('section.index') }}" > Section List</a>
                        </li>

                    </ul>
                </li>


                <li class="menu" title="You can create/show slider here">
                    <a href="#slider" data-toggle="collapse" data-active="" aria-expanded="{{ ($prefix == '/slider') ? 'true' : 'false' }}" class="{{ ($prefix == '/slider') ? 'dropdown-toggle' : 'dropdown-toggle collapsed' }}">
                        <div class="">
                            <span >Slider</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="{{ ($route == 'slider.index') ? 'submenu list-unstyled collapse show' : 'collapse submenu list-unstyled' }}" id="slider" data-parent="#accordionExample">
                        <li>
                            <a href="{{ route('slider.index') }}" > Slider List</a>
                        </li>
                    </ul>
                </li>

                <li class="menu" title="You can create/show Brand here">
                    <a href="#bra" data-toggle="collapse" data-active="" aria-expanded="{{ ($prefix == '/brand') ? 'true' : 'false' }}" class="{{ ($prefix == '/brand') ? 'dropdown-toggle' : 'dropdown-toggle collapsed' }}">
                        <div class="">
                            <span >Brand</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="{{ ($route == 'brand.index') ? 'submenu list-unstyled collapse show' : 'collapse submenu list-unstyled' }}" id="bra" data-parent="#accordionExample">
                        <li>
                            <a href="{{ route('brand.index') }}" > Brand List</a>
                        </li>

                    </ul>
                </li>

                <li class="menu" title="You can create/show Color here">
                    <a href="#color" data-toggle="collapse" data-active="" aria-expanded="{{ ($prefix == '/color') ? 'true' : 'false' }}" class="{{ ($prefix == '/color') ? 'dropdown-toggle' : 'dropdown-toggle collapsed' }}">
                        <div class="">
                            <span >Color</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="{{ ($route == 'color.index') ? 'submenu list-unstyled collapse show' : 'collapse submenu list-unstyled' }}" id="color" data-parent="#accordionExample">
                        <li>
                            <a href="{{ route('color.index') }}" > Color List</a>
                        </li>

                    </ul>
                </li>

                <li class="menu" title="You can create/show banner here">
                    <a href="#banner" data-toggle="collapse" data-active="" aria-expanded="{{ ($prefix == '/banner') ? 'true' : 'false' }}" class="{{ ($prefix == '/banner') ? 'dropdown-toggle' : 'dropdown-toggle collapsed' }}">
                        <div class="">
                            <span >Banner</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="{{ ($route == 'banner.index') ? 'submenu list-unstyled collapse show' : 'collapse submenu list-unstyled' }}" id="banner" data-parent="#accordionExample">
                        <li>
                            <a href="{{ route('banner.index') }}" > List </a>
                        </li>

                    </ul>
                </li>


                <li class="menu" title="You can create/show Product here">
                    <a href="#product" data-toggle="collapse" data-active="" aria-expanded="{{ ($prefix == '/product') ? 'true' : 'false' }}" class="{{ ($prefix == '/product') ? 'dropdown-toggle' : 'dropdown-toggle collapsed' }}">
                        <div class="">
                            <span >Product</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="{{ ($route == 'product.index') ? 'submenu list-unstyled collapse show' : 'collapse submenu list-unstyled' }}" id="product" data-parent="#accordionExample">
                        <li>
                            <a href="{{ route('product.index') }}" > Product List</a>
                        </li>

                    </ul>
                </li>

                <li class="menu" title="You can manage siteInfo here">
                    <a href="#charge" data-toggle="collapse" data-active="" aria-expanded="" class="dropdown-toggle">
                        <div class="">
                            <span >Shipping Charge</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="charge" data-parent="#accordionExample">
                        <li>
                            <a href="{{ route('charge.index') }}" >Charge List</a>
                        </li>

                    </ul>
                </li>

                 <li class="menu" title="You can manage order here">
                    <a href="#order" data-toggle="collapse" data-active="" aria-expanded="{{ ($prefix == '/order') ? 'true' : 'false' }}" class="{{ ($prefix == '/order') ? 'dropdown-toggle' : 'dropdown-toggle collapsed' }}">
                        <div class="">
                            <span >Order</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="{{ ($route == 'order_list') ? 'submenu list-unstyled collapse show' : 'collapse submenu list-unstyled' }}" id="order" data-parent="#accordionExample">
                        <li>
                            <a href="{{ route('order_today') }}"  > Todays List</a>
                        </li>
                        <li>
                            <a href="{{ route('order_list') }}" > Total List</a>
                        </li>
                        <li>
                            <a href="{{ route('order_cancel') }}" > Cancel List</a>
                        </li>
                    </ul>
                </li>



                <li class="menu" title="You can manage contact messsage here">
                    <a href="#conSMS" data-toggle="collapse" data-active="" aria-expanded="{{ ($prefix == '/contactSMS') ? 'true' : 'false' }}" class="{{ ($prefix == '/contactSMS') ? 'dropdown-toggle' : 'dropdown-toggle collapsed' }}">
                        <div class="">
                            <span >Contact Message</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="{{ ($route == 'con_SMS') ? 'submenu list-unstyled collapse show' : 'collapse submenu list-unstyled' }}" id="conSMS" data-parent="#accordionExample">
                        <li>
                            <a href="{{ route('con_SMS') }}" >Message List </a>
                        </li>

                    </ul>
                </li>



                <li class="menu" title="You can manage siteInfo here">
                    <a href="#siteInfo" data-toggle="collapse" data-active="" aria-expanded="{{ ($prefix == '/site') ? 'true' : 'false' }}" class="{{ ($prefix == '/site') ? 'dropdown-toggle' : 'dropdown-toggle collapsed' }}">
                        <div class="">
                            <span >Settings</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="{{ ($route == 'site.index') ? 'submenu list-unstyled collapse show' : 'collapse submenu list-unstyled' }}" id="siteInfo" data-parent="#accordionExample">
                        <li>
                            <a href="{{ route('site.index') }}" >Site Settings</a>
                        </li>
                        <li>
                            <a href="{{ route('AddEdit') }}" >About Page</a>
                        </li>
                        <li>
                            <a href="{{ route('conAddEdit') }}" >Contact Page</a>
                        </li>
                    </ul>
                </li>

            @else

            @endif


        </ul>

    </nav>

</div>
