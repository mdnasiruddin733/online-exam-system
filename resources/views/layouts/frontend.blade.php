<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="{{asset('frontend')}}/css/font-face.css" rel="stylesheet" media="all">
    <link href="{{asset('frontend')}}/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="{{asset('frontend')}}/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="{{asset('frontend')}}/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('frontend')}}/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{asset('frontend')}}/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="{{asset('frontend')}}/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="{{asset('frontend')}}/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="{{asset('frontend')}}/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="{{asset('frontend')}}/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="{{asset('frontend')}}/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="{{asset('frontend')}}/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('frontend')}}/css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container p-3">
                @yield("content")
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{asset('frontend')}}/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="{{asset('frontend')}}/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="{{asset('frontend')}}/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="{{asset('frontend')}}/vendor/slick/slick.min.js">
    </script>
    <script src="{{asset('frontend')}}/vendor/wow/wow.min.js"></script>
    <script src="{{asset('frontend')}}/vendor/animsition/animsition.min.js"></script>
    <script src="{{asset('frontend')}}/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="{{asset('frontend')}}/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="{{asset('frontend')}}/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="{{asset('frontend')}}/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="{{asset('frontend')}}/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{asset('frontend')}}/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="{{asset('frontend')}}/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="{{asset('frontend')}}/js/main.js"></script>

</body>

</html>
<!-- end document-->