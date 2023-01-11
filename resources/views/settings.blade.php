@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header" style="color:#606060">
            <h3 class="page__heading">Settings</h3>
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
                            <form method="POST" action="{{ route('settings.pass', $id ) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="oldPW">Old Password:</label><span class="text-danger">*</span>
                                        <input id="oldPW" type="password" name="oldPW" class="form-control"
                                            tabindex="1" placeholder="Enter old password here" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="newPW">New Password:</label><span class="text-danger">*</span>
                                        <input id="newPW" type="password" name="newPW" class="form-control"
                                            tabindex="1" placeholder="Enter new password here" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="newPW2">Re-Enter New Password:</label><span class="text-danger">*</span>
                                        <input id="newPW2" type="password" name="newPW2" class="form-control"
                                            tabindex="1" placeholder="Re-enter new password here" required autofocus>
                                </div>
                                <button type="button" class="btn btn-secondary mx-1" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary mx-1">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

