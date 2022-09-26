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

			&copy;2022 - Sistema de Gestión del Parque Automotriz Municipal <br>
			I.Municipalidad de Nacimiento <br>
			Unidad de Informática

		</footer>

		<table width="100%">
			
			<tr class="container">
				<td width="30%"><img src="images/MarcaMunicipal_PDF.png"></td>
				<td width="40%"></td>
				<FONT SIZE=1>MOVILIZACION Y BODEGA</FONT>
			</tr>

		</table>

		<div class="w3-container w3-purple ">

		<div class="w3-center w3-round-xlarge w3-margin-top">
			<h6  style="text-shadow:1px 1px 0 #444">
				ORDEN DE COMETIDO CONDUCTOR N° {{ $solicitud->idp }}
			</h6>
		</div>
			
			<table class=" w3-small ">

					<tr>
						<td>DE: ENCARGADO DE MOVILIZACION</td>

					</tr>

					<tr>
						<td>A : CONDUCTOR VEHICULO</td>
					</tr>

			</table>
		</div>

		<table class="w3-table-all w3-small">
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td width="18%" class="w3-text-gray">Conductor</td>
				<td>{{ $solicitud->nombre }}</td>
				<td width="18%" class="w3-text-gray" ></td>
				<td></td>
			</tr>

			<tr>
				<td width="18%" class="w3-text-gray" >Unidad Solicitante</td>
				<td>{{ $solicitud->dependencia }}</td>
				<td width="18%" class="w3-text-gray" ></td>
				<td></td>
			</tr>

			<tr>
				<td width="18%" class="w3-text-gray" >Fecha Cometido</td>
				<td>{{ $solicitud->fechaReserva }}</td>
				<td width="18%" class="w3-text-gray" >Hora Cometido</td>
				<td>{{ $solicitud->horaInicio }}</td>
			</tr>
			<tr>
				<td width="18%" class="w3-text-gray" >Fecha Termino Cometido</td>
				<td>{{ $solicitud->fecha_termino }}</td>
				<td width="18%" class="w3-text-gray" >Hora Termino Cometido</td>
				<td>{{ $solicitud->horaTermino }}</td>
			</tr>

			<tr>
				<td width="18%" class="w3-text-gray" >Destino</td>
				<td>{{ $solicitud->destino }}</td>
				<td width="18%" class="w3-text-gray" ></td>
				<td></td>
			</tr>	

		</table>
		<table class="w3-table-all w3-small">
			<tr>
				<td width="18%" class="w3-text-gray" >Objetivo del Cometido</td>
				<td>{{ $solicitud->materia }}</td>
			</tr>
		</table>
		<table class="w3-table-all w3-small">
			<tr>
				<td width="18%" class="w3-text-gray" >Cantidad Funcionarios</td>
				<td></td>
				<td width="18%" class="w3-text-gray" >Cantidad Usuarios Externos</td>
				<td></td>
			</tr>
		</table>

		<br>

		<div class="w3-container w3-purple w3-center w3-round-xlarge">

			<h6 style="text-shadow:1px 1px 0 #444">
				OBSERVACIONES
			</h6>

		</div>

		<table class="w3-table-all w3-small w3-striped" id="">

			<thead>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td width="18%" class="w3-text-gray" >Vehiculo</td>
				<td>{{ $solicitud->patente }} , {{ $solicitud->marca }} , {{ $solicitud->modelo }}</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td width="18%" class="w3-text-gray" >Hora Llegada</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td width="18%" class="w3-text-gray" >Kilometraje Inicio</td>
				<td></td>
				<td width="18%" class="w3-text-gray" >Kilometraje Llegada</td>
				<td></td>
			</tr>
			<tr>
				<td width="18%" class="w3-text-gray" >Carga Combustible N° Boleta</td>
				<td></td>
				<td width="18%" class="w3-text-gray" >Odometro</td>
				<td></td>
			</tr>
			<tr>
				<td width="18%" class="w3-text-gray" >Cantidad Peajes</td>
				<td></td>
				<td width="18%" class="w3-text-gray" >Total $</td>
				<td></td>
			</tr>
			<tr>
				<td width="18%" class="w3-text-gray" >Otras Observaciones </td>
				<td></td>
				<td width="18%" class="w3-text-gray" ></td>
				<td></td>
			</tr>
				

			</thead>

            <tbody>

            	

            </tbody>

        </table><br><br>
		<table class="w3-table w3-small w3-center">

        	<tr>
        		<td>_________________________</td>
        		<td></td>
        		<td>_________________________</td>
        	</tr>
        	<tr>
        		<td>HERALDO MEDINA OÑATE <br> ENCARGADO DE MOVILIZACION<</td>
        		<td></td>
        		<td>{{ $solicitud->nombre }} <br> CONDUCTOR </td>
        	</tr>
        </table>
         
	</body>

</html>