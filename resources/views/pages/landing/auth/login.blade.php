@extends('layouts.app')

@section('content')
<section class="signup__area p-relative z-index-1 pt-100 pb-145">
    <div class="sign__shape">
        <img class="man-1" src="assets/img/icon/sign/man-1.png" alt="">
        <img class="man-2" src="assets/img/icon/sign/man-2.png" alt="">
        <img class="circle" src="assets/img/icon/sign/circle.png" alt="">
        <img class="zigzag" src="assets/img/icon/sign/zigzag.png" alt="">
        <img class="dot" src="assets/img/icon/sign/dot.png" alt="">
        <img class="bg" src="assets/img/icon/sign/sign-up.png" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                <div class="section__title-wrapper text-center mb-55">
                    <h2 class="section__title">Sign in</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                <div class="sign__wrapper white-bg">
                    @if (session('success'))
                    <div class="alert alert-success" data-testid="success-message">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger" data-testid="error-message">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li data-testid="error-item">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="sign__form">
                        <form action="{{ route('login') }}" method="POST" novalidate data-testid="login-form">
                            @csrf
                            <div class="sign__input-wrapper mb-25">
                                <h5>Email</h5>
                                <div class="sign__input">
                                    <input type="email" name="email" id="email" placeholder="e-mail address" value="{{ old('email') }}" required data-testid="email-input">
                                    <i class="fal fa-envelope"></i>
                                </div>
                                @error('email')
                                <span class="text-danger" data-testid="email-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="sign__input-wrapper mb-10">
                                <h5>Password</h5>
                                <div class="sign__input">
                                    <input type="password" name="password" id="password" placeholder="Password" required data-testid="password-input">
                                    <i class="fal fa-lock"></i>
                                </div>
                                @error('password')
                                <span class="text-danger" data-testid="password-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="sign__action d-sm-flex justify-content-between mb-30">
                                <div class="sign__agree d-flex align-items-center">
                                    <input class="m-check-input" type="checkbox" id="m-agree" name="remember">
                                    <label class="m-check-label" for="m-agree">Keep me signed in</label>
                                </div>
                                <div class="sign__forgot">
                                    <a href="#">Forgot your password?</a>
                                </div>
                            </div>
                            <button type="submit" class="tp-btn w-100" id="login-submit" data-testid="submit-button"> <span></span> Sign In</button>
                            <div class="sign__new text-center mt-20……

                            <div class="sign__new text-center mt-20">
                                <p>Dont have account? <a href="{{ route('auth.register') }}">Sign up</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@section('scripts')
<script>
    document.querySelector('[data-testid="login-form"]').addEventListener('submit', (e) => {
        console.log('Form submission attempted');
    });
</script>
@endsection
@endsection
