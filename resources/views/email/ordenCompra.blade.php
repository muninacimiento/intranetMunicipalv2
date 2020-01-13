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

	<p>Estimado Proveedor, la I.Municipalidad de Nacimiento, a través de de su Depto. de Compras y Suministros, ha emitido la siguiente Órden de Compra <strong>ID {{ $oc_mail->ordenCompra_id }}</strong>, a vuestra razón social, el cual deberá ser recepcionado en {{ $oc_mail->deptoRecepcion }}</p>

	<br>

	<div>

		<table>

			<thead>

				<tr>

					<th>Cantidad</th>

					<th>Producto</th>

					<th>Especificación</th>

				</tr>

				</thead>

            <tbody>

               @foreach($detalleSolicitud as $d)

					<tr>

						<td>{{ $d->cantidad }}</td>

                    	<td>{{ $d->Producto }}</td>

                    	<td>{{ $d->especificacion }}</td>

                    </tr>

                @endforeach

            </tbody>

		</table>

    </div>

</body>
</html>