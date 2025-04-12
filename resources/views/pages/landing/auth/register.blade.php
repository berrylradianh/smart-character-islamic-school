@extends('layouts.app')

@section('content')
<section class="signup__area p-relative z-index-1 pt-100 pb-145">
    <div class="sign__shape">
        <img class="man-1" src="assets/img/icon/sign/man-3.png" alt="">
        <img class="man-2 man-22" src="assets/img/icon/sign/man-2.png" alt="">
        <img class="circle" src="assets/img/icon/sign/circle.png" alt="">
        <img class="zigzag" src="assets/img/icon/sign/zigzag.png" alt="">
        <img class="dot" src="assets/img/icon/sign/dot.png" alt="">
        <img class="bg" src="assets/img/icon/sign/sign-up.png" alt="">
        <img class="flower" src="assets/img/icon/sign/flower.png" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                <div class="section__title-wrapper text-center mb-55">
                    <h2 class="section__title">Sign Up</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                <div class="sign__wrapper white-bg">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="sign__form">
                        <form action="{{ route('auth.register') }}" method="POST">
                            @csrf
                            <div class="sign__input-wrapper mb-25">
                                <h5>Full Name</h5>
                                <div class="sign__input">
                                    <input type="text" name="name" placeholder="Full name" value="{{ old('name') }}" required>
                                    <i class="fal fa-user"></i>
                                </div>
                            </div>
                            <div class="sign__input-wrapper mb-25">
                                <h5>Email</h5>
                                <div class="sign__input">
                                    <input type="email" name="email" placeholder="e-mail address" value="{{ old('email') }}" required>
                                    <i class="fal fa-envelope"></i>
                                </div>
                            </div>
                            <div class="sign__input-wrapper" style="margin-bottom: 80px;">
                                <h5>Jenjang</h5>
                                <div class="sign__input">
                                    <select name="jenjang" required>
                                        <option value="" disabled selected>Select Education Level</option>
                                        <option value="sd" {{ old('jenjang') == 'sd' ? 'selected' : '' }}>SD (Elementary School)</option>
                                        <option value="smp" {{ old('jenjang') == 'smp' ? 'selected' : '' }}>SMP (Junior High School)</option>
                                        <option value="sma" {{ old('jenjang') == 'sma' ? 'selected' : '' }}>SMA (Senior High School)</option>
                                        <option value="kuliah" {{ old('jenjang') == 'kuliah' ? 'selected' : '' }}>Kuliah (University)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="sign__input-wrapper mb-25">
                                <h5>Password</h5>
                                <div class="sign__input">
                                    <input type="password" name="password" placeholder="Password" required>
                                    <i class="fal fa-lock"></i>
                                </div>
                            </div>
                            <div class="sign__input-wrapper mb-10">
                                <h5>Confirm Password</h5>
                                <div class="sign__input">
                                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                                    <i class="fal fa-lock"></i>
                                </div>
                            </div>
                            <div class="sign__action d-flex justify-content-between mb-30">
                                <div class="sign__agree d-flex align-items-center">
                                    <input class="m-check-input" type="checkbox" id="m-agree" name="terms" required>
                                    <label class="m-check-label" for="m-agree">I agree to the <a href="#">Terms & Conditions</a>
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="tp-btn w-100"> <span></span> Sign Up</button>
                            <div class="sign__new text-center mt-20">
                                <p>Have an account? <a href="{{route('auth.login')}}">Sign in</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
