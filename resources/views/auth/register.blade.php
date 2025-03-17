<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Register') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <img class="logo-size" src="{{ asset('images/logo-light.jpg') }}" alt="">
                </div>
            </a>
        </div>
        <div class="iofrm-layout">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <img src="{{ asset('images/graphic2.svg') }}" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Get more things done with Loggin platform.</h3>
                        <p>Access to the most powerfull tool in the entire design and web industry.</p>
                        <div class="page-links">
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register') }}" class="active">Register</a>
                        </div>
                        <!-- Registration Form -->
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <input class="form-control" type="text" name="name" placeholder="Full Name"
                                value="{{ old('name') }}" required>
                            @if ($errors->has('name'))
                                <span>{{ $errors->first('name') }}</span>
                            @endif
                            <input class="form-control" type="email" name="email" placeholder="E-mail Address"
                                value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span>{{ $errors->first('email') }}</span>
                            @endif
                            <input class="form-control" type="password" name="password" placeholder="Password" required>
                            @if ($errors->has('password'))
                                <span>{{ $errors->first('password') }}</span>
                            @endif
                            <input class="form-control" type="password" name="password_confirmation"
                                placeholder="Confirm Password" required>
                            @if ($errors->has('password_confirmation'))
                                <span>{{ $errors->first('password_confirmation') }}</span>
                            @endif
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">Register</button>
                            </div>
                        </form>
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
