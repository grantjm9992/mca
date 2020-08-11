<!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang="zxx"> <!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>The Finishing Touch Spain</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" href="theme_two/apple-touch-icon.png">
	<link rel="icon" href="theme_two/images/favicon.png" type="image/x-icon">
	<link rel="stylesheet" href="theme_two/css/bootstrap.min.css">
	<link rel="stylesheet" href="theme_two/css/normalize.css">
	<link rel="stylesheet" href="theme_two/css/fontawesome/fontawesome-all.css">
	<link rel="stylesheet" href="theme_two/css/linearicons.css">
	<link rel="stylesheet" href="theme_two/css/themify-icons.css">
	<link rel="stylesheet" href="theme_two/css/owl.carousel.min.css">
	<link rel="stylesheet" href="theme_two/css/fullcalendar.min.css">
	<link rel="stylesheet" href="theme_two/css/prettyPhoto.css">
	<link rel="stylesheet" href="theme_two/css/tipso.css">
	<link rel="stylesheet" href="theme_two/css/jquery-ui.css">
	<link rel="stylesheet" href="theme_two/css/lightpick.css">
	<link rel="stylesheet" href="theme_two/css/main.css">
	<link rel="stylesheet" href="theme_two/css/transitions.css">
	<link rel="stylesheet" href="theme_two/css/responsive-min.css">
	<script src="theme_two/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="at-home">
	<script src="theme_two/js/vendor/jquery-library.js"></script>
	<script src="theme_two/js/jquery-ui.js"></script>
	<script src="theme_two/js/vendor/bootstrap.min.js"></script>
	<script src="theme_two/js/owl.carousel.min.js"></script>
	<script src="theme_two/js/moment.min.js"></script>
	<script src="theme_two/js/fullcalendar.min.js"></script>
	<script src="theme_two/js/prettyPhoto.js"></script>
	<script src="theme_two/js/tipso.js"></script>
	<script src="theme_two/js/readmore.js"></script>
	<script src="theme_two/js/lightpick.js"></script>
	<script src="theme_two/js/main.js"></script>
	<div class="preloader-outer">
		<div class="at-preloader-holder">
			<img src="theme_two/images/loader.png" alt="laoder img">
			<div class="at-loader"></div>
		</div>
	</div>
	<!-- Preloader End -->
	<!-- Wrapper Start -->
	<div id="at-wrapper" class="at-wrapper at-haslayout">
        {!! $header !!}
		{!! $content !!}
        {!! $footer !!}
	</div>
	<!-- Wrapper End -->
</body>
</html>
