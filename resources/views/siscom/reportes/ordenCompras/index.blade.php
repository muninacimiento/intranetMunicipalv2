<!--
/*
 *  JFuentealba @itux
 *  created at December 26, 2019 - 11:28 pm
 *  updated at January 22, 2010 - 10:18 am
 */
-->
@extends('layouts.app')
@section('content')
<div id="allWindow">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card border-primary shadow">
                <div class="card-header text-center text-white bg-primary">
                    @include('siscom.menu')
                </div>
                <div class="card-body">
                    <div class="row py-3">
                        <div class="col text-center">                            
                            <h3>Informe de Órdenes de Compra Gestionadas</h3>
                            <div class="text-secondary">
                                {{ $dateCarbon }}
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    @if(count($errors))
                        <div class="alert alert-danger alert-dismissible fade show shadow mb-3" role="alert">          
                            <ul>
                                @foreach($errors->all() as $error)
                                <li><i class="icofont-close-circled h5"></i> {{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('info'))
                        <div class="alert alert-success alert-dismissible fade show shadow mb-3" role="alert">                              
                            <i class="icofont-check-circled h5"></i><strong> {{ session('info') }} </strong>                            
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">                            
                                <span aria-hidden="true">&times;</span>                              
                            </button>
                        </div>                   
                    @endif
                    @if (session('danger'))
                        <div class="alert alert-danger alert-dismissible fade show shadow mb-3" role="alert">                              
                            <i class="icofont-check-circled"></i><strong> {{ session('danger') }} </strong>                            
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">                            
                                <span aria-hidden="true">&times;</span>                              
                            </button>
                        </div>                   
                    @endif
                    <form class="form-inline" method="GET" action="{{ route('buscar.oc') }}">
                        <div class="col"> 
                            <select name="proveedor_id" id="proveedor_id" class="form-control selectpicker" data-live-search="true" title="Seleccione al Proveedor" required>
                                @foreach($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}">{{ $proveedor->RazonSocial }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col"> 
                            <select name="status_id" id="status_id" class="form-control selectpicker" data-live-search="true" title="Seleccione el Estado" required >
                                @foreach($status as $estado)
                                    <option value="{{ $estado->id }}">{{ $estado->Estado }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <input type="text" id="fechaInicio" name="fechaInicio" class="form-control" placeholder="Fecha de Inicio" required/>
                            <div class="invalid-feedback">                                                                                                        
                                Por favor ingrese la Fecha de Inicio
                            </div>
                        </div>
                        <div class="col">
                            <input type="text" id="fechaTermino" name="fechaTermino" class="form-control" placeholder="Fecha de Termino" required/>
                            <div class="invalid-feedback">                                                                                                        
                                Por favor ingrese la Fecha de Termino
                            </div>
                        </div>
                        <div class="col-sm-3">                            
                            <button type="submit" class="btn btn-warning btn-block">Consultar</button>
                        </div>
                    </form>
                    <hr class="my-4">        
                    <div>
                        <table class="display" id="ordenCompraTable" style="font-size: 0.9em;" width="100%">
                            <thead>
                                <tr class="table-active">
                                    <th style="display: none">ID</th>
                                    <th>ID O.C.</th>
                                    <th>IDDOC</th>
                                    <th>Creada</th>
                                    <th>Estado</th>
                                    <th>Comprador</th>                                    
                                    <th style="display: none">Tipo</th>
                                    <th style="display: none">Valor Estimado</th>
                                    <th style="display: none">Total $</th>                                    
                                    <th>Excepción</th>                                    
                                    <th>Proveedor</th>
                                    <th>Tipo de O.C.</th>
                                    <th style="display: none">Enviada al Proveedor</th>
                                    <th style="display: none">Depto. que Recepciona</th>
                                    <th style="display: none">Mercado Publico</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ordenesCompra as $oc)
                                <tr>
                                    <td style="display: none">{{ $oc->id }}</td>
                                    <td>{{ $oc->ordenCompra_id }}</td>
                                    <td>{{ $oc->iddoc }}</td>
                                    <td>{{ date('d-m-Y H:i:s', strtotime($oc->created_at)) }}</td>
                                    <td>{{ $oc->Estado }}</td>
                                    <td>{{ $oc->Comprador }}</td>
                                    <td style="display: none">{{ $oc->tipoOrdenCompra }}</td>
                                    <td style="display: none">{{ $oc->valorEstimado }}</td>
                                    <td style="display: none">{{ $oc->totalOrdenCompra }}</td>
                                    <td>{{ $oc->excepcion }}</td>                                    
                                    <td>{{ $oc->RazonSocial }}</td>
                                    <td>{{ $oc->tipoOrdenCompra }}</td>
                                    <td style="display: none">{{ $oc->enviadaProveedor }}</td>
                                    <td style="display: none">{{ $oc->deptoRecepcion }}</td>
                                    <td style="display: none">{{ $oc->mercadoPublico }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript">        
        $(document).ready(function () {
            $( "#fechaInicio" ).datepicker({
                dateFormat: "yy-mm-dd",
                firstDay: 1,
                dayNamesMin: [ "Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab" ],
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
            });
            $( "#fechaTermino" ).datepicker({
                dateFormat: "yy-mm-dd",
                firstDay: 1,
                dayNamesMin: [ "Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab" ],
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
            });
            // Start Configuration DataTable
            var table = $('#ordenCompraTable').DataTable({
                "paginate"  : true,
                "order"     : ([0, 'desc']),
                "language"  : {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "Realice una búsqueda de acuerdo a los parámetros, para cargar la tabla...",
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
@endpush  