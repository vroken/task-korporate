
@extends('layouts.auth')
@section('content')
{{-- message --}}
{{-- {!! Toastr::message() !!} --}}
<div class="login-right">
    <div class="login-right-wrap">
        <h1>Login Akun!</h1>
        <p class="account-subtitle">Belum punya akun? <a href="{{ route('register') }}">Daftar Akun</a></p>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email<span class="login-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email">
                <span class="profile-views"><i class="fas fa-envelope"></i></span>
            </div>
            <div class="form-group">
                <label>Password <span class="login-danger">*</span></label>
                <input type="password" class="form-control pass-input @error('password') is-invalid @enderror" name="password">
                <span class="profile-views feather-eye toggle-password"></span>
            </div>
            <div class="forgotpass">
                <div class="remember-me">
                    <label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> Remember me
                        <input type="checkbox" name="radio">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Login</button>
            </div>
        </form>
    </div>
</div>

@endsection
