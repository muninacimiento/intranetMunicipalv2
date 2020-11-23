@extends('layouts.app')

@section('content')

<div id="allWindow">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card border-primary shadow">

                <div class="card-header text-center text-white bg-primary mb-3">

                    @include('siscom.menu')

                </div>

                    <div class="card-body">

                        @if (session('status'))
    
                            <div class="alert alert-success" role="alert">

                                {{ session('status') }}
                            
                            </div>

                        @endif

                        <a href="{{action('BoletaGarantiaController@index')}}" class="btn btn-link text-decoration-none float-right"> <i class="far fa-arrow-alt-circle-left"></i> Volver</a>

                        <h4> Número Boleta: {{ $boleta->numeroBoleta }}</h4>


                         <hr style="background-color: #d7d7d7">

                        <div class="py-3">

                            <div class="container">

                                <div class="form-row">

                                    <div class="col-md-6">

                                    	<div class="form-row">
                                            
                                            <label class="col-sm-3 col-form-label text-muted">Estado</label>
                                                                        
                                            <label class="col-sm-9 col-form-label">{{ $boleta->Estado }}</label>

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class=" col-sm-3 col-form-label text-muted">Banco de la Boleta de Garantía</label>
                                                                        
                                            <label class=" col-sm-9 col-form-label">{{ $boleta->banco }}</label>     

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class=" col-sm-3 col-form-label text-muted">Monto Boleta de Garantía ($)</label>
                                                                        
                                            <label class=" col-sm-9 col-form-label">{{ $boleta->montoBoleta }}</label>     

                                        </div>

                                    </div>

                                    <div class="col-6">

                                        @if($boleta->estado_id === 1)

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#enviarCustodia">

                                                <button class="btn btn-success btn-block mb-1">

                                                    <i class="fas fa-check-double"></i> 

                                                    Enviar a Custodia

                                                </button>

                                            </a>

                                        @else

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-check-double"></i> 

                                                    Enviar a Custodia

                                                </button>

                                            </a>

                                        @endif

                                        @if($boleta->estado_id === 3)

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#recepcionarSolicitudDevolucion">

                                                <button class="btn btn-success btn-block mb-1">

                                                    <i class="fas fa-check-double"></i> 

                                                    Recepcionar Solicitud de Devolución

                                                </button>

                                            </a>

                                        @else

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-check-double"></i> 

                                                    Recepcionar Solicitud de Devolución

                                                </button>

                                            </a>

                                        @endif

                                        @if($boleta->estado_id === 4)

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#devolverBoleta">

                                                <button class="btn btn-success btn-block mb-1" >

                                                    <i class="fas fa-check-double"></i> 

                                                    Devolver Boleta

                                                </button>

                                            </a>

                                        @else

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-check-double"></i> 

                                                    Devolver Boleta

                                                </button>

                                            </a>

                                        @endif

                                    </div>

                                </div>

                            </div>

                            <hr style="background-color: #d7d7d7">

                        </div>

                    </div>
                
                </div>
            </div>

        </div>

    </div>
        
</div>

<!-- Modal Enviar a Custodia la Boleta -->
<div class="modal fade" id="enviarCustodia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered " role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-up"></i> Enviar a Custodia Boleta de Garantía</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('boletaGarantia.update', $boleta->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="EnviarACustodia">

                <div class="modal-body">

                    <div class="form">

                        <div class="form-group">
                                            
                            <label>Número de la Boleta de Garantía</label>
                                                                        
                            <input type="text" readonly class="text-muted form-control-plaintext" value="{{ $boleta->numeroBoleta }}">
                                                        
                            <input type="hidden" name="boleta_id" value="{{ $boleta->id }}">   

                        </div>

                        <div class="form-group">
                                            
                            <label>Fecha Aprobación</label>
                                                                        
                            <input type="text" readonly class="text-muted form-control-plaintext" value="{{ $dateCarbon }}">

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Enviar a Custodia

                        </button>

                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- END Modal Enviar a Custodia la Boleta -->

<!-- Modal Recepcionar Solicitud de Devolucion -->
<div class="modal fade" id="recepcionarSolicitudDevolucion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered " role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-up"></i> Recepcionar la Solicitud de Devolución</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('boletaGarantia.update', $boleta->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="SolicitudDevolucion">

                <div class="modal-body">

                    <div class="form">

                        <div class="form-group">
                                            
                            <label>Número de la Boleta de Garantía</label>
                                                                        
                            <input type="text" readonly class="text-muted form-control-plaintext" value="{{ $boleta->numeroBoleta }}">
                                                        
                            <input type="hidden" name="boleta_id" value="{{ $boleta->id }}">   

                        </div>

                        <div class="form-group">
                                            
                            <label>Fecha Aprobación</label>
                                                                        
                            <input type="text" readonly class="text-muted form-control-plaintext" value="{{ $dateCarbon }}">

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Recepcionar Solicitud de Devolución

                        </button>

                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- END Modal Recepcionar Solicitud de Devolucion -->

<!-- Modal Devolver la Boleta -->
<div class="modal fade" id="devolverBoleta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered " role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-up"></i> Devolución de la Boleta de Garantía</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('boletaGarantia.update', $boleta->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="DevolverBoleta">

                <div class="modal-body">

                    <div class="form">

                        <div class="form-group">
                                            
                            <label>Número de la Boleta de Garantía</label>
                                                                        
                            <input type="text" readonly class="text-muted form-control-plaintext" value="{{ $boleta->numeroBoleta }}">
                                                        
                            <input type="hidden" name="boleta_id" value="{{ $boleta->id }}">   

                        </div>

                        <div class="form-group">
                                            
                            <label>Fecha Aprobación</label>
                                                                        
                            <input type="text" readonly class="text-muted form-control-plaintext" value="{{ $dateCarbon }}">

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Devolución de la Boleta

                        </button>

                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- END Modal Devolver la Boleta -->

@endsection

@push('scripts')

<script>
    
    $(document).ready(function () {

        var height = $(window).height();
            $('#allWindow').height(height);

            // Start Configuration DataTable Detalle Solicitud
            var table = $('#detalleSolicitudValidar').DataTable({
                "paginate"  : true,

                "ordering": false,

                "order"     : ([0, 'desc']),

                "language"  : {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "No existen Productos en su Solicitud para su validación",
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

            
    });


</script>

@endpush