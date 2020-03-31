<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <base href="/k86/project-3-k86/blog/public/backend/">
	<!-- css -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<!--Icons-->
	<script src="js/lumino.glyphs.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
	<!-- header -->
    @include('backend.master.header')

	<!-- header -->
	<!-- sidebar left-->
    @include('backend.master.sidebar')

	<!--/. end sidebar left-->

	<!--main-->
    @yield('content')

	<!--end main-->

    <!-- javascript -->


	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	{{--  <script src="js/chart-data.js"></script>  --}}
	@yield('script')

	@yield('data')

</body>

</html>
