<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ish Tap</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('ishtap/img/logo/logo_title.png')}}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset('ishtap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('ishtap/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('ishtap/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('ishtap/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('ishtap/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('ishtap/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('ishtap/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('ishtap/css/gijgo.css')}}">
    <link rel="stylesheet" href="{{asset('ishtap/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('ishtap/css/slicknav.css')}}">

    <link rel="stylesheet" href="{{asset('ishtap/css/style.css')}}">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
            <!-- SwetAlert -->
    <link rel="stylesheet" href="{{asset('sweetalert/sweetalert2.css')}}">
    <link rel="stylesheet" href="{{asset('sweetalert/sweetalert2.min.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>
    
    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid ">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-2">
                                <div class="logo">
                                    <a href="{{route('index')}}">
                                        <img style="width: 175px" src="{{asset('ishtap/img/logo/logo.png')}}" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-7">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a style="font-size: 85%" href="{{ route('index') }}">Ana Səhifə</a></li>
                                            <li><a style="font-size: 85%" href="{{ route('vakansiyalar') }}">Vakansiyalar</a></li>
                                            <li><a style="font-size: 85%" href="{{ route('mutexessisler') }}">Mütəxəssis tap</a></li>
                                            <li><a style="font-size: 85%" href="{{ route('haqqimizda') }}">Haqqımızda</a></li>
                                            <li><a style="font-size: 85%" href="{{ route('elaqe') }}">Əlaqə</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 d-none d-lg-block">
                                <div class="Appointment">
                                    @if (!auth()->check())
                                        <div class="phone_num d-none d-xl-block">
                                            <a href="{{ route('login.index') }}">Daxil Ol</a>
                                        </div>
                                        <div class="phone_num d-none d-xl-block">
                                            <a href="{{ route('signup.index') }}">Qeydiyyat</a>
                                        </div>  
                                        <div class="d-none d-lg-block">
                                            <a class="boxed-btn3" href="{{ route('login.index') }}">Elan Yerləşdirin</a>
                                        </div>  
                                    @else 
                                    <div class="dropdown" >
                                        <a  class="btn btn-default dropdown-toggle" id="menu1" data-toggle="dropdown">
                                             <img  style="width: 40px;height:40px;border-radius:20px" @if(auth()->user()->img!=null) src="{{ asset(auth()->user()->img) }}" @else src="{{ asset('ishtap/img/user_img/default_img.png') }}" @endif title="{{ auth()->user()->name }}">
                                           <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                          <li role="presentation"><a class="dropdown-item"  role="menuitem" tabindex="-1" href="{{ route('profil.index') }}"><i class="fas fa-user-circle"></i> Profil</a></li>
                                          <li role="presentation"><a class="dropdown-item" role="menuitem" tabindex="-1"  href="{{ route('save.list') }}"><i class="fas fa-save"></i> Saxlanılan Elanlar</a></li>
                                          <li role="presentation"><a class="dropdown-item" role="menuitem" tabindex="-1"  href="{{ route('elan.user.index') }}"><i class="fas fa-scroll"></i> Elanlarınız</a></li>
                                          <li role="presentation"><a class="dropdown-item" role="menuitem" tabindex="-1"  href="{{ route('cv.user_cv') }}"><i class="fas fa-address-card"></i> CV-niz</a></li>
                                            <hr>
                                          <li role="presentation"><a class="dropdown-item" role="menuitem" tabindex="-1"  href="{{ route('logout') }}"><i class="fas fa-door-open"></i> Çıxış Et</a></li>
                                        </ul>
                                    </div>
                                    <div class="d-none d-lg-block">
                                        <a class="boxed-btn3" href="{{ route('elan.user.index') }}">Elan Yerləşdirin</a>
                                    </div>
                                    @endif
                                    
                                    
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

   