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
    <link rel="stylesheet" href="{{ asset('assets/front/css/card.css') }}">
    <link rel="icon" href="{{ asset('assets/circle.ico') }}">
</head>

<body style="background: #f7f7f7">
<p class="message" style="margin-left: 10px;margin-top: 4px;"><a href="{{ route('index') }}">Back to site</a></p>
<!-- ***** Preloader Start ***** -->
<div id="preloader">
    <div class="jumper">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<!-- ***** Preloader End ***** -->

<!-- Content -->
@yield('content')

<!-- Bootstrap core JavaScript -->
<script src="{{ asset('assets/front/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/front/js/bootstrap.bundle.min.js') }}"></script>

<!-- Additional Scripts -->
<script src="{{ asset('assets/front/js/adminlte.min.js') }}"></script>
<script src="{{ asset('assets/front/js/custom.js') }}"></script>
<script src="{{ asset('assets/front/js/owl.js') }}"></script>
<script src="{{ asset('assets/front/js/slick.js') }}"></script>
<script src="{{ asset('assets/front/js/isotope.js') }}"></script>
<script src="{{ asset('assets/front/js/accordions.js') }}"></script>
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
