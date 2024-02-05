<footer class="footer footer-2" style="color: #fff; background: linear-gradient(358deg, #051628, #007bff)">
    <div class="footer-middle border-0">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <div class="widget widget-about">
                        <h3 class="text-white">{{ isset($info) ? $info->site_name : '' }}</h3>
                        <p class="text-content" style="color: #fff;">
                            {{ $info->site_about }}
                        </p>
                        <a class="read-more-link text-center" href="javascript:void(0)" style="margin-top: -25px; font-weight: 700;">Read more</a>

                    </div>
                </div>

                <div class="col-sm-4 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title" style="color: #fff;">Information</h4>

                        <ul class="widget-list">
                            <li><a href="{{ route('about') }}">About {{ isset($info) ? $info->site_name : '' }} </a></li>
                            <li><a href="{{ route('contact') }}">Contact us</a></li>
                            <li>
                                <a href="javascript:void(0)">Trade Licence :
                                   <strong>
                                       {{ isset($info) ? $info->trade_licence_no : '' }}
                                    </strong>
                                </a><br>
                                <a href="javascript:void(0)">Tin :
                                   <strong>
                                       {{ isset($info) ? $info->tin : '' }}
                                    </strong>
                                </a>
                            </li>
                        </ul><!-- End .widget-list -->
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-4 col-lg-3 -->

                <div class="col-sm-4 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title" style="color: #fff;">My Account</h4><!-- End .widget-title -->

                        <ul class="widget-list">
                            @auth
                                <li><a href="{{ route('customer_dashboard') }}">Dashboard</a></li>
                                @else
                                <li><a href="#signin-modal" data-toggle="modal">Sign in</a></li>
                            @endauth
                            <li><a href="{{ route('cart_item') }}">View Cart</a></li>
                            <li><a href="javascript:void(0)">E-cab: <strong>{{ isset($info) ? $info->e_cad_id : '' }} </strong></a></li>
                        </ul><!-- End .widget-list -->
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-64 col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .footer-middle -->

    <div class="footer-bottom">
        <div class="container">

            <p class="footer-copyright" style="color: #fff;">
                Copyright © {{ now()->year }} {{ isset($info) ? $info->site_name : '' }}.
                All Rights Reserved. Developed By
                <a href="javascript:void(0)">{{ isset($info) ? $info->developed_by : 'With Us Buddy' }}</a>

            </p><!-- End .footer-copyright -->

            <div class="social-icons social-icons-color">
                <span class="social-label">Follow Us On</span>

                @if(!empty($info->facebook_link))
                    <a href="{{ $info->facebook_link }}" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                @endif

                @if(!empty($info->twitter_link))
                    <a href="{{ $info->twitter_link }}" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                @endif

                @if(!empty($info->instagram_link))
                    <a href="{{ $info->instagram_link }}" class="social-icon social-instagram" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                @endif

                @if(!empty($info->youtube_link))
                    <a href="{{ $info->youtube_link }}" class="social-icon social-youtube" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                @endif
            </div><!-- End .soial-icons -->
        </div><!-- End .container -->
    </div><!-- End .footer-bottom -->
</footer><!-- End .footer -->
