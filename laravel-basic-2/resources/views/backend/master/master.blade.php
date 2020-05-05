<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <base href="/">
	<!-- css -->
	<link href="backend/css/bootstrap.min.css" rel="stylesheet">
	<link href="backend/css/datepicker3.css" rel="stylesheet">
	<link href="backend/css/styles.css" rel="stylesheet">
	<!--Icons-->
	<script src="backend/js/lumino.glyphs.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/backend/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>

    @include('backend.master.header')
    @yield('content')

	@section('script')
	<!-- javascript -->
	<script src="backend/js/jquery-1.11.1.min.js"></script>
	<script src="backend/js/bootstrap.min.js"></script>
	<script src="backend/js/chart.min.js"></script>
	<script src="backend/js/easypiechart.js"></script>
	<script src="backend/js/easypiechart-data.js"></script>
	<script src="backend/js/bootstrap-datepicker.js"></script>
	{{--  <script src="backend/js/chart-data.js"></script>  --}}
	@show
	
</body>

</html>