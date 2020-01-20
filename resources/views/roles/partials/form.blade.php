@csrf

<div class="form-row">

	<div class="col-md-6 mb-3">

		{{ Form::label('name', 'Nombre Rol') }}

		{{ Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Nombre del Rol', 'required']) }}

		<div class="invalid-feedback">

			<label>Por favor ingrese el Nombre del Rol</label>

		</div>

	</div>

	<div class="col-md-6 mb-3">

		{{ Form::label('slug', 'URL Amigable') }}

		{{ Form::text('slug', null, ['class' => 'form-control', 'placeholder'=>'URL del Rol', 'required']) }}

		<div class="invalid-feedback">

			{{ Form::label('slug','Por favor la URL Amigable del Rol') }}

		</div>

	</div>
	
</div>

<div class="form-row mb-3">

	{{ Form::label('description', 'Descripción') }}

	{{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder'=>'Descripción del Rol', 'rows' => '2', 'required']) }}

	<div class="invalid-feedback">

		{{ Form::label('description','Por favor ingrese la Descripción del Rol') }}

	</div>

</div>

<div class="form-row mb-2">

	<h5>Permiso Especial</h5>

</div>

<div class="form-row mb-3">

	<label class="mr-3">{{ Form::radio('special', 'all-access') }} Acceso Total</label>

	<label>{{ Form::radio('special', 'no-access') }} Ningún Acceso</label>

</div>

<div class="form-row mb-3">

	<h5>Lista de Permisos</h5>

</div>

<div class="form-row mb-3">

	<ul class="list-unstyled">
		
		@foreach($permissions as $permission)

			<li>
				
				<label>
                                            
                    {{ Form::checkbox('permissions[]', $permission->id, null) }}

                    {{ $permission->name }} / <strong><em>{{ $permission->slug }}</em></strong>

                </label>

			</li>

		@endforeach

	</ul>

</div>

<div class="form-group">

	{{ Form::submit('Guardar', ['class' => 'btn btn-success btn-block mb-2']) }}

	<a href="{{ route('roles.index') }}" class="text-decoration-none">{{ Form::button('Volver', ['class' => 'btn btn-secondary btn-block']) }}</a>

</div>