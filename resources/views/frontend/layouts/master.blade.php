
<!DOCTYPE html>
<html lang="en">
<head>
	@include('frontend.layouts.head')	
</head>
<body class="js">
	
	
	<!-- End Preloader -->
	<div id="wrapper">
		<!-- Page Loader -->
		<div id="pre-loader" class="loader-container">
			<div class="loader">
				<img src="images/svg/rings.svg" alt="loader">
			</div>
		</div>
		<!-- W1 start here -->
		<div class="w1">
		</div>
	</div>	
	
	<!-- Header -->
	@include('frontend.layouts.header')
	<!--/ End Header -->
	@yield('main-content')
	
	@include('frontend.layouts.footer')

</body>
</html>	