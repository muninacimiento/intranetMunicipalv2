<div class="form-group">
	
	{{ Form::label('name', 'Nombre de la Categoria') }}
	{{ Form::text('name', null, ['class'=>'form-control', 'id'=>'name']) }}

</div>

<div class="form-group">
	
	{{ Form::label('slug', 'URL Amigable') }}
	{{ Form::text('slug', null, ['class'=>'form-control', 'id'=>'slug', 'readonly']) }}

</div>

<div class="form-group">
	
	{{ Form::label('body', 'Descripción') }}
	{{ Form::textarea('body', null, ['class'=>'form-control', 'id'=>'body', 'rows'=>'3']) }}

</div>

<div class="form-group">

	{{ Form::button('<i class="icofont-download"></i> Guardar', ['type'=>'submit', 'class'=>'btn btn-success btn-block'] )  }}
	
</div>

@push('scripts')

<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ asset('vendor/stringToSlug/jquery.stringToSlug.min.js') }}" defer></script>

<script type="text/javascript">
	$(document).ready(function(){
	    $("#name, #slug").stringToSlug({
	        callback: function(text){
	            $('#slug').val(text);
	        }
	    });
	});
</script>

@endpush