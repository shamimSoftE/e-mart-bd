<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">

        <ul class="navbar-item theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="{{ route('dashboard') }}" style="font-size: 27px;text-transform: uppercase;color: white;">
                    {{ isset($site) ? $site->site_name : '' }}
                </a>

            </li>
            <li class="nav-item theme-text">
                <a href="{{ route('dashboard') }}" class="nav-link"> </a>
            </li>
        </ul>

        {{--<ul class="navbar-item flex-row ml-md-0 ml-auto">
            <li class="nav-item align-self-center search-animated">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search toggle-search">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <form class="form-inline search-full form-inline search" role="search">
                    <div class="search-bar">
                        <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Search...">
                    </div>
                </form>
            </li>
        </ul>--}}

        <ul class="navbar-item flex-row ml-md-auto">

            <li class="nav-item dropdown message-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="messageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </a>

            </li>
            @php
                $user = auth()->user();
            @endphp

            <li class="nav-item dropdown user-profile-dropdown">
                @if(!empty($user->avatar))
                        <a href="javascript:void(0);" style="color: white" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                {{ auth()->user()->name }}
                            <img src="{{ asset("Back/images/admin/".$user->avatar) }}" alt="avatar" style="height: 40px; width: 40px;border-radius:50%;">
                        </a>
                    @else
                    <a href="javascript:void(0);" style="color: white" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        {{ auth()->user()->name }}
                        <img src="{{ asset('/Back') }}/images/logo/admin.png" alt="avatar" style="height: 40px; width: auto">
                    </a>
                @endif
                <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                    <div class="">
                        <div class="dropdown-item">
                            <a class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                     class="feather feather-user">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle></svg>
                                {{ auth()->user()->name }}
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a class="" href="{{ url('profile-view',$user->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                Profile
                            </a>
                        </div>

                        <div class="dropdown-item">
                            <a class="" href="{{ route('admin_create') }}">
                                <i class="fas fa-plus"></i>
                                Create Admin
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                Sign Out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </li>

        </ul>
    </header>
</div>
