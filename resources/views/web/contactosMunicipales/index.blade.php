@extends('layouts.web')

@section('content')

<div class="container">
	<div class="row no-gutters">
		<div class="col-md-12 p-5">
			<h1>Contactos Municipales</h1>
		</div>
		<section class="about-lists">
	     	<div class="container">
	     		<div class="text-center p-3">
	     			<h3>Alcaldía</h3>
		        	<div class="row no-gutters">
		        		@foreach($contactsAlcaldia as $alcaldia)
		          		<div class="col-lg-12 col-md-6 content-item" data-aos="fade-up">
		            		<h5>{{ $alcaldia->unidad }}</h5>
		            		<span><i class="icofont-phone p-2"></i>{{ $alcaldia->telefono }}</span>
		          		</div>
		          		@endforeach
		        	</div>
	     		</div>
	      	</div>
	      	<hr>
	      	<div class="container">
	     		<h3 class="text-center p-3">Administración Municipal</h3>
	        	<div class="row no-gutters">
	        		@foreach($contactsAdmin as $admin)
	          		<div class="col-lg-4 col-md-6 content-item" data-aos="fade-up">
	            		<h5>{{ $admin->unidad }}</h5>
	            		<span><i class="icofont-phone p-2"></i>{{ $admin->telefono }}</span>
	          		</div>
	          		@endforeach
	        	</div>
	      	</div>
	      	<hr>
	      	
	    </section><!-- End About Lists Section -->
	</div>
</div>

@endsection

@push('scripts')

@endpush