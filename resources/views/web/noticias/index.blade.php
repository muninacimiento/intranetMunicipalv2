@extends('layouts.web')

@push('scriptsCSS')

	<style type="text/css">

		.my-active span{

			background-color: #cf7f55 !important;

			color: white !important;

			border-color: #cf7f55 !important;

		}

		.page-item .page-link {
 
		  z-index: 1;
		 
		  color: #00973b;
		 
		}

		.page-item.active .page-link {
 
		  z-index: 1;
		 
		  color: #fff;
		 
		  background-color: #cf7f55;
		 
		  border-color: #cf7f55;
		 
		}

	</style>

	

@endpush

@section('content')

<div class="container">
	
	<div class="col-md-12">

		<div class="text-muted">
			
			<h1>Noticias Municipales</h1><small>{{ $dateCarbon }}</small>

			<hr>

		</div>

		@foreach($posts->chunk(2) as $chunk)

       	<div class="row mb-3">

        	@foreach($chunk as $post)

               	<div class="col-md-6">
           
                	<div class="card">
					  
					  	<div class="card-body">

					  		<div class="portfolio">

						        <div class="portfolio-wrap enter-cropped  mb-3">

						           	@if($post->file)

								  		<img src="{{ $post->file }}" class="img-fluid">

								  	@endif

						        </div>

						        <h5><strong>{{ Illuminate\Support\Str::limit($post->name, 50) }}</strong></h5>

								<blockquote class="blockquote mb-3">
							      		
							      	<footer class="blockquote-footer">{{ Illuminate\Support\Str::limit($post->excerpt, 200) }}</footer>
							    	
							    </blockquote>

							    <a href="{{ route('noticias.show', $post->slug) }}" class="btn btn-success btn-sm"><i class="icofont-thin-double-right"></i> Leer más</a>
					  			
					  		</div>	
					  	
					  	</div>

					</div>
           
            	</div>
           
        	@endforeach
       
       	</div>

       	@endforeach

       	<div class="pagination justify-content-center">
       		
       		{{ $posts->links() }}

       	</div>

	</div>

</div>

@endsection