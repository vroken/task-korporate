@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Edit User</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="time-table.html">Users</a></li>
                            <li class="breadcrumb-item active">Edit User</li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {{-- {!! Toastr::message() !!} --}}
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            @if(Session::has('message'))
                                    <div class="alert alert-success mt-3">
                                    <span>
                                        <b> Success - </b> {{ Session::get('message') }}</span>
                                    </div>
                            @endif
                            <form action="{{ route('user.update', ['id' => $users->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label>Nama Lengkap <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control @error('name')is-invalid @enderror" name="name" value="{{ $users->name }}">
                                    <input type="hidden" name="id" value="{{ $users->id }}">
                                    @error('name')
                                        <small class="invalid-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="form-group local-forms">
                                    <label>Email <span class="login-danger">*</span></label>
                                    <input type="email" class="form-control @error('email')is-invalid @enderror" name="email" value="{{ $users->email }}">
                                    @error('email')
                                        <small class="invalid-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="form-group local-forms">
                                    <label>Old Password</label>
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" value="{{ old('current_password') }}">
                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                               
                                <div class="form-group local-forms">
                                    <label>New Password</label>
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" value="{{ old('new_password') }}">
                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group local-forms">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control @error('new_confirm_password') is-invalid @enderror" name="new_confirm_password" value="{{ old('new_confirm_password') }}">
                                    @error('new_confirm_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="col-12">
                                    <div class="student-submit">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>