@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Add Task</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="time-table.html">Users</a></li>
                            <li class="breadcrumb-item active">Add Task</li>
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
                            <form method="post" action="/home/task/{{ $tasks->id }}" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                                <div class="col-12 col-sm-12">
                                    <div class="form-group local-forms">
                                        <label>Nama Tugas <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('nama')is-invalid @enderror" name="nama" value="{{ old('nama', $tasks->nama) }}">
                                        @error('nama')
                                            <small class="invalid-feedback">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="form-group local-forms">
                                        <label>Status<span class="login-danger">*</span></label>
                                        <select class="form-control select @error('status')is-invalid @enderror" name="status">
                                            <option selected>Pilih Jenis Status</option>
                                            <option value="Aktif" {{ old('status', $tasks->status) == 'Aktif' ? "selected" : "Aktif" }}>Aktif</option>
                                            <option value="Tidak Aktif" {{ old('status', $tasks->status) == 'Tidak Aktif' ? "selected" : "Tidak Aktif" }}>Tidak Aktif</option>
                                        </select>
                                        @error('status')
                                            <small class="invalid-feedback">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="form-group local-forms">
                                        <label>Upload Gambar <span class="login-danger">*</span></label>
                                        <input type="file" class="form-control @error('images')is-invalid @enderror" 
                                        id="images" name="images" value="{{ old('images', $tasks->images) }}" onchange="previewImage()">
                                        <input type="hidden" name="oldImage" value="{{ $tasks->images }}">

                                        @if ($tasks->images)
                                            <img src="{{ asset('storage/' . $tasks->images) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block" alt="" >
                                        @else
                                            <img class="img-preview img-fluid mb-3 col-sm-7" alt="" >
                                        @endif

                                        @error('images')
                                            <small class="invalid-feedback">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="form-group local-forms">
                                        <label>Deskripsi<span class="login-danger">*</span></label>
                                        <input id="x" type="hidden" name="deskripsi" class="bg-light" value="{{ old('deskripsi', $tasks->deskripsi) }}">
                                        <trix-editor input="x" >

                                        </trix-editor>
                                        @error('deskripsi')
                                            <small class="invalid-feedback">
                                                {{ $message }}
                                            </small>
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
    <script>
        function previewImage() {
            const image = document.querySelector('#images');
            const imgpreview = document.querySelector('.img-preview');
    
            imgpreview.style.display = 'block';
    
            const ofReader = new FileReader();
            ofReader.readAsDataURL(image.files[0]);
    
            ofReader.onload = (oFREvent) => {
                imgpreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection