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
        <img src="{{ asset('images/LogoMunicipal_Mail.png')}}">   
        <br>

        <label>Estimado <strong>Sr. Heraldo Medina</strong> </label><br><br>
        <label>Mediante el presente mail, a través del Sistema de Gestión del Parque Automotriz Municipal, queremos informarle que el siguiente vehículo requiere mantención:</label>

    </div>

    <br>

    <div>
        
        <label>Placa Patente : <strong>{{ $vehiculo->Patente }}</strong></label><br>
        @if($vehiculo->tipoMantencion === 1)
        <label>Tipo Mantencion : <strong>Cambio de Aceite</strong></label><br>
        @elseif($vehiculo->tipoMantencion === 2)
        <label>Tipo Mantencion : <strong>Cambio de Correas</strong></label><br>
        @elseif($vehiculo->tipoMantencion === 3)
        <label>Tipo Mantencion : <strong>Cambio de Neumáticos</strong></label><br>
        @endif

    </div>
	<br>
    <div>

        <label>Favor gestionar dicha mantención para que el vehículo pueda estar disponible para reserva de cometidos.</label><br>
        <label>Favor NO responder este correo, es generado de forma automática.</label><br><br>
        <label>Cordialmente</label><br><br>
        <label><strong>Sistema de Gestión del Parque Automotriz Municipal</strong></label>

    </div>

</body>
</html>