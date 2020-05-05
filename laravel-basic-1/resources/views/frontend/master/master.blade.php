<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <base href="/frontend/">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/custome.css">



</head>

<body>

    @include('frontend.master.header')
    @yield('content')
    @include('frontend.master.footer')

	<!-- jQuery -->
	@section('script')
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>

	<script src="js/owl.carousel.min.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>

<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Main -->
    <script src="js/main.js"></script>
    <script>
        $(document).ready(function () {

            var quantitiy = 0;
            $('.quantity-right-plus').click(function (e) {

                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                $('#quantity').val(quantity + 1);


                // Increment

            });

            $('.quantity-left-minus').click(function (e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                if (quantity > 0) {
                    $('#quantity').val(quantity - 1);
                }
            });

        });
	</script>
	<script>
		var quantity=1;
		$('.quantity-right-plus').click(function () {
			var quantity = parseInt($('#quantity').val());
			$('#quantity').val(quantity + 1);
		});

		$('.quantity-left-minus').click(function (e) {
			var quantity = parseInt($('#quantity').val());
				if (quantity > 1) {
					$('#quantity').val(quantity - 1);
				}
		});
	</script>
	@show


</body>

</html>