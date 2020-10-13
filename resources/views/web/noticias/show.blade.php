@extends('layouts.web')

@section('content')
	<div class="container p-3">		
		<div class="col">		
			<div class="card">			
				<div class="card-body">
					<show id="hero">
					    <div class="hero-container">
						    <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">
								<div class="carousel-inner center-cropped" role="listbox">
									@if($post->file)
										<img src="{{ $post->file }}" class="img-fluid">
									@endif
							        <div class="carousel-item active">
							            <div class="carousel-container">
							  	            <div class="carousel-content container">
							    	            <h2 class="animate__animated animate__fadeInDown">{{ $post->name }}</h2>
							        	    </div>
							            </div>
							        </div>
							    </div>
						    </div>
					    </div>
					</show>	
					<p class="mt-2" style="font-size: 0.9em;"><em>Categoria :<a href="{{ route('noticias.categories', $post->category->slug) }}">{{ $post->category->name }}</a></em></p>
					<blockquote class="blockquote mt-3 text-mute">
					    <footer class="blockquote-footer">{{ $post->excerpt }}</footer>
					</blockquote>
					<hr>
					<div class="mb-3">
						{!! $post->body !!}
					</div>
					<div class="card-footer bg-transparent" style="font-size: 0.9em;">
						Etiquetas
							@foreach($post->tags as $tag)
								<a href="{{ route('noticias.tags', $tag->slug) }}">{{ $tag->name }}</a>
							@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection