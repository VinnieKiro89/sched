@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header" style="color:#606060">
            <h3 class="page__heading">Dashboard</h3>
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
            <div class="row">
                @if (session()->get('Role') == "Director")
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1 shadow">
                            <div class="card-icon" style="background-color: #dbe644;">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Waiting for Approval</h4>
                                </div>
                                <div class="card-body">
                                    {{ $approvals }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1 shadow">
                        <div class="card-icon" style="background-color: #033571;">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Users</h4>
                            </div>
                            <div class="card-body">
                                {{ $users }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1 shadow">
                        <div class="card-icon" style="background-color: green;">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Courses</h4>
                            </div>
                            <div class="card-body">
                                {{ $courses }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1 shadow">
                        <div class="card-icon" style="background-color: green;">
                            <i class="fas fa-scroll"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Curricula</h4>
                            </div>
                            <div class="card-body">
                                {{ $curricula }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1 shadow">
                        <div class="card-icon" style="background-color: green;">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Subjects</h4>
                            </div>
                            <div class="card-body">
                                {{ $subjects }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center" style="color: black"></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

