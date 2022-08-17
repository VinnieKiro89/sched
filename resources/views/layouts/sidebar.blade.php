<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <img class="navbar-brand-full app-header-logo" src="{{ asset('img/logo.jpg') }}" width="130" height="130"
             alt="PUP Logo">
        <a href="{{ url('/') }}"></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('/') }}" class="small-sidebar-text">
            <img class="navbar-brand-full" src="{{ asset('img/logo.jpg') }}" width="45px" alt=""/>
        </a>
    </div>
    <div style="margin-top: 90px"></div>
   
        <ul class="sidebar-menu">
            @include('layouts.menu')
        </ul>

</aside>
