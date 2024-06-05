@extends('frontend.layouts.master')

@section('main-content')
<div class="mt-search-popup">
	<div class="mt-holder">
	  <a href="#" class="search-close"><span></span><span></span></a>
	  <div class="mt-frame">
		<form action="#">
		  <fieldset>
			<input type="text" placeholder="Search...">
			<span class="icon-microphone"></span>
			<button class="icon-magnifier" type="submit"></button>
		  </fieldset>
		</form>
	  </div>
	</div>
  </div><!-- mt search popup end here -->
  <!-- Main of the Page -->
  <main id="mt-main">
	<!-- Mt Map Holder of the Page -->
	<div class="mt-map-holder wow fadeInUp" data-wow-delay="0.4s" data-lat="52.392363" data-lng="1.480408" data-zoom="8">
	  <div class="map-info">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10238.789460723576!2d67.07267053896429!3d24.865259105874543!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33f5a45d7ce45%3A0xfbec16b84967ef67!2sArtXPro%20Digital%20Marketing%20Agency!5e0!3m2!1sen!2s!4v1717610373728!5m2!1sen!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	  </div>
	</div>
	<!-- Mt Map Holder of the Page end -->
	<!-- Mt Map Descrp of the Page -->
	<section class="mt-map-descrp wow fadeInUp" data-wow-delay="0.4s">
	  <div class="container">
		<div class="row">
		  <div class="col-xs-12 text-center">
			<h1>schön. chair maker</h1>
			<p>sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud <br>exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit sse cillum <br>dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat</p>
		  </div>
		</div>
	  </div>
	</section>
	<!-- Mt Map Descrp of the Page end -->
	<!-- Mt Contact Detail of the Page -->
	<div class="mt-contact-detail wow fadeInUp" data-wow-delay="0.4s">
	  <div class="container">
		<div class="row">
		  <div class="col-xs-12 col-sm-4 mt-paddingbottomxs text-center">
			<span class="icon"><i class="fa fa-map-marker"></i></span>
			<strong class="title">ADDRESS</strong>
			<address>Suite 18B, 148 Connaught Road Central <br>New Yankee</address>
		  </div>
		  <div class="col-xs-12 col-sm-4 mt-paddingbottomxs text-center">
			<span class="icon"><i class="fa fa-phone"></i></span>
			<strong class="title">PHONE</strong>
			<a href="#">+1 (555) 333 22 11</a>
		  </div>
		  <div class="col-xs-12 col-sm-4 mt-paddingbottomxs text-center">
			<span class="icon"><i class="fa fa-envelope-o"></i></span>
			<strong class="title">E_MAIL</strong>
			<a href="#">info@schon.chair</a>
		  </div>
		</div>
	  </div>
	</div>
	<!-- Mt Contact Detail of the Page end -->
	<!-- Mt Form Section of the Page -->
	<section class="mt-form-sec wow fadeInUp" data-wow-delay="0.4s">
	  <div class="container">
		<div class="row">
		  <header class="col-xs-12 text-center header">
			<h2>Have a question?</h2>
			<p> exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <br>Duis aute irure dolor in reprehenderit in voluptate velit sse cillum dolore eu fugiat nulla pariatur.</p>
		  </header>
		</div>
		<div class="row">
		  <div class="col-xs-12">
			<!-- Contact Form of the Page -->
			<form action="#" class="contact-form">
			  <fieldset>
				<input type="text" class="form-control" placeholder="Name">
				<input type="email" class="form-control" placeholder="E-Mail">
				<input type="text" class="form-control" placeholder="Subject">
				<textarea class="form-control" placeholder="Message"></textarea>
				<button class="btn-type3" type="submit">Send</button>
			  </fieldset>
			</form>
			<!-- Contact Form of the Page end -->
		  </div>
		</div>
	  </div>
	</section>
	<!-- Mt Form Section of the Page -->
  </main>
@endsection

@push('styles')
<style>
	
</style>
@endpush
@push('scripts')
<script src="{{ asset('frontend/js/jquery.form.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('frontend/js/contact.js') }}"></script>
@endpush