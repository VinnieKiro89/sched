@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header" style="color:#606060">
            <h5>Course List</h5>
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
                                    Add Course
                                </button>
                            </div>

                            <div class="d-flex justify-content-center">
                                <table class="table mt-4"
                                    style="width: 95%; color:black; border: 1px solid #800000; font-weight:700;">
                                    <thead style="background-color: #800000;">
                                        <tr>
                                            <th style="color:white;">Course Code</th>
                                            <th style="color:white;">Description</th>
                                            <th style="color:white;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($courses as $course)
                                            <tr style="border: 1px solid #000000;">
                                                <td>{{ $course->course_code }}</td>
                                                <td>{{ $course->description }}</td>
                                                    <td style="white-space:nowrap; width: 20px;">
                                                        <!-- I add 20px and it fix the extra space, don't know why | don't fix, don't change :) -->
                                                        {{-- <a href="#" class="btn btn-icon icon-left mr-3 btn-outline-primary">
                                                        <i class="far fa-edit"></i>
                                                        Edit</a> --}}

                                                        <button type="button"
                                                            class="btn btn-icon icon-left mr-3 btn-outline-success user-add"
                                                            data-toggle="modal" data-target=".add"
                                                            data-uid="{{ $course->id }}" data-course_code="{{ $course->course_code }}"
                                                            data-desc="{{ $course->description }}">
                                                            <i class="fas fa-plus"></i>
                                                            Add Curriculum
                                                        </button>

                                                        <button type="button"
                                                            class="btn btn-icon icon-left mr-3 btn-outline-primary user-edit"
                                                            data-toggle="modal" data-target=".edit"
                                                            data-uid="{{ $course->id }}" data-course_code="{{ $course->course_code }}"
                                                            data-description="{{ $course->description }}">
                                                            <i class="far fa-edit"></i>
                                                            Edit
                                                        </button>


                                                        <button type="button"
                                                            class="btn btn-icon icon-left mr-3 btn-outline-danger user-delete"
                                                            data-toggle="modal" data-target=".delete"
                                                            data-uid="{{ $course->id }}">
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
                                        tabindex="1" placeholder="e.g BSIT" required autofocus>
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
                                    <input id="course_code" type="text" class="form-control" name="course_code" tabindex="1" placeholder="e.g BSIT" autofocus required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description:</label><span class="text-danger">*</span>
                                    <input id="description" type="text" class="form-control" placeholder="Enter Email address" name="description" tabindex="1" required autofocus>
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
                    <h5 class="modal-title" id="modal-title" style="color: #033571;">Add Curriculum</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="add" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <input id="course_id" type="text" class="form-control{{ $errors->has('course_id') ? ' is-invalid' : '' }}" name="course_id" hidden readonly> 
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Level">Period:</label><span class="text-danger">*</span>

                                    <select id="select1"
                                        class="form-control{{ $errors->has('period') ? ' is-invalid' : '' }}" name="period" required autofocus>

                                        <option value="" selected disabled hidden>Enter Period</option>
                                        <option value="1st Semester">1st Semester</option>
                                        <option value="2nd Semester">2nd Semester</option>

                                    </select>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('period') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Level">Level:</label><span class="text-danger">*</span>

                                    <select id="select1"
                                        class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}" name="level" required autofocus>

                                        <option value="" selected disabled hidden>Enter Level</option>
                                        <option value="1st Year">1st Year</option>
                                        <option value="2nd Year">2nd Year</option>
                                        <option value="3rd Year">3rd Year</option>
                                        <option value="4th Year">4th Year</option>

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
    <!-- add curr script -->
    <script>
        $(document).ready(function() {
            // $('option').val($(this).data('role')).attr('selected', 'selected');

            $('.user-add').each(function() {
                $(this).click(function(event) {
                    $('#add').attr("action", "/curriculum/store/" + "");

                    var head = 'Add Curriculum for ' + $(this).data('course_code');
                    $('#modal-title').html(head);

                    $('input[name="course_id"]').val($(this).data('uid'));
                    $('input[name="period"]').val($(this).data('period'));
                    $('input[name="level"]').val($(this).data('level'));

                });
            });
        });
    </script>

    <!-- delete script -->
    <script>
        $(document).ready(function() {
            $('.user-delete').each(function() {
                $(this).click(function(event) {
                    $('#delete').attr("action", "/course/destroy/" + $(this).data('uid') + "");
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
                    $('input[name="description"]').val($(this).data('description'));
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