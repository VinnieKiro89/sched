@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h5>tae</h5>
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
                            <div class="d-flex justify-content-center">
                                <table class="table mt-4"
                                    style="width: 95%; color:black; border: 1px solid #800000; font-weight:700;">
                                    <thead style="background-color: #800000;">
                                        <tr>
                                            <th style="color:white;">ID</th>
                                            <th style="color:white;">Course Code</th>
                                            <th style="color:white;">Period</th>
                                            <th style="color:white;">Level</th>
                                            <th style="color:white;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($curricula as $curriculum)
                                            <tr style="border: 1px solid #000000;">
                                                <td>{{ $curriculum->id }}</td>
                                                <td>{{ $curriculum->course_code }}</td>
                                                <td>{{ $curriculum->period }}</td>
                                                <td>{{ $curriculum->level }}</td>
                                                <td style="white-space:nowrap; width: 20px;">
                                                    <!-- I add 20px and it fix the extra space, don't know why || probably won't need this when we change UI package -->
                                                    <button type="button"
                                                        class="btn btn-icon icon-left mr-3 btn-outline-success user-add"
                                                        data-toggle="modal" data-target=".add"
                                                        data-uid="{{ $curriculum->id }}" data-course_code="{{ $curriculum->course_code }}"
                                                        data-desc="{{ $curriculum->description }}">
                                                        <i class="fas fa-plus"></i>
                                                        Add Subject
                                                    </button>
                                                    <button type="button"
                                                        class="btn btn-icon icon-left mr-3 btn-outline-success user-add"
                                                        data-toggle="modal" data-target=".add"
                                                        data-uid="{{ $curriculum->id }}" data-course_code="{{ $curriculum->course_code }}"
                                                        data-desc="{{ $curriculum->description }}">
                                                        <i class="fas fa-plus"></i>
                                                        View Subject
                                                    </button>
                                                    <button type="button"
                                                        class="btn btn-icon icon-left mr-3 btn-outline-primary user-edit"
                                                        data-toggle="modal" data-target=".edit"
                                                        data-uid="{{ $curriculum->id }}" data-course_code="{{ $curriculum->course_code }}"
                                                        data-period="{{ $curriculum->period }}" data-level="{{ $curriculum->level }}">
                                                        <i class="far fa-edit"></i>
                                                        Edit
                                                    </button>
                                                    <button type="button"
                                                        class="btn btn-icon icon-left mr-3 btn-outline-danger user-delete"
                                                        data-toggle="modal" data-target=".delete"
                                                        data-uid="{{ $curriculum->id }}">
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

        <!-- User Modal store Course-->
    <div class="modal fade" id="store" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color: #033571;">Add Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('course.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="course_code">Course Code:</label><span class="text-danger">*</span>
                                    <input id="course_code" type="text"
                                        class="form-control{{ $errors->has('course_code') ? ' is-invalid' : '' }}" name="course_code"
                                        tabindex="1" placeholder="e.g BSIT" autofocus>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('course_code') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description:</label><span class="text-danger">*</span>
                                    <input id="description" type="text"
                                        class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                        placeholder="e.g Bachelor of Science in Information Technology" name="description" tabindex="1" required autofocus>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
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

    <!-- user Modal edit Course-->
    <div class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color: #033571;">Edit Course</h5>
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
                                    <label for="course_code">Course Code:</label><span class="text-danger">*</span>
                                    <input id="course_code" type="text" class="form-control" name="course_code" tabindex="1" placeholder="e.g BSIT" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Level">Period:</label><span class="text-danger">*</span>

                                    <select id="select1"
                                        class="form-control{{ $errors->has('period') ? ' is-invalid' : '' }}"
                                        placeholder="Enter Period" name="period" required autofocus>

                                        <option selected disabled hidden>Period</option>
                                        <option>1st Semester</option>
                                        <option>2nd Semester</option>

                                    </select>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('level') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Level">Level:</label><span class="text-danger">*</span>

                                    <select id="select1"
                                        class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}" placeholder="Enter Level" name="level" required autofocus>

                                        <option selected disabled hidden>Level</option>
                                        <option>1st Year</option>
                                        <option>2nd Year</option>
                                        <option>3rd Year</option>
                                        <option>4th Year</option>

                                    </select>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('level') }}
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

    <!-- User Modal delete Course-->
    <div class="modal fade delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color: #033571;">Delete Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="color: black;">
                    Are you sure want to delete this Course?
                </div>
                <form method="POST" id="delete">
                    @csrf
                    @method('delete')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- User Modal store Curriculum-->
    <div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color: #033571;">Add Curriculum</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="add" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="course_code">Course Code:</label><span class="text-danger">*</span>
                                    <input id="course_code" type="text"
                                        class="form-control{{ $errors->has('course_code') ? ' is-invalid' : '' }}" name="course_code"
                                        tabindex="1" placeholder="e.g BSIT" autofocus readonly> 
                                    <div class="invalid-feedback">
                                        {{ $errors->first('course_code') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Level">Period:</label><span class="text-danger">*</span>

                                    <select id="select1"
                                        class="form-control{{ $errors->has('period') ? ' is-invalid' : '' }}"
                                        placeholder="Enter Period" name="period" required autofocus>

                                        <option selected disabled hidden>Period</option>
                                        <option>1st Semester</option>
                                        <option>2nd Semester</option>

                                    </select>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('level') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Level">Level:</label><span class="text-danger">*</span>

                                    <select id="select1"
                                        class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}"
                                        placeholder="Enter Level" name="level" required autofocus>

                                        <option selected disabled hidden>Level</option>
                                        <option>1st Year</option>
                                        <option>2nd Year</option>
                                        <option>3rd Year</option>
                                        <option>4th Year</option>

                                    </select>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('level') }}
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

@endsection

@section('scripts')
    <!-- add script -->
    <script>
        $(document).ready(function() {
            // $('option').val($(this).data('role')).attr('selected', 'selected');

            $('.user-add').each(function() {
                $(this).click(function(event) {
                    $('#add').attr("action", "/curriculum/store/" + "");
                    $('input[name="course_code"]').val($(this).data('course_code'));
                    $('input[name="period"]').val($(this).data('period'));
                    $('input[name="level"]').val($(this).data('level'));
                    $('select option').filter(":selected").val();

                });
            });
        });
    </script>

    <!-- delete script -->
    <script>
        $(document).ready(function() {
            $('.user-delete').each(function() {
                $(this).click(function(event) {
                    $('#delete').attr("action", "/curriculum/destroy/" + $(this).data('uid') + "");
                });
            });
        });
    </script>

    <!-- edit script -->
    <script>
        $(document).ready(function() {
            // $('option').val($(this).data('role')).attr('selected', 'selected');

            $('.user-edit').each(function() {
                $(this).click(function(event) {
                    $('#update').attr("action", "/course/update/" + $(this).data('uid') + "");
                    $('input[name="course_code"]').val($(this).data('course_code'));
                    $('input[name="period"]').val($(this).data('period'));
                    $('input[name="level"]').val($(this).data('level'));
                    $('select option').filter(":selected").val();

                });
            });
        });
    </script>

    <!-- show modal when has error script -->
    @if (count($errors) > 0)
        <script>
            $(document).ready(function() {
                $('#store').modal('show');
            });
        </script>
    @endif
@endsection