<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path={{ asset('assets/ /') }} data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Register Cover - Pages | Vuexy - Bootstrap Admin Template</title>

    <meta name="description" content="" />

    <link rel="icon" type="image/x-icon" href={{ asset('assets/img/logo.png') }} />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href={{ asset('assets/vendor/fonts/fontawesome.css') }} />
    <link rel="stylesheet" href={{ asset('assets/vendor/fonts/tabler-icons.css') }} />
    <link rel="stylesheet" href={{ asset('assets/vendor/fonts/flag-icons.css') }} />

    <!-- Core CSS -->
    <link rel="stylesheet" href={{ asset('assets/vendor/css/rtl/core.css') }} class="template-customizer-core-css" />
    <link rel="stylesheet" href={{ asset('assets/vendor/css/rtl/theme-default.css') }}
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href={{ asset('assets/css/demo.css') }} />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href={{ asset('assets/vendor/libs/node-waves/node-waves.css') }} />
    <link rel="stylesheet" href={{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }} />
    <link rel="stylesheet" href={{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }} />
    <!-- Vendor -->
    <link rel="stylesheet" href={{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }} />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href={{ asset('assets/vendor/css/pages/page-auth.css') }} />

    <!-- Helpers -->
    <script src={{ asset('assets/vendor/js/helpers.js') }}></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src={{ asset('assets/vendor/js/template-customizer.js') }}></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src={{ asset('assets/js/config.js') }}></script>
</head>

<body>
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                    <img src={{ asset('assets/img/logo.png') }}
                        alt="auth-register-cover" class="img-fluid my-5 auth-illustration"
 />

                </div>
            </div>
            <!-- /Left Text -->

            <!-- Register -->
            <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
                <div class="w-px-400 mx-auto">
                    <!-- Logo -->
                    <div class="app-brand mb-4">
                        <a href="{{ route('login') }}" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="" width="32"
                                    height="22">
                   
                            </span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h3 class="mb-1">Offerli</h3>
                    <p class="mb-4">Make your app management easy and fun!</p>



                    <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            @if ($errors->has('name'))
                                <div class="error">{{ $errors->first('name') }}</div>
                            @endif
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter your name" />
                        </div>
                        <div class="mb-3">
                            @if ($errors->has('email'))
                                <div class="error">{{ $errors->first('email') }}</div>
                            @endif
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="Enter your email" />
                        </div>
                        <div class="mb-3 form-password-toggle">
                            @if ($errors->has('password'))
                                <div class="error">{{ $errors->first('password') }}</div>
                            @endif
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password_confirmation">Password Confirmation</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control"
                                    name="password_confirmation"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                        </div>
                        {{-- <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms-conditions"
                                    name="terms" />
                                <label class="form-check-label" for="terms-conditions">
                                    I agree to
                                    <a href="javascript:void(0);">privacy policy & terms</a>
                                </label>
                            </div>
                        </div> --}}
                        <button class="btn btn-primary d-grid w-100">Sign up</button>
                    </form>

                    <p class="text-center">
                        <span>Already have an account?</span>
                        <a href="{{ route('login') }}">
                            <span>Sign in instead</span>
                        </a>
                    </p>
                    {{--
                    <div class="divider my-4">
                        <div class="divider-text">or</div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
                            <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
                            <i class="tf-icons fa-brands fa-google fs-5"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-icon btn-label-twitter">
                            <i class="tf-icons fa-brands fa-twitter fs-5"></i>
                        </a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src={{ asset('assets/vendor/libs/jquery/jquery.js') }}></script>
    <script src={{ asset('assets/vendor/libs/popper/popper.js') }}></script>
    <script src={{ asset('assets/vendor/js/bootstrap.js') }}></script>
    <script src={{ asset('assets/vendor/libs/node-waves/node-waves.js') }}></script>
    <script src={{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}></script>
    <script src={{ asset('assets/vendor/libs/hammer/hammer.js') }}></script>
    <script src={{ asset('assets/vendor/libs/i18n/i18n.js') }}></script>
    <script src={{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}></script>
    <script src={{ asset('assets/vendor/js/menu.js') }}></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src={{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}></script>
    <script src={{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}></script>
    <script src={{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}></script>

    <!-- Main JS -->
    <script src={{ asset('assets/js/main.js') }}></script>

    <!-- Page JS -->
    <script src={{ asset('assets/js/pages-auth.js') }}></script>
</body>

</html>
