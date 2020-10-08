@extends('layouts.web')

@section('content')

	<div class="container">
		
		<div class="col">

			<h1>{{ $post->name }}</h1>
			
			<div class="card">
				
				<div class="card-header">
						
					Categoria : 
					
					<a href="{{ route('noticias.categories', $post->category->slug) }}">{{ $post->category->name }}</a>

				</div>

				<div class="card-body">
					
					@if($post->file)

						<img src="{{ $post->file }}" class="img-fluid mb-3">

					@endif

					<blockquote class="blockquote mb-3 text-mute">
					      		
					    <footer class="blockquote-footer">{{ $post->excerpt }}</footer>
					    	
					</blockquote>

					<hr>

					{!! $post->body !!}

					<hr>

					Etiquetas
					@foreach($post->tags as $tag)

						<a href="{{ route('noticias.tags', $tag->slug) }}">{{ $tag->name }}</a>

					@endforeach

				</div>

			</div>

		</div>

	</div>

@endsection