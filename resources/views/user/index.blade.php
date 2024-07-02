<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@extends('layouts.master')
@section('content')
{{-- message --}}
{{-- {!! Toastr::message() !!} --}}
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-xl-12 d-flex">
                <div class="card card-table">
                    <div class="card-body">
                        
                        @if(Session::has('message'))
                            <div class="alert alert-success mt-3">
                            <span>
                                <b> Success - </b> {{ Session::get('message') }}</span>
                            </div>
                        @endif
                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Users List</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="/register" class="btn btn-primary">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table
                                class="table border-0 table-hover table-center mb-0 datatable table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </th>
                                        <th>No.</th>
                                        <th hidden></th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date Join</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td hidden class="id">{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
                                        <td class="text-end">
                                            <div class="actions justify-content-center">
                                                <a href="user/show/{{ $user->id }}" class="btn btn-sm bg-danger-light">
                                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                </a>
                                                
                                                <a href="user/{{ $user->id }}/edit" class="btn btn-sm bg-danger-light">
                                                    <i class="feather-edit"></i>
                                                </a>
                                                <a class="btn btn-sm bg-danger-light student_delete" onclick="confirmDelete('{{ $user->id }}')">
                                                    <i class="feather-trash-2 me-1"></i>
                                                </a>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- model student delete --}}
<div class="modal fade contentmodal" id="studentUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content doctor-profile">
            <div class="modal-header pb-0 border-bottom-0  justify-content-end">
                <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                    class="feather-x-circle"></i>
                </button>
            </div>
            {{-- <div class="modal-body">
                @foreach ($tasks as $task)
                    
                <form action="{{ route('user/delete', ['id' => $task->id]) }}" method="POST">
                    @endforeach
                    @csrf
                    @method('DELETE')
                    <div class="delete-wrap text-center">
                        <div class="del-icon">
                            <i class="feather-x-circle"></i>
                        </div>
                        
                        <input type="hidden" name="id" class="e_id" value="">
                        <input type="hidden" name="avatar" class="e_avatar" value="">
                        <h2>Sure you want to delete</h2>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-success me-2">Yes</button>
                            <a class="btn btn-danger" data-bs-dismiss="modal">No</a>
                        </div>
                    </div>
                </form>

            </div> --}}
        </div>
    </div>
</div>

<script>
    function confirmDelete(userId) {
        if (confirm('Are you sure you want to delete this user?')) {
            // If the user confirms, redirect to the delete route
            window.location = '/user/delete/' + userId;
        }
    }
</script>

@section('script')

{{-- delete js --}}
<script>
    $(document).on('click','.user_delete',function()
    {
        var _this = $(this).parents('tr');
        $('.e_id').val(_this.find('.id').text());
    });
</script>
@endsection

@endsection
