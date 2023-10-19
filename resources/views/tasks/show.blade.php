@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            {{-- {!! Toastr::message() !!} --}}
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Profile</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            
                        <li class="breadcrumb-item active">Data {{ Auth::user() ? Auth::user()->name : 'No user' }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tab-content profile-tab-cont">
                    <div class="tab-pane fade show active" id="per_details_tab">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title d-flex justify-content-between mb-4">
                                            <span>Task Details</span>
                                            <a class="edit-link" data-bs-toggle="modal"
                                                href="#edit_personal_details"><i
                                                    class="far fa-edit me-1"></i>Edit</a>
                                        </h5>
                                        <div class="row">
                                            <p class="col-sm-2 text-muted text-sm-end mb-0 ">Nama Judul Task : </p>
                                            <p class="col-sm-9">{{ $tasks ? $tasks->nama : 'Tidak ada judul' }}</p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-2 text-muted text-sm-end mb-0 ">Status : </p>
                                            <p class="col-sm-9">{{ $tasks ? $tasks->status : 'Tidak ada status' }}</p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-2 text-muted text-sm-end mb-0 ">Gambar : </p>
                                            @if ($tasks->images)
                                                <img src="{{ asset('storage/'. $tasks->images) }}" class="img-holder mb-5" alt="" style="width: 50%;
                                                height: 300px; object-fit: cover;">
                                            @else
                                                <img src="https://source.unsplash.com/featured/" class="img-holder mb-5" alt="" style="width: 50%;
                                                height: 300px; object-fit: cover;">
                                            @endif
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-2 text-muted text-sm-end mb-0 ">Deskripsi : </p>
                                            <p class="col-sm-9">{!! $tasks->deskripsi !!}</p>
                                        </div>

                                        <a href="/home/task" class="btn btn-primary mt-4">Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>