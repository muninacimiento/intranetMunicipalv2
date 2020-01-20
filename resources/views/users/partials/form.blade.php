@csrf

<div class="form-row">

	<div class="col-md-6 mb-3">

		{{ Form::label('name', 'Nombre Usuario') }}

		{{ Form::text('name', null, ['class' => 'form-control', 'required']) }}

		<div class="invalid-feedback">

			<label>Por favor ingrese el Nombre del Usuario</label>

		</div>

	</div>

	<div class="col-md-6 mb-3">

		{{ Form::label('email', 'Correo Institucional') }}

		{{ Form::text('email', null, ['class' => 'form-control', 'required']) }}

		<div class="invalid-feedback">

			<label>Por favor ingrese el Correo del Usuario</label>

		</div>

	</div>
	
</div>

<div class="form-row mb-3">

        <label for="dependencySelect">Dependencia Municipal</label>

        <select name="dependency_id" class="browser-default custom-select" title="Por favor, seleecione su Dependencia Municipal">

        @foreach($dependencies as $dependency)

            <option value="{{ $dependency->id }}">{{ $dependency->name }}</option>

        @endforeach

        </select>

    </div>


<div class="form-row mb-3">

	<h5>Lista de Roles</h5>

</div>

<div class="form-row mb-3">

	<ul class="list-unstyled">
		
		@foreach($roles as $role)

			<li>
				
				<label>
                                            
                    {{ Form::checkbox('roles[]', $role->id, null) }}

                    <strong>{{ $role->name }} /</strong> <em style="font-size: 0.8em;">{{ $role->description }}</em>

                </label>

			</li>

		@endforeach

	</ul>

</div>

<div class="form-group">

	{{ Form::submit('Guardar', ['class' => 'btn btn-success btn-block mb-2']) }}

	<a href="{{ route('users.index') }}" class="text-decoration-none">{{ Form::button('Volver', ['class' => 'btn btn-secondary btn-block']) }}</a>

</div>