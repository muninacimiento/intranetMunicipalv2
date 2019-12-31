<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{ $permission->id }}">
	
	{!! Form::open(['route'=> ['permissions.destroy', $permission->id], 'method' => 'DELETE']) !!}

		<div class="modal-dialog">
			
			<div class="modal-content">
				
				<div class="modal-header">
					
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						
						<span aria-hidden="true">x</span>

					</button>

					<h4>Eliminar Permiso</h4>

				</div>

				<div class="modal-body">
					
					<p>Confirme {{ $permission->id}}</p>

				</div>

				<div class="modal-footer">
					
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>

					<button class="btn btn-danger" type="submit">Eliminar</button>

				</div>

			</div>

		</div>

	{!! Form::close() !!}


</div>