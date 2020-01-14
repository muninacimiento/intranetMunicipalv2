<!DOCTYPE html>

<html>

	<head>
		
		<link rel="stylesheet" type="text/css" href="css/css.css">

		<style>
			
			.page-break {
			    page-break-after: always;
			}

			footer { 
				position: fixed; 
				bottom: -60px; 
				left: 0px; 
				right: 0px; 
				color:gray;
				text-align: center;
				font-size: 0.7em;
				height: 70px; }

		</style>

	</head>

	<body>

		<footer>

			&copy;2020 - Sistema de Compras Municipales <br>
			I.Municipalidad de Nacimiento <br>
			Unidad de Informática

		</footer>

{{-- INICIO ENCABEZADO DEL PDF --}}
		<table width="100%">
			
			<tr>
				
				<td width="30%"><img src="images/MarcaMunicipal_PDF.png"></td>
				<td width="40%"></td>
				<td width="30%"><img src="images/MarcaSisCoM_PDF.png"></td>

			</tr>

		</table>
{{-- FIN ENCABEZADO DEL PDF --}}

		<div class="w3-container w3-deep-orange w3-center">

			<h4 style="text-shadow:1px 1px 0 #444">
			
				Solicitud {{ $solicitud->tipoSolicitud }}

			</h4>

		</div>

{{-- INICIO ENCABEZADO SOLICITUD DEL PDF --}}
		<table class="w3-table-all w3-medium">
			
			<tr>
				
				<td width="18%" class="w3-text-gray">No. Solicitud</td>
				<td>{{ $solicitud->id }}</td>
				<td width="18%" class="w3-text-gray">Fecha Solicitud</td>
				<td>{{ date('d-m-Y H:i:s', strtotime($solicitud->updated_at)) }}</td>
				<td width="18%" class="w3-text-dark-gray">IDDOC</td>
				<td></td>

			</tr>

			<tr>
				
				<td width="18%" class="w3-text-gray">Solicitante</td>
				<td>{{ $solicitud->nameUser }}</td>
				<td width="18%" class="w3-text-gray">Dependencia</td>
				<td colspan="3">{{ $solicitud->dependencyUser }}</td>

			</tr>

			<tr>
				
				<td width="18%" class="w3-text-gray">Motivo/Destino</td>
				<td colspan="5">{{ $solicitud->motivo }}</td>

			</tr>

			<tr>
				
				<td width="18%" class="w3-text-gray">Decreto Programa</td>
				<td>{{ $solicitud->decretoPrograma }}</td>
				<td width="18%" class="w3-text-gray">Nombre Programa</td>
				<td colspan="3">{{ $solicitud->nombrePrograma }}</td>

			</tr>

		</table>
{{-- FIN ENCABEZADO SOLICITUD DEL PDF --}}

		<br>

{{-- INICIO DETALLE ACTIVIDAD DEL PDF --}}

		<div class="w3-center w3-dark-grey">
			
			<h6>Detalle de la Actividad</h6>

		</div>

		<table class="w3-table-all w3-small page-break">
			
			<tr>

				<td class="w3-dark-grey">Nombre Actividad</td>
				<td colspan="3">{{ $solicitud->nombreActividad }}</td>

			</tr>

			<tr>
				
				<td class="w3-dark-grey">Fecha de la Actividad</td>
				<td>{{ date('d-m-Y', strtotime($solicitud->fechaActividad)) }}</td>	
				<td class="w3-dark-grey">Horade la Actividad</td>
				<td>{{ $solicitud->horaActividad }}</td>	

			</tr>

			<tr>
				
				<td class="w3-dark-grey">Lugar de la Actividad</td>
				<td>{{ $solicitud->lugarActividad }}</td>

			</tr>

			<tr>
				
				<td class="w3-dark-grey">Objetivo de la Actividad</td>
				<td colspan="3">{{ $solicitud->objetivoActividad }}</td>	

			</tr>

			<tr>
				
				<td class="w3-dark-grey">Descripción de la Actividad</td>
				<td colspan="3">{{ $solicitud->descripcionActividad }}</td>	

			</tr>

			<tr>
				
				<td class="w3-dark-grey">Participantes de la Actividad</td>
				<td colspan="3">{{ $solicitud->participantesActividad }}</td>	

			</tr>

			<tr>
				
				<td class="w3-dark-grey">Cuenta Presupuestaria</td>
				<td colspan="3">{{ $solicitud->cuentaPresupuestaria }}</td>	

			</tr>

			<tr>
				
				<td class="w3-dark-grey">Cuenta Complementaria</td>

				@if($solicitud->cuentaComplementaria == '')
					<td colspan="3">No Aplica</td>
				@else

					<td colspan="3">{{ $solicitud->cuentaComplementaria }}</td>	
				@endif

			</tr>

			<tr>
				
				<td class="w3-dark-grey">Observación de la Actividad</td>
				<td colspan="3">{{ $solicitud->obsActividad }}</td>	

			</tr>

		</table>

{{-- FIN DETALLE ACTIVIDAD DEL PDF --}}

		<div class="w3-center w3-orange">
			
			<h6>Detalle Solicitud</h6>

		</div>

{{-- INICIO DETALLE SOLICITUD DEL PDF --}}
		<table class="w3-table-all w3-small w3-striped">

			<thead>

				<tr class="w3-orange w3-center-align">

					<th style="display: none;">ID</th>

                    <th>Producto</th>

                    <th>Especificación</th>

                    <th class="w3-right-align">Cantidad</th>

                    <th class="w3-right-align">Valor</th>
                                                        
                    <th class="w3-right-align">SubTotal</th>

                </tr>

			</thead>

            <tbody>

            	@foreach($detalleSolicitud as $detalle)

                <tr>

                	<td style="display: none;">{{ $detalle->id }}</td>

                    <td>{{ $detalle->Producto }}</td>

                    <td>{{ $detalle->especificacion }}</td>

                    <td class="w3-right-align">{{ $detalle->cantidad }}</td>

                    <td class="w3-right-align">$ {{ $detalle->valorUnitario }}</td>

                    <td class="w3-right-align">$ {{ $detalle->SubTotal }}</td>                                               

                    </tr>

                @endforeach

                <tr class="w3-medium">
                	
                	<td colspan="4"><strong>Total</strong></td>
                	<td class="w3-right-align"><strong>$ {{ $solicitud->total }}</strong></td>

                </tr>

            </tbody>

        </table>
{{-- FIN DETALLE SOLICITUD DEL PDF --}}

		<br>
		<br>
		<br>

{{-- INICIO FIRMAS DEL PDF --}}
        <table class="w3-table w3-small w3-center">

        	<tr>
        		
        		<td>__________________</td>
        		<td>__________________</td>
        		<td>_________________________</td>

        	</tr>
        	
        	<tr>
        		
        		<td>Firma Solicitante</td>
        		<td>Firma Jefe Directo</td>
        		<td>Firma Alcalde/Administrador</td>

        	</tr>

        </table>
{{-- FIN FIRMAS DEL PDF --}}
         
	</body>

</html>