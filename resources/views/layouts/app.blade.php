<!DOCTYPE html>
<html lang='en'>
<head>
    
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    
    <title>{{config('app.name')}}|@yield('title')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 4.1.1 -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Ionicons -->
    <link href="//fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/@fortawesome/fontawesome-free/css/all.css') }}" rel="stylesheet" type="text/css">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}"> --}}
    <link href="{{ asset('assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    {{-- <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />     --}}
    
    
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}


    {{-- Full Calendar :) --}}
    <link href='{{ asset('css/fullcalendar.css') }}' rel='stylesheet' />
    <script src='{{ asset('js/fullcalendar.js') }}'></script>

    <!-- Select2 :) -->
    <link href="{{ asset('vendor/select2/css/select2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" /> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script> --}}
    
    
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/utils/Draggable.min.js"></script>


@yield('page_css')
<!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/components.css')}}">
    <link rel="stylesheet" href="{{ asset('web/css/custom.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    <link rel="stylesheet" href="{{ asset('minimal.css')}}">
    @yield('page_css')

    @yield('css')

    @yield('report_css')
</head>
<body>

<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            @include('layouts.header')

        </nav>
        <div class="main-sidebar main-sidebar-postion">
            @include('layouts.sidebar')
        </div>
        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
        <footer class="main-footer">
            @include('layouts.footer')
        </footer>
    </div>
</div>

{{-- @include('profile.change_password')
@include('profile.edit_profile') --}}

</body>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
{{-- <script src="{{ asset('assets/js/iziToast.min.js') }}"></script> --}}
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<!-- Template JS File -->
<script src="{{ asset('web/js/stisla.js') }}"></script>
<script src="{{ asset('web/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/profile.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom.js') }}"></script>
@yield('page_js')
@yield('scripts')
@yield('report_JS_Script')
<script>
    let loggedInUser =@json(\Illuminate\Support\Facades\Auth::user());
    let loginUrl = '';
    const userUrl = '';
    // Loading button plugin (removed from BS4)
    (function ($) {
        $.fn.button = function (action) {
            if (action === 'loading' && this.data('loading-text')) {
                this.data('original-text', this.html()).html(this.data('loading-text')).prop('disabled', true);
            }
            if (action === 'reset' && this.data('original-text')) {
                this.html(this.data('original-text')).prop('disabled', false);
            }
        };
    }(jQuery));
</script>

</html>
