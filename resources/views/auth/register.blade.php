
@extends('layouts.auth')
@section('content')
{{-- message --}}
{{-- {!! Toastr::message() !!} --}}
<div class="login-right">
    <div class="login-right-wrap">
        <h1>Register Akun!</h1>
        <p class="account-subtitle">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Lengkap<span class="login-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
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
                <label>Konfirmasi Password <span class="login-danger">*</span></label>
                <input type="password" class="form-control pass-input @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                <span class="profile-views feather-eye toggle-password"></span>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Register</button>
            </div>
        </form>
    </div>
</div>

@endsection
