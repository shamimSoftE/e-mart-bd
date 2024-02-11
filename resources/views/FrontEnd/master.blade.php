<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google-site-verification" content="a1Sqz4Dw906hVrDN0OA6PpzmnsJJ1-IoGrXyO4sF5GA" />
    <title>{{ isset($info) ? $info->site_name : '' }} @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('Back/images/logo/appLogo/' . $info->app_logo) }}" type="image/x-icon">
    <meta name="keywords" content="emart-bd emart">
    <meta name="description" content="In the dynamic landscape of online shopping, e-commerce platforms strive to stand out by offering a diverse range of products to cater to the unique needs and preferences of their customers. One such player in the field is e-mart-bd.xyz, a burgeoning online marketplace that boasts an impressive catalog featuring 700 product collections, with a special emphasis on 150 unique offerings. A Glimpse into the Vast Product Collections: At the heart of e-mart-bd.xyz's success lies its extensive array of product collections. From electronics to fashion, home essentials to beauty products, the platform has curated a selection that spans a wide spectrum of consumer needs. The 700 product collections encompass an array of categories, ensuring that shoppers can find everything they need in one convenient place. Electronics Galore: Tech enthusiasts will find solace in the electronics section of e-mart-bd.xyz, where the latest gadgets and devices are readily available. Whether it's cutting-edge smartphones, state-of-the-art laptops, or innovative smart home devices, the platform's electronics collection leaves no stone unturned. Fashion-forward Choices: For fashionistas seeking the latest trends, e-mart-bd.xyz offers a diverse range of clothing and accessories. From casual wear to formal attire, the platform's fashion collection caters to all styles and preferences, ensuring that shoppers can express themselves through their wardrobe choices. Home Essentials and Lifestyle Products: The platform goes beyond just gadgets and clothing, with an expansive collection of home essentials and lifestyle products. From kitchen appliances to home decor, fitness equipment to outdoor gear, e-mart-bd.xyz is a one-stop-shop for individuals looking to enhance their living spaces and lifestyles. The 150 Unique Product Collections: What sets e-mart-bd.xyz apart is its commitment to offering not only quantity but also quality and uniqueness. The platform takes pride in its 150 unique product collections, which feature items not easily found elsewhere. These special collections are carefully curated to provide customers with distinctive options that reflect the platform's dedication to offering exclusive and standout products. Exclusive Deals and Special Discounts: In addition to its impressive product range, e-mart-bd.xyz sweetens the deal for its customers by regularly offering exclusive deals and special discounts. This commitment to providing value ensures that shoppers not only have access to a vast array of products but also enjoy cost-effective shopping experiences. User-Friendly Interface and Secure Transactions: Navigating e-mart-bd.xyz is a breeze, thanks to its user-friendly interface that allows customers to explore the extensive product catalog effortlessly. Moreover, the platform prioritizes the security of online transactions, implementing robust measures to protect customer data and ensure a safe shopping environment. Conclusion: E-mart-bd.xyz has emerged as a noteworthy player in the online shopping arena, offering a diverse and extensive range of products that cater to a wide array of consumer needs. With 700 product collections and a focus on 150 unique offerings, the platform stands out for its commitment to providing customers with both quantity and quality. As e-mart-bd.xyz continues to expand its offerings and enhance the online shopping experience, it remains a go-to destination for individuals seeking variety, exclusivity, and affordability in their online purchases. Developed by with us buddy team.">
    <meta name="author" content="p-themes">
    <!-- Favicon -->

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('Front') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('Front') }}/assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="{{ asset('Front') }}/assets/css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('Front') }}/assets/css/plugins/jquery.countdown.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('Front') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('Front') }}/assets/css/skins/skin-demo-13.css">
    <link rel="stylesheet" href="{{ asset('Front') }}/assets/css/demos/demo-13.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css"href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    @yield('style')

    {{-- <script>
        var Webflow = Webflow || [];
        Webflow.push(function() {

          // Load cookie library
          $.getScript('https://cdn.rawgit.com/js-cookie/js-cookie/v2.1.2/src/js.cookie.js', function() {

            // If cookie found (already shown)
            if(Cookies.get('notice') !== undefined) {

              // Hide cookie notice (change jQuery selector to match your own)
              $('.modal-wrapper').remove();
            }

            // On button click
            $('.modal-wrapper').click(function() {
              // Calculate when you want to display the notice again (change 15 to number of minutes you want)
              var expireTime = new Date(new Date().getTime() + 60000 * 60 * 24 * 60);
              // Set this cookie
              Cookies.set('notice', 'shown', { expires: expireTime });
            });
          });

        });
        </script> --}}

    <style>
         .text-content {
            max-height: 100px; /* Set the maximum height to determine when to hide content */
            overflow: hidden;
        }

        .text-content.expanded {
            max-height: none;
        }
        .read-more-link {
            display: block;
        }
    </style>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-WX97JCTC');</script>
    <!-- End Google Tag Manager -->

