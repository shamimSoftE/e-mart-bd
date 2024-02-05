@extends('FrontEnd.master')

@section('title', 'Contact US')

@section('content')

<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact us</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="container">
        <div class="page-header page-header-big text-center" style="background-image: url('{{ asset('Back/images/contact/'.$contact->image) }}')">
            {{-- <h1 class="page-title text-white">Contact us<span class="text-white">keep in touch with us</span></h1> --}}
        </div><!-- End .page-header -->
    </div><!-- End .container -->

    <div class="page-content pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-2 mb-lg-0">
                    {{-- <h2 class="title mb-1">Contact Information</h2><!-- End .title mb-2 -->
                    <p class="mb-3">Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui,
                        eu pulvinar nunc sapien ornare nisl. Phasellus pede arcu, dapibus eu, fermentum et, dapibus sed, urna.
                    </p> --}}
                    {!! $contact->contact_info !!}
                    <div class="row">
                        <div class="col-12">
                            <div class="contact-info">
                                <h3>The Office</h3>

                                <ul class="contact-list">
                                    <li>
                                        <i class="icon-map-marker"></i>
                                        @if (!empty($siteInfo->address))
                                        {{ $siteInfo->address }}
                                        @else
                                        70 Washington Square South New York, NY 10012, United States
                                        @endif

                                    </li>
                                    <li>
                                        <i class="icon-phone"></i>
                                        @if (!empty($siteInfo->contact_number))
                                        <a href="tel:{{ $siteInfo->contact_number }}">{{ $siteInfo->contact_number }}</a>
                                        @else
                                        <a href="tel:#">+92 423 567</a>
                                        @endif

                                    </li>
                                    <li>
                                        <i class="icon-envelope"></i>
                                        @if (!empty($siteInfo->email))
                                        <a href="mailto:{{ $siteInfo->email }}">{{ $siteInfo->email }}</a>
                                        @else
                                        <a href="mailto:#">info@xyz.com</a>
                                        @endif
                                    </li>
                                </ul><!-- End .contact-list -->
                            </div><!-- End .contact-info -->
                        </div><!-- End .col-sm-7 -->

                        {{-- <div class="col-sm-5">
                            <div class="contact-info">
                                <h3>The Office</h3>

                                <ul class="contact-list">
                                    <li>
                                        <i class="icon-clock-o"></i>
                                        <span class="text-dark">Monday-Saturday</span> <br>11am-7pm ET
                                    </li>
                                    <li>
                                        <i class="icon-calendar"></i>
                                        <span class="text-dark">Sunday</span> <br>11am-6pm ET
                                    </li>
                                </ul><!-- End .contact-list -->
                            </div><!-- End .contact-info -->
                        </div><!-- End .col-sm-5 --> --}}
                    </div><!-- End .row -->
                </div><!-- End .col-lg-6 -->
                <div class="col-lg-6">
                    {{-- <h2 class="title mb-1">Got Any Questions?</h2><!-- End .title mb-2 -->
                    <p class="mb-2">Use the form below to get in touch with the sales team</p> --}}
                    {!! $contact->con_form_sms !!}

                    <form action="{{ route('contact_sms') }}" method="POST" class="contact-form mb-3">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="cname" class="sr-only">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name')}}" placeholder="Name *" required>
                            </div><!-- End .col-sm-6 -->

                            <div class="col-sm-6">
                                <label for="cemail" class="sr-only">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email')}}" placeholder="Email *" required>
                            </div><!-- End .col-sm-6 -->
                        </div><!-- End .row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="cphone" class="sr-only">Phone</label>
                                <input type="tel" class="form-control" name="phone_number" value="{{ old('phone_number')}}" placeholder="Phone *" required>
                            </div><!-- End .col-sm-6 -->

                            <div class="col-sm-6">
                                <label for="csubject" class="sr-only">Subject</label>
                                <input type="text" class="form-control" name="subject" value="{{ old('subject')}}" placeholder="Subject *" required>
                            </div><!-- End .col-sm-6 -->
                        </div><!-- End .row -->

                        <label for="cmessage" class="sr-only">Message</label>
                        <textarea class="form-control" cols="30" rows="4" name="sms" required placeholder="Message *">{{ old('sms') }}</textarea>

                        <button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                            <span>SUBMIT</span>
                            <i class="icon-long-arrow-right"></i>
                        </button>
                    </form><!-- End .contact-form -->
                </div><!-- End .col-lg-6 -->
            </div><!-- End .row -->

            <hr class="mt-4 mb-5">

        </div><!-- End .container -->
        <div class="col-sm-12 col-md-12 col-lg-12">
            <iframe src="{{ $contact->map_link }}"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div><!-- End #map -->
    </div><!-- End .page-content -->

</main><!-- End .main -->

@endsection
