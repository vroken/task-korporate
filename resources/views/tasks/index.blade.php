<link href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
@extends('layouts.master')
@section('content')

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
                                    <h3 class="page-title">Tasks List by : {{ Auth::user()->name }}</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="/home/task/create" class="btn btn-primary">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <a href="" class="btn btn-primary mb-2" id="deleteAllSelectedRecord">Delete All Selected</a>
                            <table
                                class="table border-0 table-hover table-center mb-0 datatable table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" id="select_all_ids" value="something">
                                            </div>
                                        </th>
                                        <th>No.</th>
                                        <th hidden></th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Date Join</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($tasks as $task)
                                    <tr id="tasks_ids{{ $task->id }}">
                                        <td>
                                            <div class="form-check check-tables">
                                                <input type="checkbox" class="form-check-input checkbox_ids" name="ids" value="{{ $task->id }}">
                                            </div>
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td hidden class="id">{{ $task->id }}</td>
                                        <td>{{ $task->nama }}</td>
                                        <td>{{ $task->status }}</td>
                                        <td>{{ $task->created_at->diffForHumans() }}</td>
                                        <td class="text-end">
                                            <div class="actions justify-content-center">
                                                <a href="/home/task/{{ $task->id }}" class="btn btn-sm bg-danger-light">
                                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                </a>
                                                
                                                <a href="/home/task/{{ $task->id }}/edit" class="btn btn-sm bg-danger-light">
                                                    <i class="feather-edit"></i>
                                                </a>
                                                <a class="btn btn-sm bg-danger-light user_delete" data-bs-toggle="modal" data-bs-target="#userDelete">
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

<div class="modal fade contentmodal" id="userDelete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content doctor-profile">
            <div class="modal-header pb-0 border-bottom-0  justify-content-end">
                <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                    class="feather-x-circle"></i>
                </button>
            </div>
            <div class="modal-body">
                @foreach ($tasks as $task)
                    
                <form action="{{ route('task/delete', ['id' => $task->id]) }}" method="POST">
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

            </div>
        </div>
    </div>
</div>


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

<script>
    $(function() {
        $("#select_all_ids").click(function() {
            $('.checkbox_ids').prop('checked', $(this).prop('checked'));
        });

        $('#deleteAllSelectedRecord').click(function(e) {
            e.preventDefault();
            var all_ids = [];
            $('input:checkbox[name=ids]:checked').each(function() {
                all_ids.push($(this).val());
            });

            $.ajax({
                url:"{{ route('task.delete') }}",
                type:"DELETE",
                data:{
                    ids:all_ids,
                    _token:'{{ csrf_token() }}'
                },
                success:function(response) {
                    $.each(all_ids,function(key,val){
                        $('#tasks_ids'+val).remove();
                    });
                }
            });
        });
    });

</script>

@endsection
