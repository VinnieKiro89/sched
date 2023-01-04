@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header" style="color:#606060">
            <h5>Curriculum List</h5>
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

            
            {{-- {{ Breadcrumbs::render('curriculum', $curriculum_id) }} --}}
            
                
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <table class="table mt-4"
                                    style="width: 95%; color:black; border: 1px solid #800000; font-weight:700;">
                                    <thead style="background-color: #800000;">
                                        <tr>
                                            <th style="color:white;">Course Code</th>
                                            <th style="color:white;">Section</th>
                                            <th style="color:white;">Level</th>
                                            <th style="color:white;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($curriculums as $curriculum)
                                            <tr style="border: 1px solid #000000;">
                                                <td>{{ $curriculum->course->course_code }}</td>
                                                <td>{{ $curriculum->section }}</td>
                                                {{-- <td>{{ $curriculum->period }}</td> --}}
                                                <td>{{ $curriculum->level }}</td>
                                                <td style="white-space:nowrap; width: 20px;">
                                                    <!-- I add 20px and it fix the extra space, don't know why || probably won't need this when we change UI package -->
                                                    {{-- <button type="button"
                                                        class="btn btn-icon icon-left mr-3 btn-outline-success user-add"
                                                        data-toggle="modal" data-target=".add" data-uid="{{ $curriculum->id }}"
                                                        data-course_code="{{ $curriculum->course->course_code }}" data-period="{{ $curriculum->period }}"
                                                        data-level="{{ $curriculum->level }}">
                                                        <i class="fas fa-plus"></i>
                                                        Add Subject
                                                    </button> --}} 
                                                    <a href="{{ route('subject.selectsubject', [$curriculum->id]) }}" class="btn btn-icon icon-left mr-3 btn-outline-success user-add">
                                                        <i class="fas fa-book"></i>
                                                        View Subjects
                                                    </a>
                                                    <button type="button"
                                                        class="btn btn-icon icon-left mr-3 btn-outline-primary user-edit"
                                                        data-toggle="modal" data-target=".edit"
                                                        data-uid="{{ $curriculum->id }}" data-course_code="{{ $curriculum->course->course_code }}"
                                                        data-section="{{ $curriculum->section }}" data-level="{{ $curriculum->level }}">
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

    <!-- User Modal store Subject-->
    <div class="modal fade add"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title" style="color: #033571;"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="add" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row justify-content-md-center">
                            <input id="curriculum_id" type="text" class="form-control{{ $errors->has('curriculum_id') ? ' is-invalid' : '' }}" name="curriculum_id" hidden readonly> 
                            <input id="period" type="text" class="form-control{{ $errors->has('period') ? ' is-invalid' : '' }}" name="period" hidden readonly> 
                            <input id="level" type="text" class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}" name="level" hidden readonly> 
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="subject_code">Subject code:</label><span class="text-danger">*</span>
                                    <input id="subject_code" type="text"
                                        class="form-control{{ $errors->has('subject_code') ? ' is-invalid' : '' }}" name="subject_code"
                                        tabindex="1" placeholder="Enter Subject Code" autofocus required>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('subject_code') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="subject_title">Subject Title:</label><span class="text-danger">*</span>
                                    <input id="subject_title" type="text"
                                        class="form-control{{ $errors->has('subject_title') ? ' is-invalid' : '' }}" name="subject_title"
                                        tabindex="1" placeholder="Enter Subject Title" autofocus required>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('subject_title') }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cred_units">Credited units:</label><span class="text-danger">*</span>
                                        <input id="cred_units" type="text"
                                            class="form-control{{ $errors->has('cred_units') ? ' is-invalid' : '' }}" name="cred_units"
                                            tabindex="1" placeholder="Enter Units" autofocus required>
                                        <div class="invalid-feedback">
                                            {{ $errors->first('cred_units') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subj_hours">Subject Hours:</label><span class="text-danger">*</span>
                                        <input id="subj_hours" type="text"
                                            class="form-control{{ $errors->has('subj_hours') ? ' is-invalid' : '' }}" name="subj_hours"
                                            tabindex="1" placeholder="Enter Units" autofocus required>
                                        <div class="invalid-feedback">
                                            {{ $errors->first('subj_hours') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pre-requisite">Pre-requisite:</label>
                                    <input id="pre-requisite" type="text"
                                        class="form-control" name="pre-requisite"
                                        tabindex="1" placeholder="Enter pre-requisites">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="co-requisite">Co-requisite:</label>
                                    <input id="co-requisite" type="text"
                                        class="form-control" name="co-requisite"
                                        tabindex="1" placeholder="Enter co-requisites">
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

    <!-- User Modal store Subject || wtf is this for?-->
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
                                    <label for="course_code">Tae:</label><span class="text-danger">*</span>
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

    <!-- user Modal edit Curriculum-->
    <div class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color: #033571;">Edit Curriculum</h5>
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
                                    <label for="section">section:</label><span class="text-danger">*</span>

                                    <select id="select1"
                                        class="form-control{{ $errors->has('section') ? ' is-invalid' : '' }}" name="section" required autofocus>

                                        <option value= "" selected disabled hidden>Section</option>
                                        <option value="Section 1">Section 1</option>
                                        <option value="Section 2">Section 2</option>

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
                                        class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}" name="level" required autofocus>

                                        <option value="" selected disabled hidden>Level</option>
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

    <!-- User Modal delete Curriculum-->
    <div class="modal fade delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color: #033571;">Delete Curriculum</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="color: black;">
                    Are you sure want to delete this Curriculum?
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
    <!-- add subj script -->
    <script>
        $(document).ready(function() {
            // $('option').val($(this).data('role')).attr('selected', 'selected');

            $('.user-add').each(function() {
                $(this).click(function(event) {
                    $('#add').attr("action", "/subject/store/" + "");

                    var head = 'Add subject for ' + $(this).data('course_code') + ' ' + $(this).data('period') + ' ' + $(this).data('level');
                    $('#modal-title').html(head);

                    $('input[name="curriculum_id"]').val($(this).data('uid'));
                    $('input[name="section"]').val($(this).data('section'));
                    $('input[name="level"]').val($(this).data('level'));
                    $('input[name="subject_code"]').val($(this).data('subject_code'));

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
                    $('#update').attr("action", "/curriculum/update/" + $(this).data('uid') + "");
                    $('input[name="course_code"]').val($(this).data('course_code'));
                    $('select[name="section"]').val($(this).data('section'));
                    $('select[name="level"]').val($(this).data('level'));
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