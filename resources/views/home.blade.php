<style>   
h1 {
  text-align: center;
}
</style>
@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
    $(document).ready(function(){     
        $('#submit').click(function(){  
            let email = window.sessionStorage.getItem("emailLog");
            document.getElementById("submit").innerHTML = email;
            let prueba = location.href="http://165.1.2.146:3000/buzon/"+email;
        });
    });
</script>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                            
                        </div>
                    @endif

                  <h1>Bienvenid@! </h1>
                </div>
                <button type="submit" id ="submit" class="btn btn-success btn-block">Enviar</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

<!-- JQuery DataTable -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js" ></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>

<!-- JQuery DatePicker -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>

    $(document).ready(function() {
        
        $( "#datepicker" ).datepicker({
            dateFormat: "dd/mm/yy",
            minDate: "+14d",
            firstDay: 1,
            dayNamesMin: [ "Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab" ],
            monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
            numberOfMonths: 2,
            showOn: "button",   
        });
        
    } );

</script>


@endpush
