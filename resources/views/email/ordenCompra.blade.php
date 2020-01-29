<!DOCTYPE html>
<html>
<head>
	<title></title>

	<!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/4cf490c3ec.js"></script>

    <!-- Styles 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
    	
    	body {

            font-family: 'Quicksand';
            font-size: 1.1em;

        }

    </style>

</head>
<body class="body">

    <div>
        
        <img src="https://nacimiento.cl/images/Logo-Institucional-Png.png" style="width: 200px;" >

        <br>

        <label>Estimado Proveedor, la I.Municipalidad de Nacimiento, a través de su Depto. de Compras y Suministros, ha emitido la siguiente Órden de Compra a nombre de vuestra razón social.</label>

    </div>

    <br>

    <div>
        
        <label>No. de Órden de Compra : <strong>{{ $oc_mail->ordenCompra_id }}</strong></label><br>
        <label>Monto Órden de Compra : <strong style="font-size: 1em;">$ {{ $oc_mail->totalOrdenCompra }}</strong></label><br>
        <label>Motivo/Destino Órden de Compra : <strong>{{ $sol->motivo }}</strong></label><br>

        <label>Fecha Actividad : <strong>{{ $sol->fechaActividad }}</strong></label><br>
        <label>Hora Actividad : <strong>{{ $sol->horaActividad }}</strong></label><br>
        <label>Lugar de Entrega de Productos o Servicios : <strong>{{ $oc_mail->deptoRecepcion }}</strong></label><br>


    </div>

	<br>

	<div>

		<table id="detalleSolicitud" class="display" width="100%" style="border: 1px;">

			<thead>

				<tr>

					<th>Cantidad</th>

					<th>Producto</th>

					<th>Especificación</th>

				</tr>

				</thead>

            <tbody>

               @foreach($dS as $d)

					<tr>

						<td style="text-align: center;">{{ $d->cantidad }}</td>

                    	<td style="text-align: center;">{{ $d->Producto }}</td>

                    	<td style="text-align: center;">{{ $d->especificacion }}</td>

                    </tr>

                @endforeach

            </tbody>

		</table>

    </div>

    <br>

    <div>

        <label>Realizado dicho servicio o entregados los productos, se agradece enviar la factura o boleta de honorarios al correo facturacion@nacimiento.cl</label><br>
        <label><strong>Favor NO responder este correo, es generado de forma automática.</strong></label>

    </div>

</body>
</html>

<script type="text/javascript">
        
        $(document).ready(function () {
            


            // Start Configuration DataTable
            $('#detalleSolicitud').DataTable({

                "paginate"  : true,

                "order"     : ([0, 'desc']),

                "language"  : {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "No existen Órdenes de Compra generadas por su unidad, aún...",
                            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                            "sInfoPostFix":    "",
                            "sSearch":         "Buscar:",
                            "sUrl":            "",
                            "sInfoThousands":  ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst":    "Primero",
                                "sLast":     "Último",
                                "sNext":     ">>",
                                "sPrevious": "<<"
                            },
                            "oAria": {
                                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            },
                            "buttons": {
                                "copy": "Copiar",
                                "colvis": "Visibilidad"
                            }
                        }

            });
            //End Configuration DataTable
           
         });    

</script>