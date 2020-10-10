{{ Form::hidden('user_id', auth()->user()->id) }}

<div class="form-group">
	
	{{ Form::label('category_id', 'Categorias') }}
	{{ Form::select('category_id', $categories, null, ['class'=>'custom-select']) }}

</div>

<div class="form-group">
	
	{{ Form::label('name', 'Titulo de la Noticia') }}
	{{ Form::text('name', null, ['class'=>'form-control', 'id'=>'name']) }}

</div>

<div class="form-group mb-3">
	
	{{ Form::label('slug', 'URL Amigable') }}
	{{ Form::text('slug', null, ['class'=>'form-control', 'id'=>'slug', 'readonly']) }}

</div>

<div class="form-group">
	
	{{ Form::label('file', 'Imagen Encabezado') }}<br>
	{{ Form::file('file') }}

</div>

<div class="form-group">
	
	<hr>
	{{ Form::label('status', 'Estado') }}<br>
	<label>
		{{ Form::radio('status', 'PUBLISHED') }} Publicado
	</label> <br>
	<label>
		{{ Form::radio('status', 'DRAFT') }} Borrador
	</label>
	<hr>

</div>

<div class="form-group">
	
	{{ Form::label('tags', 'Etiquetas') }}
	<div>
		@foreach($tags as $tag)
		<label>
			{{ Form::checkbox('tags[]', $tag->id) }} {{ $tag->name }}			
		</label>
		@endforeach
	</div>

</div>

<div class="form-group">
	
	{{ Form::label('excerpt', 'Extracto') }}
	{{ Form::textarea('excerpt', null, ['class'=>'form-control', 'rows'=>'2']) }}

</div>

<div class="form-group">
	
	{{ Form::label('body', 'Descripción') }}
	{{ Form::textarea('body', null, ['class'=>'form-control', 'id'=>'body']) }}

</div>

<div class="form-group">

	{{ Form::button('<i class="icofont-download"></i> Guardar', ['type'=>'submit', 'class'=>'btn btn-success btn-block'] )  }}
	
</div>

@push('scripts')

<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ asset('vendor/stringToSlug/jquery.stringToSlug.min.js') }}" defer></script>
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>

<script type="text/javascript">
	//Convertir SLUG en URL Amigable
	$(document).ready(function(){
	    $("#name, #slug").stringToSlug({
	        callback: function(text){
	            $('#slug').val(text);
	        }
	    });
	});

	//Incorporar CKEDITOR en un TEXTAREA
	CKEDITOR.config.height = 400;
	CKEDITOR.config.width = 'auto';
	CKEDITOR.replace('body');

</script>

@endpush