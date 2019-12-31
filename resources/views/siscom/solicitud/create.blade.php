
<!--
/*
 *  JFuentealba @itux
 *  created at September 10, 2019 - 11:46 am
 *  updated at October 14, 2019 - 11:59 am
 */
-->

<form method="POST" action="{{ route('siscom.solicitudGeneral.store') }}" class="was-validated">

	@csrf

	<div class="form-row">

		<div class="col-md-12 mb-3">
														      
			<label for="Motivo">Motivo</label>

			<textarea type="text" class="form-control" id="motivo" name="motivo" placeholder="Ingrese el Motivo de su Solicitud" required></textarea>

			<div class="invalid-feedback">
														        			
				Por favor ingrese el Motivo de la Solicitud

			</div>

		</div>

	</div>

	<div class="form-row mb-5">

		<div class="form-group col-md-6 mb-3">

			<label for="tipoSolicitud">Tipo Solicitud</label>

	    	<select name="tipoSolicitud" class="custom-select" required>

	      		<option value="">Selecciones el Tipo de Solicitud</option>

	      		@foreach($tipoSolicituds as $tipoSolicitud)

	            	<option value="{{ $tipoSolicitud->id }}">{{ $tipoSolicitud->tipo }}</option>

	            @endforeach

	    	</select>

	    	<div class="invalid-feedback">

	    		Por favor seleccione el Tipo de Solicitud

	    	</div>

		</div>

		<div class="form-group col-md-6 mb-3">

			<label for="categoriaSolicitud">Categoria Solicitud</label>

	        <select name="categoriaSolicitud" class="custom-select" required>

	        	<option value="">Selecciones la Categoria de la Solicitud</option>

	        	@foreach($categoriaSolicituds as $categoriaSolicitud)

	            	<option value="{{ $categoriaSolicitud->id }}">{{ $categoriaSolicitud->categoria }}</option>

	            @endforeach

	        </select>
															      		
			<div class="invalid-feedback">
															        		
				Por favor seleccione la Categoria de la Solicitud

			</div>
													    	
		</div>	

	</div>

	<div class="mb-3 form-row" id="guardarForm">

		<button class="btn btn-success btn-block" type="submit">

			<i class="fas fa-save"></i>

			Guardar Solicitud

		</button>

		<button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

			<i class="fas fa-arrow-left"></i>

			Cancelar

		</button>

	</div>

</form>
