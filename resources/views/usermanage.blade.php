@extends('layouts.app')

@section('content')
    <section class="section">
    <div class="section-header" style="color:#606060">
        <h5>User List</h5>
    </div>
    <div class="section-body">

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session()->has('updated'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('updated') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session()->has('deleted'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session()->get('deleted') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-body">

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-success mr-5" data-toggle="modal" data-target="#store">
                                Add User
                            </button>
                        </div>

                        <div class="d-flex justify-content-center">
                            <table class="table mt-4"
                                style="width: 95%; color:black; border: 1px solid #800000; font-weight:700;">
                                <thead style="background-color: #800000;">
                                    <tr>
                                        <th style="color:white;">Name</th>
                                        <th style="color:white;">Role</th>
                                        <th style="color:white;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr style="border: 1px solid #000000;">
                                            <td>{{ $user->fname }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td style="white-space:nowrap; width: 20px;">
                                                <!-- I add 20px and it fix the extra space, don't know why | don't fix, don't change :) -->
                                                {{-- <a href="#" class="btn btn-icon icon-left mr-3 btn-outline-primary">
                                                <i class="far fa-edit"></i>
                                                Edit</a> --}}

                                                {{-- <button type="button"
                                                    class="btn btn-icon icon-left mr-3 btn-outline-danger user-delete"
                                                    data-toggle="modal" data-target=".reset"
                                                    data-uid="{{ $user->id }}">
                                                    <i class="fas fa-undo"></i>
                                                    Reset Password
                                                </button> --}}

                                                <button type="button"
                                                    class="btn btn-icon icon-left mr-3 btn-outline-primary user-edit"
                                                    data-toggle="modal" data-target=".edit"
                                                    data-uid="{{ $user->id }}" data-fname="{{ $user->fname }}" data-username="{{ $user->username }}"
                                                    data-role="{{ $user->role }}">
                                                    <i class="far fa-edit"></i>
                                                    Edit
                                                </button>

                                                <button type="button"
                                                    class="btn btn-icon icon-left mr-3 btn-outline-danger user-delete"
                                                    data-toggle="modal" data-target=".delete"
                                                    data-uid="{{ $user->id }}">
                                                    <i class="fas fa-trash"></i>
                                                    Delete
                                                </button>
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
    </section>

    <!-- User Modal store User-->
    <div class="modal fade" id="store" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color: #033571;">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('usermanage.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fname">Full Name:</label><span class="text-danger">*</span>
                                    <input id="fname" type="text"
                                        class="form-control{{ $errors->has('fname') ? ' is-invalid' : '' }}" name="fname"
                                        tabindex="1" placeholder="Enter Full name here" required autofocus>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('fname') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="username">Username:</label><span class="text-danger">*</span>
                                    <input id="username" type="text"
                                        class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                        placeholder="Enter username here" name="username" tabindex="1" required autofocus>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('username') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="role">Role:</label><span class="text-danger">*</span>

                                    <select id="select1"
                                        class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role" required autofocus>

                                        <option value= "" selected disabled hidden>Role</option>
                                        <option value="Academic Head">Academic Head</option>
                                        <option value="Faculty">Faculty</option>
                                        <option value="Director">Director</option>
                                        <option value="Admin">Admin</option>

                                    </select>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('role') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password">Password:</label><span class="text-danger">*</span>
                                    <input id="password" type="password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        placeholder="Enter password here" name="password" tabindex="1" required autofocus>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- User Modal edit User-->
    <div class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color: #033571;">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="update" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fname">Full Name:</label><span class="text-danger">*</span>
                                    <input id="fname" type="text"
                                        class="form-control{{ $errors->has('fname') ? ' is-invalid' : '' }}" name="fname"
                                        tabindex="1" placeholder="Enter Full name here" required autofocus>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('fname') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="username">Username:</label><span class="text-danger">*</span>
                                    <input id="username" type="text"
                                        class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                        placeholder="Enter username here" name="username" tabindex="1" required autofocus>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('username') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="role">Role:</label><span class="text-danger">*</span>

                                    <select id="select1"
                                        class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role" required autofocus>

                                        <option value= "" selected disabled hidden>Role</option>
                                        <option value="Academic Head">Academic Head</option>
                                        <option value="Faculty">Faculty</option>
                                        <option value="Director">Director</option>
                                        <option value="Admin">Admin</option>

                                    </select>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('role') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password">Password:</label><span class="text-danger">*</span>
                                    <input id="password" type="password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        placeholder="(unchanged)" name="password" tabindex="1" required autofocus>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- User Modal delete Curriculum-->
    <div class="modal fade delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color: #033571;">Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="color: black;">
                    Are you sure want to delete this User?
                </div>
                <form method="POST" id="delete">
                    @csrf
                    @method('delete')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection

@section('scripts')

<!-- edit script -->
<script>
    $(document).ready(function() {
        // $('option').val($(this).data('role')).attr('selected', 'selected');

        $('.user-edit').each(function() {
            $(this).click(function(event) {
                $('#update').attr("action", "/usermanage/update/" + $(this).data('uid') + "");
                $('input[name="fname"]').val($(this).data('fname'));
                $('input[name="username"]').val($(this).data('username'));
                $('select[name="role"]').val($(this).data('role'));
                $('input[name="password"]').val($(this).data('password'));
            });
        });
    });
</script>

<!-- delete script -->
<script>
    $(document).ready(function() {
        $('.user-delete').each(function() {
            $(this).click(function(event) {
                $('#delete').attr("action", "/usermanage/destroy/" + $(this).data('uid') + "");
            });
        });
    });
</script>

@endsection
