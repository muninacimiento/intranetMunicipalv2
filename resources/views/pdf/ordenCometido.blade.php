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
			<h6  style="text-shadow:1px 1px 0 #444">
				N° SOLICITUD DE COMETIDO  {{ $solicitud->iddocSolicitud }}
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
				<td width="18%" class="w3-text">Conductor</td>
				<td>{{ $solicitud->nombre }}</td>
				<td width="18%" class="w3-text" ></td>
				<td></td>
			</tr>

			<tr>
				<td width="18%" class="w3-text" >Unidad Solicitante</td>
				<td>{{ $solicitud->dependencia }}</td>
				<td width="18%" class="w3-text" ></td>
				<td></td>
			</tr>

			<tr>
				<td width="18%" class="w3-tex" >Fecha Cometido</td>
				<td>{{ $solicitud->fechaReserva }}</td>
				<td width="18%" class="w3-text" >Hora Cometido</td>
				<td>{{ $solicitud->horaInicio }}</td>
			</tr>
			<tr>
				<td width="18%" class="w3-text" >Fecha Termino Cometido</td>
				<td>{{ $solicitud->fecha_termino }}</td>
				<td width="18%" class="w3-text" >Hora Termino Cometido</td>
				<td>{{ $solicitud->horaTermino }}</td>
			</tr>	

		</table>
		<table class="w3-table-all w3-small">
			<tr>
				<td width="18%" class="w3-text" bgcolor="white"  >Destino</td>
				<td bgcolor="white">{{ $solicitud->destino }}</td>
			</tr>
		</table>
		<table class="w3-table-all w3-small">
			<tr>
				<td width="18%" class="w3-text"  >Objetivo del Cometido</td>
				<td>{{ $solicitud->materia }}</td>
			</tr>
		</table>
		<table class="w3-table-all w3-small">
			<tr>
				<td width="18%" class="w3-text"  bgcolor="white">Cantidad Funcionarios</td>
				<td  bgcolor="white"> {{ $solicitud->cant_funcionarios }}</td>
				<td width="18%" class="w3-text"  bgcolor="white" >Cantidad Usuarios Externos</td>
				<td  bgcolor="white"> {{ $solicitud->cant_usuarios_externos }}</td>
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
				<td width="18%" class="w3-text" >Vehiculo</td>
				<td>{{ $solicitud->patente }} , {{ $solicitud->marca }} , {{ $solicitud->modelo }}</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td width="18%" class="w3-text" >Hora Llegada</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td width="18%" class="w3-text" >Kilometraje Inicio</td>
				<td></td>
				<td width="18%" class="w3-text" >Kilometraje Llegada</td>
				<td></td>
			</tr>
			<tr>
				<td width="18%" class="w3-text" >Carga Combustible N° Boleta</td>
				<td></td>
				<td width="18%" class="w3-text" >Odometro</td>
				<td></td>
			</tr>
			<tr>
				<td width="18%" class="w3-text" >Cantidad Peajes</td>
				<td></td>
				<td width="18%" class="w3-text" >Total $</td>
				<td></td>
			</tr>
			<tr>
				<td width="18%" class="w3-text" >Otras Observaciones </td>
				<td></td>
				<td width="18%" class="w3-text" ></td>
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
        		<td>HERALDO MEDINA OÑATE <br> ENCARGADO DE MOVILIZACION </td>
        		<td></td>
        		<td>{{ $solicitud->nombre }} <br> CONDUCTOR </td>
        	</tr>
        </table>
         
	</body>

</html>