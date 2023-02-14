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
                <div class="col-lg-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5>Change Username</h5>
                            <form method="POST" action="{{ route('settings.user', $id ) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="username">Username:</label><span class="text-danger">*</span>
                                        <input id="username" type="text" name="username" class="form-control" tabindex="1" placeholder="Enter username here" required autofocus>
                                </div>
                                <button type="submit" class="btn btn-primary mx-1">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5>Change Password</h5>
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
                                <button type="submit" class="btn btn-primary mx-1">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <hr>
                @if(session()->get('Role') == "Admin") 
                    <div>
                        <div>
                            <form action="{{ route('settings.restore')}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <input type="file" name="import-file" />
                                <button type="submit" class="btn btn-primary mx-1">Restore Data</button>
                            </form>
                        </div>
                        <div>
                            <a type="button" class="btn btn-secondary mx-1" href="{{ route('settings.backup') }}">Backup Data</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        var username = "{{ $username }}"
        $('input[name="username"]').val(username);
    });
</script>

@endsection

