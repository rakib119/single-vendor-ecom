<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ __('Register') }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dashboard') }}/images/favicon.png">
    <link href="{{ asset('dashboard') }}/css/style.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <a href="{{ route('index') }}"><img
                                                src="{{ asset('dashboard') }}/images/logo-full.png"></a>
                                    </div>
                                    <h4 class="text-center mb-4 text-white">{{ _('Sign up your account') }}</h4>
                                    <form method="POST" action="{{ route('register') }}">
                                        <div class="form-group">
                                            <label class="mb-1 text-white"
                                                for="name"><strong>{{ __('Name') }}</strong></label>
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autocomplete="name" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1 text-white"
                                                for="email"><strong>{{ __('E-Mail Address') }}</strong></label>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1 text-white"
                                                for="password"><strong>{{ __('Password') }}</strong></label>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1 text-white"
                                                for="password-confirm"><strong>{{ __('Confirm Password') }}</strong></label>
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn bg-white text-primary btn-block">
                                                {{ __('Sign me up') }}</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        @if (Route::has('register'))
                                            <p class="text-white">Already have an account? <a class="text-white"
                                                    href="{{ route('login') }}">{{ __('Sign in') }}</a></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('dashboard') }}/vendor/global/global.min.js"></script>
    <script src="{{ asset('dashboard') }}/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('dashboard') }}/js/custom.min.js"></script>
    <script src="{{ asset('dashboard') }}/js/deznav-init.js"></script>

</body>

</html>
