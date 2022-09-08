@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header" style="color:#606060">
            <h5>Subject List</h5>
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
                            <h5> Subject list for {{ $code }} {{ $period }} {{ $level }} </h5>
                            <div class="d-flex justify-content-center">
                                <!-- Header goes here, i think -->
                                
                                <table class="table mt-4"
                                    style="width: 95%; color:black; border: 1px solid #800000; font-weight:700;">
                                    <thead style="background-color: #800000;">
                                        <tr>
                                            <th style="color:white;">Subject Code</th>
                                            <th style="color:white;">Subject Title</th>
                                            <th style="color:white;">Credited Units</th>
                                            <th style="color:white;">Subject Hours</th>
                                            <th style="color:white;">Pre-requisite</th>
                                            <th style="color:white;">Co-requisite</th>
                                            <th style="color:white;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>                    
                                        @foreach ($subjects as $subject)
                                            <tr style="border: 1px solid #000000;">
                                                <td>{{ $subject->subject_code }}</td>
                                                <td>{{ $subject->subject_title }}</td>
                                                <td>{{ $subject->cred_units }}</td>
                                                <td>{{ $subject->subj_hours }}</td>
                                                <td>{{ $subject->pre_requisite }}</td>
                                                <td>{{ $subject->co_requisite }}</td>
                                                    <td style="white-space:nowrap; width: 20px;">
                                                        <!-- I add 20px and it fix the extra space, don't know why | don't fix, don't change :) -->
                                                        {{-- <a href="#" class="btn btn-icon icon-left mr-3 btn-outline-primary">
                                                        <i class="far fa-edit"></i>
                                                        Edit</a> --}}

                                                        <button type="button"
                                                            class="btn btn-icon icon-left mr-3 btn-outline-primary user-edit"
                                                            data-toggle="modal" data-target=".edit" data-uid="{{ $subject->id }}"
                                                            data-subject_code="{{ $subject->subject_code }}" data-subject_title="{{ $subject->subject_title }}"
                                                            data-cred_units="{{ $subject->cred_units }}" data-subj_hours="{{ $subject->subj_hours }}" 
                                                            data-pre_requisite="{{ $subject->pre_requisite }}" data-co_requisite="{{ $subject->co_requisite }}">
                                                            <i class="far fa-edit"></i>
                                                            Edit
                                                        </button>


                                                        <button type="button"
                                                            class="btn btn-icon icon-left mr-3 btn-outline-danger user-delete"
                                                            data-toggle="modal" data-target=".delete"
                                                            data-uid="{{ $subject->id }}">
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

    <!-- user Modal edit Curriculum-->
    <div class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title" style="color: #033571;">Edit Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="update" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="subject_code">Subject Code:</label><span class="text-danger">*</span>
                                    <input id="subject_code" type="text" class="form-control" name="subject_code" tabindex="1" placeholder="Enter Subject Code" autofocus required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="subject_title">Subject Title:</label><span class="text-danger">*</span>
                                    <input id="subject_title" type="text" class="form-control" name="subject_title" tabindex="1" placeholder="Enter Subject Title" autofocus required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cred_units">Credited Units:</label><span class="text-danger">*</span>
                                        <input id="cred_units" type="text" class="form-control" name="cred_units" tabindex="1" placeholder="Enter Credited Units" autofocus required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subj_hours">Subject Hours:</label><span class="text-danger">*</span>
                                        <input id="subj_hours" type="text" class="form-control" name="subj_hours" tabindex="1" placeholder="Enter Subject Hours" autofocus required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pre_requisite">Pre-requisites:</label>
                                    <input id="pre_requisite" type="text" class="form-control" name="pre_requisite" tabindex="1" placeholder="Enter pre-requisites">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="co_requisite">Co-requisites:</label>
                                    <input id="co_requisite" type="text" class="form-control" name="co_requisite" tabindex="1" placeholder="Enter co-requisites">
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
                    <h5 class="modal-title" id="modal-title" style="color: #033571;">Delete Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="color: black;">
                    Are you sure want to delete this Subject?
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

    <!-- delete script -->
    <script>
        $(document).ready(function() {
            $('.user-delete').each(function() {
                $(this).click(function(event) {
                    $('#delete').attr("action", "/subject/destroy/" + $(this).data('uid') + "");
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
                    $('#update').attr("action", "/subject/update/" + $(this).data('uid') + "");
                    $('input[name="subject_code"]').val($(this).data('subject_code'));
                    $('input[name="subject_title"]').val($(this).data('subject_title'));
                    $('input[name="cred_units"]').val($(this).data('cred_units'));
                    $('input[name="subj_hours"]').val($(this).data('subj_hours'));
                    $('input[name="pre_requisite"]').val($(this).data('pre_requisite'));
                    $('input[name="co_requisite"]').val($(this).data('co_requisite'));
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