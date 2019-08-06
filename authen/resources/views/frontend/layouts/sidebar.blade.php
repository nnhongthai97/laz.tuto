<!DOCTYPE html>
<html lang="en">
<!--head-->
@include('frontend.partial.head')
<!--//head-->

<body>
<!-- header-starts -->
@include('frontend.partial.header')
<!-- //header-ends -->
<div class="sub-banner my-banner2">
</div>

<div class="content">
    <div class="container">
        @include('frontend.partial.sidebar')
        @yield('content')
    </div>
</div>
<!-- newsletter -->
@include('frontend.partial.newletter')
<!-- //newsletter -->
<!--footer-->
@include('frontend.partial.footer')
<!--//footer-->
<!-- main-js -->
@include('frontend.partial.main-js')
<!-- //main-js -->
</body>
</html>