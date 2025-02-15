<!DOCTYPE html>
<html>
@include('Dashboard::layout.head')
<body>
{{--<div class="pre-loader">
    <div class="pre-loader-box">
        <div class="loader-logo">
            <img src="/vendors/images/deskapp-logo.svg" alt=""/>
        </div>
        <div class="loader-progress" id="progress_div">
            <div class="bar" id="bar1"></div>
        </div>
        <div class="percent" id="percent1">0%</div>
        <div class="loading-text">Loading...</div>
    </div>
</div>--}}

@include('Dashboard::layout.header')
@include('Dashboard::layout.sidebar')

<div class="mobile-menu-overlay"></div>

<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        @yield('breadcrumb')
        @yield('content')
        @include('Dashboard::layout.footer')

    </div>
</div>

@include('Dashboard::layout.foot-page')

</body>
</html>

