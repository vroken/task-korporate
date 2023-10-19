
@extends('layouts.app')
@section('content')
{{-- message --}}
{{-- {!! Toastr::message() !!} --}}
<div class="login-right">
    <div class="login-right-wrap">
        <h1>Daftar Akun</h1>
        <p class="account-subtitle">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Lengkap<span class="login-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                <span class="profile-views"><i class="fas fa-envelope"></i></span>
                @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Email<span class="login-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email">
                <span class="profile-views"><i class="fas fa-envelope"></i></span>
                @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Password <span class="login-danger">*</span></label>
                <input type="password" class="form-control pass-input @error('password') is-invalid @enderror" name="password">
                <span class="profile-views feather-eye toggle-password"></span>
                @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Confirm Password <span class="login-danger">*</span></label>
                <input type="password" class="form-control pass-input @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                <span class="profile-views feather-eye toggle-password"></span>
                @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
            <div class="forgotpass">
                <div class="remember-me">
                    <label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> Remember me
                        <input type="checkbox" name="radio">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <a href="/forgot-password">Forgot Password?</a>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Register</button>
            </div>
        </form>
    </div>
</div>

@endsection
