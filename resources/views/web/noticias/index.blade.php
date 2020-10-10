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
			
						<div class="card-header">
							
							<h5>{{ $post->name }}</h5>
							
					  	</div>
					  
					  	<div class="card-body">

					  		@if($post->file)

					  			<img src="{{ $post->file }}" class="img-fluid mb-2">

					  		@endif
					    
					    	<blockquote class="blockquote mb-3">
					      		
					      		<footer class="blockquote-footer">{{ $post->excerpt }}</footer>
					    	
					    	</blockquote>

					    	<a href="{{ route('noticias.show', $post->slug) }}" class="btn btn-success btn-sm"><i class="icofont-thin-double-right"></i> Leer más</a>
					  	
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