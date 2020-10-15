{{ Form::hidden('user_id', auth()->user()->id) }}

<div class="form-group">
	
	{{ Form::label('name', 'Dependencia Municipal (Dirección / Departamento)') }}
	{{ Form::select('dependency_id', $dependencies, null, ['class'=>'custom-select']) }}

</div>

<div class="form-group">
	
	{{ Form::label('unidad', 'Unidad') }}
	{{ Form::text('unidad', null, ['class'=>'form-control', 'id'=>'unidad']) }}

</div>

<div class="form-group">
	
	{{ Form::label('telefono', 'Número Teléfono') }}
	{{ Form::text('telefono', null, ['class'=>'form-control', 'id'=>'telefono']) }}

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