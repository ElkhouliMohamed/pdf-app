<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Login') }}</title>

    <!-- CSRF Token for Laravel -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Template CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/iofrm-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/iofrm-theme6.css') }}">
</head>

<body>
    <div class="form-body">
        <div class="website-logo">
            <a href="{{ route('index') }}">
                <div class="logo">
                    <img class="logo-size" src="{{ asset('images/logo-light.jpg') }}" alt="Logo">
                </div>
            </a>
        </div>
        <div class="iofrm-layout">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <img src="{{ asset('images/graphic2.svg') }}" alt="Graphic">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>{{ __('Get more things done with Loggin platform.') }}</h3>
                        <p>{{ __('Access to the most powerful tool in the entire design and web industry.') }}</p>
                        <div class="page-links">
                            <a href="{{ route('login') }}" class="active">{{ __('Login') }}</a>
                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                        </div>

                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="alert alert-success" style="margin-bottom: 20px;">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <input class="form-control" type="email" name="email"
                                placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" required
                                autofocus autocomplete="username">
                            @if ($errors->has('email'))
                                <span class="text-danger" style="font-size: 14px;">{{ $errors->first('email') }}</span>
                            @endif

                            <input class="form-control" type="password" name="password"
                                placeholder="{{ __('Password') }}" required autocomplete="current-password">
                            @if ($errors->has('password'))
                                <span class="text-danger"
                                    style="font-size: 14px;">{{ $errors->first('password') }}</span>
                            @endif

                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">{{ __('Login') }}</button>
                                @if (Route::has('password.request'))
                                @endif
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Template JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