</head>

<style>
    .toast-info {
        background-color: #222222;
        color: #FFFFFF;
        font-size: 15px !important;
        background-image: none !important;
        /*Removes Pesky Default Toast Icon*/
        /* padding: 15px 15px 15px 15px !important;
        text-align:center; */
    }

    .toast-error {
        font-size: 15px !important;
    }

    .toast-sms {
        font-size: 15px !important;
        background-color: #000000;
    }

    .toast-warning {
        font-size: 13px !important;
    }

    .toast-success {
        font-size: 13px !important;
    }

    .input-form {
        background: #ffffff;
        border-radius: 7px;
        border-color: #bf8bb1;
    }

    .form-button {
        float: right;
        background: #db4db5;
        border: 1px;
        border-radius: 7px;
    }

    .form-button:hover {
        background: #d61da5;
    }

    .imgLol {
        transition: transform .2s;
    }

    .imgLol:hover {
        transform: scale(1.3);
    }

    .header-top a:hover,
    .header-top a:focus {
        /*color: #39f;*/
        color: black !important;
    }

    /*section*/
    .heading-left {
        border: 1px dashed #3399ffb0 !important;
        padding: 5px 10px !important;
    }

    .heading .title {
        color: #007bff;
    }

    /* product */
    .product {
        box-shadow: 0 0 5px 3px #007bff21;
        border: 1px solid #007bff21;
    }

    .new-price {
        color: #007bff !important;
    }

    .old-price {
        color: #7e7b7b !important;
    }

    /* top button */
    #scroll-top.show {
        background-color: #007bff;
        color: #fffff;
    }

    #scroll-top:hover,
    #scroll-top:focus {
        color: #fff;
        background-color: #042f5c;
    }

    .logo {
        margin: 0 !important;
    }

    .logo img {
        height: 85px !important;
    }
</style>

