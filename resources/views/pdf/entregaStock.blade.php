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

		<table width="100%">
			
			<tr>
				
				<td width="30%"><img src="images/MarcaMunicipal_PDF.png"></td>
				<td width="40%"></td>
				<td width="30%"><img src="images/MarcaSisCoM_PDF.png"></td>

			</tr>

		</table>

		<div class="w3-container w3-purple w3-center w3-round-xlarge w3-margin-top">

			<h6 style="text-shadow:1px 1px 0 #444">
			
				Reporte Entrega Productos en Stock

				<small>[ {{ $solicitud->categoriaSolicitud }} ]</small>

			</h6>

		</div>

		<table class="w3-table-all w3-small">
			
			<tr>
				
				<td class="w3-text-gray">No. Solicitud</td>
				<td>{{ $solicitud->id }}</td>
				<td class="w3-text-gray">Fecha Solicitud</td>
				<td>{{ date('d-m-Y H:i:s', strtotime($solicitud->updated_at)) }}</td>
				<td class="w3-text-dark-gray">IDDOC</td>
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

		</table>

		<br>

		<div class="w3-container w3-purple w3-center w3-round-xlarge">

			<h6 style="text-shadow:1px 1px 0 #444">
			
				Detalle de Solicitud

			</h6>

		</div>

		<table class="w3-table-all w3-small w3-striped" id="detalleSolicitud">

			<thead>

				<tr>

					<td style="display: none;">ID</td>

                    <td class="w3-text-gray" style="font-size: 0.5em;">Producto</td>

                    <td class="w3-text-gray" style="font-size: 0.5em;">Especificación</td>

                    <td class="w3-text-gray" style="font-size: 0.5em;">Cantidad Solicitada</td>

                    <td class="w3-text-gray" style="font-size: 0.5em;">Cantidad Entregada</td>

                    <td class="w3-text-gray" style="font-size: 0.5em;">Fecha de Entrega</td>
                                                        
                    <td class="w3-text-gray" style="font-size: 0.5em;">Saldo</td>

                    <td class="w3-text-gray" style="font-size: 0.5em;">Obs</td>

                </tr>

			</thead>

            <tbody>

            	@foreach($detalleSolicitud as $detalle)

                <tr>

                	<td style="display: none;">{{ $detalle->id }}</td>

                    <td>{{ $detalle->Producto }}</td>

                    <td>{{ $detalle->especificacion }}</td>

                    <td>{{ $detalle->cantidad }}</td>

                    <td>{{ $detalle->cantidadEntregada }}</td>

                    <td>{{ date('d-m-Y H:i:s', strtotime($detalle->fechaEntrega)) }}</td>

                    <td>{{ $detalle->Saldo }}</td>     

                    <td>{{ $detalle->obsEntrega }}</td>                                              

                    </tr>

                @endforeach

            </tbody>

        </table>
         
	</body>

</html>