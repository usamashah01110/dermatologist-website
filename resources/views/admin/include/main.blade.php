@include('admin.include.header')
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        @include('admin.include.sidebar')
        <div class="layout-page">
            @include('admin.include.navbar')
            <div class="content-wrapper">
                @yield('content')
            </div>
@include('admin.include.footer')
