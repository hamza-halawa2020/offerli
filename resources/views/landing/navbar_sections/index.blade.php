<!DOCTYPE html>
<html lang={{ app()->getLocale() }} class="light scroll-smooth" dir={{ app()->getLocale() == 'en' ? 'ltr' : 'rtl' }}>

<head>
    <meta charset="UTF-8">
    <title>{{ trans('landing.Offerli') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Tailwind CSS Saas & Software Landing Page Template">
    <meta name="keywords"
        content="agency, application, business, clean, creative, cryptocurrency, it solutions, modern, multipurpose, nft marketplace, portfolio, saas, software, tailwind css">
    <meta name="author" content="Shreethemes">
    <meta name="website" content="https://shreethemes.in">
    <meta name="email" content="support@shreethemes.in">
    <meta name="version" content="2.1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- favicon -->
    <link rel="shortcut icon" href={{ asset('assets/img/logo.png') }}>

    <!-- Css -->
    <link href={{ asset('assets/landing/libs/tiny-slider/tiny-slider.css') }} rel="stylesheet">
    <!-- Main Css -->
    <link href={{ asset('assets/landing/libs/@iconscout/unicons/css/line.css') }} type="text/css" rel="stylesheet">
    <link href={{ asset('assets/landing/libs/@mdi/font/css/materialdesignicons.min.css') }} rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" href={{ asset('assets/landing/css/tailwind.css') }}>

</head>

<body class="font-nunito text-base text-black dark:text-white dark:bg-slate-900">



    <nav id="topnav" class="defaultscroll is-sticky">
        <div class="container relative">
            <!-- Logo container-->
            <a class="logo" href="{{ route('home', ['locale' => app()->getLocale()]) }}">
                <img src="{{ asset('assets/img/logo.png') }}" alt="">
                <h3>{{ trans('landing.Offerli') }}</h3>
            </a>
            <style>
                .logo {
                    display: flex;
                    align-items: center;
                    text-decoration: none;
                    padding: 25px;
                    /* Add padding around the logo */
                }

                .logo h3 {
                    margin-right: 5px;
                    /* Adjust margin as needed */
                }

                .logo img {
                    width: 50px;
                    /* Adjust image width as needed */
                    height: auto;
                    /* Maintain aspect ratio */
                    padding: 0 5px;
                    /* Add padding around the image */
                }
            </style>
            {{-- <img src={{ asset('assets/landing/images/logo-light.png') }} class="hidden dark:inline-block"
            alt=""> --}}

            <!-- End Logo container-->
            <div class="menu-extras">
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>

            <!--Login button Start-->
            <ul class="buy-button list-none mb-0">
                {{-- <li class="inline mb-0">
                <a href=""
                    class="h-9 w-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-green-600/5 hover:bg-green-600 border border-lime-600/10 hover:border-lime-600 text-green-600 hover:text-white"><i
                        data-feather="settings" class="h-4 w-4"></i></a>
            </li> --}}
                @if (auth()->user())
                    <li class="inline ps-1 mb-0">
                        <a class="sub-menu-item px-4 py-1 text-sm text-green-600 font-semibold rounded-full border border-green-200 hover:text-white hover:bg-green-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2"
                            href={{ route('dashboard.index') }}>{{ trans('landing.DashBoard') }}</a>
                    </li>
                @else
                    <li class="inline ps-1 mb-0">
                        <a class="sub-menu-item px-4 py-1 text-sm text-green-600 font-semibold rounded-full border border-green-200 hover:text-white hover:bg-green-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 "
                            href={{ route('login') }}>{{ trans('landing.Login') }}</a>


                    </li>
                    <li class="inline ps-1 mb-0">
                        <a class="sub-menu-item px-4 py-1 text-sm text-green-600 font-semibold rounded-full border border-green-200 hover:text-white hover:bg-green-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2"
                            href={{ route('register') }}>{{ trans('landing.Register') }}</a>
                    </li>
                @endif
            </ul>
            <!--Login button End-->

            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <!-- Navigation links -->
                    <li><a href="{{ route('home', ['locale' => app()->getLocale()]) }}"
                            class="">{{ trans('landing.Home') }}</a></li>
                    <li class="has-submenu parent-parent-menu-item"><a
                            href="#aboutus">{{ trans('landing.About-Us') }}</a>
                    </li>
                    <li class="has-submenu parent-parent-menu-item">
                        <a href="javascript:void(0)">{{ trans('landing.Help-Center') }}</a><span
                            class="menu-arrow"></span>
                        <ul class="submenu">
                            <li>
                                <ul>
                                    <li><a href="#" class="sub-menu-item">{{ trans('landing.FAQ') }}</a></li>
                                    <li><a href="#" class="sub-menu-item">{{ trans('landing.Guide') }}</a></li>
                                    <li><a href="#" class="sub-menu-item">{{ trans('landing.Support') }}</a></li>
                                    <li><a href="#" class="sub-menu-item">{{ trans('landing.Blog') }}</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li><a href="#contactUs">{{ trans('landing.Contact-us') }}</a>
                    </li>


                    <li class="language-selection">
                        <form method="POST" action="{{ route('change.language') }}">
                            @csrf
                            <button type="submit" name="lang"
                                value="{{ app()->getLocale() === 'en' ? 'ar' : 'en' }}" class="language-toggle">
                                @if (app()->getLocale() === 'en')
                                    <img src="{{ asset('assets/flags/saudi-arabia-flag.svg') }}" alt="العربية"
                                        class="flag-icon">
                                    <span>العربية</span>
                                @else
                                    <img src="{{ asset('assets/flags/united-states-flag.svg') }}" alt="English"
                                        class="flag-icon">
                                    <span>English</span>
                                @endif
                            </button>
                        </form>
                    </li>

                </ul>

                <!-- Language selection dropdown -->
                <style>
                    .navigation-menu {
                        list-style-type: none;
                        margin: 0;
                        padding: 0;
                        display: flex;
                        align-items: center;
                    }

                    .navigation-menu li {
                        margin-right: 10px;
                    }

                    .language-selection {
                        margin-left: auto;
                        border: none;
                    }

                    .language-toggle {
                        align-items: center;
                        text-decoration: none;
                    }

                    .flag-icon {
                        width: 35px;
                        margin-right: 8px;
                    }
                </style>

            </div><!--end navigation-->
        </div><!--end container-->
    </nav><!--end header-->
