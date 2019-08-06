<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--head-->
@include('admin.partial.head')
<!--//head-->
<body class="cbp-spmenu-push">
<div class="main-content">
    <!--left-fixed -navigation-->
    @include('admin.partial.sidebar')
    <!-- header-starts -->
    @include('admin.partial.headear')
    <!-- //header-ends -->
    <!-- main content start-->
    <div id="page-wrapper">
        <div class="main.page">
            @yield('content')
        </div>
    </div>
    <!--footer-->
    @include('admin.partial.footer')
    <!--//footer-->
</div>

<!--main-js-->
    @include('admin.partial.main-js')

<!--//main-js-->

</body>
</html>