@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h5>what</h5>
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
                                                        class="btn btn-icon icon-left mr-3 btn-outline-primary user-edit"
                                                        data-toggle="modal" data-target=".edit"
                                                        data-uid="{{ $curriculum->id }}" data-course_code="{{ $curriculum->course_code }}"
                                                        data-description="{{ $curriculum->description }}">
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

@endsection