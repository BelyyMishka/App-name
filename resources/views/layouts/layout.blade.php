<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">

    <title>{{ env('APP_NAME') }} :: @yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/front/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/templatemo-stand-blog.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/owl.css') }}">
    <link rel="icon" href="{{ asset('assets/circle.ico') }}">
    <script src="https://kit.fontawesome.com/2073871c36.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('assets/front/css/pagination.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/dropify.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>

<!-- ***** Preloader Start ***** -->
<div id="preloader">
    <div class="jumper">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<!-- ***** Preloader End ***** -->

<!-- Header -->
@include('sections.header')

<!-- Content -->
@yield('content')

<!-- Footer -->
@include('sections.footer')

<!-- Bootstrap core JavaScript -->
<script src="{{ asset('assets/front/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/front/js/bootstrap.bundle.min.js') }}"></script>

<!-- Additional Scripts -->
<script src="{{ asset('assets/front/js/custom.js') }}"></script>
<script src="{{ asset('assets/front/js/owl.js') }}"></script>
<script src="{{ asset('assets/front/js/slick.js') }}"></script>
<script src="{{ asset('assets/front/js/isotope.js') }}"></script>
<script src="{{ asset('assets/front/js/accordions.js') }}"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="{{ asset('assets/admin/js/bsmultiselect.bs4.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/dropify.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@stack('js-scripts')

<script>
    cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
    function clearField(t){                   //declaring the array outside of the
        if(! cleared[t.id]){                      // function makes it static and global
            cleared[t.id] = 1;  // you could use true and false, but that's more typing
            t.value='';         // with more chance of typos
            t.style.color='#fff';
        }
    }
</script>

</body>
</html>