<body>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WX97JCTC"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->


    @include('FrontEnd.include.header')

    <div class="page-wrapper">

        @yield('content')

    </div>
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>
    @include('FrontEnd.include.footer')
    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div>
    <!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container mobile-menu-light">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>

            <form action="{{ route('search_item') }}" method="get" class="mobile-search">
                <label for="mobile-search" class="sr-only">Search Item</label>
                <input type="search" class="form-control" name="query" id="mobile-search"
                    placeholder="Search Item..." required>
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            </form>

            <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab"
                        role="tab" aria-controls="mobile-menu-tab" aria-selected="true">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="mobile-cats-link" data-toggle="tab" href="#mobile-cats-tab" role="tab"
                        aria-controls="mobile-cats-tab" aria-selected="false">Category</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel"
                    aria-labelledby="mobile-menu-link">
                    <nav class="mobile-nav">
                        <ul class="mobile-menu">
                            {{-- <li class="active">
                                <a href="{{ url('/') }}">Home</a>
                            </li> --}}

                            @foreach (App\Models\Category::where('status', 1)->where('parent_id', null)->get() as $cate)
                                <li>

                                    <a href="#" class="sf-with-ul">{{ $cate->name }}</a>
                                    @if (count($cate->subCategories))
                                        <ul>
                                            @foreach ($cate->subCategories as $childCate)
                                                <li><a
                                                        href="{{ route('category_wise', $childCate->id) }}">{{ $childCate->name }}</a>
                                                </li>
                                            @endforeach
                                            {{-- <li><a href="product-extended.html"><span>Extended Info<span class="tip tip-new">New</span></span></a></li> --}}
                                        </ul>
                                    @endif
                                </li>
                            @endforeach

                        </ul>
                    </nav><!-- End .mobile-nav -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                    <nav class="mobile-cats-nav">
                        <ul class="mobile-cats-menu">
                            {{-- <li><a class="mobile-cats-lead" href="#">Daily offers</a></li> --}}
                            @foreach (App\Models\Category::where('status', 1)->where('parent_id', null)->get() as $cate)
                                @if (count($cate->subCategories))
                                    @foreach ($cate->subCategories as $child)
                                        <li><a href="{{ route('category_wise', $child->id) }}">{{ $child->name }}</a>
                                        </li>
                                    @endforeach
                                @endif
                            @endforeach
                        </ul><!-- End .mobile-cats-menu -->
                    </nav><!-- End .mobile-cats-nav -->
                </div><!-- .End .tab-pane -->
            </div><!-- End .tab-content -->

            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank" title="Facebook"><i
                        class="icon-facebook-f"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Instagram"><i
                        class="icon-instagram"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Youtube"><i
                        class="icon-youtube"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->

    <!-- Sign in / Register Modal -->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill nav-border-anim" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin"
                                        role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register"
                                        role="tab" aria-controls="register" aria-selected="false">Register</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel"
                                    aria-labelledby="signin-tab">
                                    <form action="{{ route('customer_login') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label for="singin-email">Phone number or email address *</label>
                                            <input type="text" class="form-control" name="email" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="singin-password">Password *</label>
                                            <input type="password" class="form-control" id="singin-password"
                                                name="password" required>
                                        </div>

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>LOG IN</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="remember"
                                                    id="signin-remember">
                                                <label class="custom-control-label" for="signin-remember">Remember
                                                    Me</label>
                                            </div>

                                            {{-- <a href="javascript:void(0)" class="forgot-link">Forgot Your Password?</a> --}}
                                        </div>
                                    </form>

                                </div>

                                <div class="tab-pane fade" id="register" role="tabpanel"
                                    aria-labelledby="register-tab">
                                    <form action="{{ route('customer_register') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label for="register-email">Your Name *</label>
                                            <input type="text"
                                                class="form-control @error('name') is-invalid  @enderror"
                                                name="name" required>
                                        </div><!-- End .form-group -->
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="form-group">
                                            <label for="register-email">Your email address *</label>
                                            <input type="email"
                                                class="form-control @error('email') is-invalid  @enderror"
                                                name="email" required>
                                        </div><!-- End .form-group -->
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="form-group">
                                            <label for="register-password">Password *</label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid  @enderror"
                                                name="password" required>
                                        </div><!-- End .form-group -->
                                        @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="form-footer">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="agreement"
                                                    id="register-policy" required>
                                                <label class="custom-control-label" for="register-policy">I agree to
                                                    the <a href="#">privacy policy</a> *</label>
                                            </div><!-- End .custom-checkbox -->

                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>SIGN UP</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>
                                        </div><!-- End .form-footer -->
                                    </form>
                                    {{-- <div class="form-choice">
                                        <p class="text-center">or sign in with</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    Login With Google
                                                </a>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login  btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    Login With Facebook
                                                </a>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal -->


    <script>
        @if (Session::has('sms'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('sms') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>

    <!-- Messenger Chat plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "201026986425251");
        chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v19.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Plugins JS File -->
    <script src="{{ asset('Front') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('Front') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('Front') }}/assets/js/jquery.hoverIntent.min.js"></script>
    <script src="{{ asset('Front') }}/assets/js/jquery.waypoints.min.js"></script>
    <script src="{{ asset('Front') }}/assets/js/superfish.min.js"></script>
    <script src="{{ asset('Front') }}/assets/js/owl.carousel.min.js"></script>
    <script src="{{ asset('Front') }}/assets/js/bootstrap-input-spinner.js"></script>
    <script src="{{ asset('Front') }}/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('Front') }}/assets/js/jquery.plugin.min.js"></script>
    <script src="{{ asset('Front') }}/assets/js/jquery.countdown.min.js"></script>

    <!-- Main JS File -->
    <script src="{{ asset('Front') }}/assets/js/main.js"></script>
    <script src="{{ asset('Front') }}/assets/js/demos/demo-13.js"></script>
    @yield('script')

    <script>
        $(document).ready(function() {
            $(".read-more-link").click(function(e) {
                e.preventDefault();
                $(this).prev(".text-content").toggleClass("expanded");
                if ($(this).prev(".text-content").hasClass("expanded")) {
                    $(this).text("Show less");
                } else {
                    $(this).text("Read more");
                }
            });
        });
    </script>
</body>

</html>
