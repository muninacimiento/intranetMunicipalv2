<!--
/*
 *  JFuentealba @itux
 *  created at December 23, 2019 - 3:45 pm
 *  updated at December 23, 2019 - 3:47 pm
 */
-->

@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col">

            <div class="card border-danger shadow">

                <div class="card-header text-center text-white bg-danger">

                    @include('farmacia.menu')

                </div>


                <div class="card-body">

                    <div class="row py-3">

                        <div class="col-md-6 text-center">
                            
                            <h3>Gestión de Medicamentos</h3>

                            <div class="text-secondary">

                                {{ $dateCarbon }}

                            </div>

                        </div>

                        <!-- Button trigger Crear Usuario -->
                        <div class="col-md-6">
                            
                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#createMedicamentoModal">

                                <button class="btn btn-warning btn-block boton">

                                    <i class="fas fa-prescription-bottle px-2"></i>

                                    Nuevo Medicamento

                                </button>

                            </a>
                            
                        </div>

                    </div>

                    <hr class="my-4">

                    @if (session('info'))

                        <div class="alert alert-success alert-dismissible fade show shadow mb-3" role="alert">
                              
                            <i class="fas fa-check-circle"></i>
                             
                            <strong> {{ session('info') }} </strong>
                            
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            
                                <span aria-hidden="true">&times;</span>
                              
                            </button>

                        </div>
                   
                    @endif

                    
                    <div>

                        <table class="display" id="medicamentosTable" style="font-size: 0.8em;">

                            <thead>

                                <tr class="table-active">

                                    <th>ID</th>

                                    <th>Categoria</th>

                                    <th>Medicamento</th>

                                    <th>Principio Activo</th>

                                    <th>Laboratorio</th>

                                    <th>Lote</th>
                                    
                                    <th>Fecha Vencimiento</th>
                                    
                                    <th>Stock</th>

                                    <th>$ Inventario</th>

                                    <th>Total Inventario</th>

                                    <th>Acciones</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($medicamentos as $medicamento)

                                <tr>

                                    <td>{{ $medicamento->id }}</td>

                                    <td>{{ $medicamento->Categoria }}</td>

                                    <td>{{ $medicamento->medicamento }}</td>

                                    <td>{{ $medicamento->principioActivo }}</td>

                                    <td>{{ $medicamento->laboratorio }}</td>

                                    <td>{{ $medicamento->lote }}</td>

                                    <td>{{ $medicamento->fechaVencimiento }}</td>

                                    <td>{{ $medicamento->stock }}</td>

                                    <td>{{ $medicamento->precioInventario  }}</td>

                                    <td>{{ $medicamento->totalInventario }}</td>

                                    <td>

                                        <div class="btn-group" role="group">

                                            <a href="#" class="btn btn-warning btn-sm mr-1 actualizar" data-toggle="tooltip" data-placement="bottom" title="Actualizar Medicmento">
                                                    
                                                <i class="fas fa-pencil-alt"></i>

                                            </a>

                                            {!! Form::open(['route'=> ['medicamento.destroy', $medicamento->id], 'method' => 'DELETE']) !!}

                                                <button class="btn btn-danger btn-sm mr-1">

                                                    <i class="fas fa-trash"></i>

                                                </button>

                                            {!! Form::close() !!}

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                            </tbody>

                            <tfoot>

                                <tr class="table-active">

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                            </tfoot>

                        </table>

                        <form class="form-inline float-right mt-3">
                                            
                            <label class="my-1 mr-2 h5 text-muted" for="inlineFormCustomInput">Total Inventario : $ </label>

                            <input type="text" name="totalInventario" id="total" readonly style="border: 0;font-size: 1.5em;">

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Creación Nuevo Medicamento -->
<div class="modal fade" id="createMedicamentoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        
        <div class="modal-content">
            
            <div class="modal-header bg-warning">
                
                <p class="modal-title" id="tituloLabel" style="font-size: 1.2em"><i class="fas fa-prescription-bottle px-2"></i> Nuevo Medicamento</p>
                    
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        
                    <span aria-hidden="true">&times;</span>
                
                </button>

            </div>
        
            <form method="POST" action="{{ action('MedicamentoController@store') }}" class="was-validated" id="medicamentoForm">

                @csrf
            
            <div class="modal-body">
                
                <div class="form-row">

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="categoria">Categoria</label>

                            <select name="categoria_id" id="categoriaUpdate" class="form-control selectpicker" data-live-search="true" title="Seleccione la Categoria de su medicamento" required>

                                @foreach($categorias as $categoria)

                                    <option value="{{ $categoria->id }}">{{ $categoria->Categorias }}</option>
                                                                
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="name">Medicamento</label>

                            <input type="text" class="form-control" id="medicamento" name="medicamento" placeholder="Bion 3" required>

                            <div class="invalid-feedback">

                                Por favor Ingrese el Medicamento

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-sm-6">

                            <label for="principioActivo">Principio Activo</label>

                            <input type="text" id="principioActivo" name="principioActivo" class="form-control" placeholder="Probiótico" required/>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese la Principio Activo

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="laboratorio">Laboratorio</label>

                            <input type="text" class="form-control" id="laboratorio" name="laboratorio" placeholder="MERCK" required>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese la Laboratorio

                            </div>

                        </div>

                    </div>

                    <div class="form-row">
                        
                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="lote">Lote</label>

                            <input type="text" class="form-control" id="lote" name="lote" placeholder="90895601" required>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese la Lote 

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="fechaVencimiento">Fecha Vencimiento</label>

                            <input type="text" class="form-control" id="fechaVencimiento" name="fechaVencimiento" placeholder="1900-01-01" required>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese un Fecha Vencimiento 

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="stock">Stock</label>

                            <input type="number" min="0" class="form-control" id="stock" name="stock" placeholder="100" required>
                            
                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese un Stock

                            </div>

                        </div>
                        
                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="precioComercio">Precio Comercio</label>

                            <input type="number" min="0" class="form-control" id="precioComercio" name="precioComercio" placeholder="$ 10000" required>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese el Precio Comercio 

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="precioInventario">Precio Inventario</label>

                            <input type="number" min="0" class="form-control" id="precioInventario" name="precioInventario" placeholder="$ 1000" required>
                            
                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese el Precio Inventario

                            </div>

                        </div>

                    </div>
                

                <div class="form-row">

                    <button type="submit" class="btn btn-success btn-block">

                        <i class="fas fa-check-circle"></i>

                        Guardar Medicamento

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
<!-- Crear Nuevo Medicamento -->

<!-- Actualizar Medicamento -->
<div class="modal fade" id="updateMedicamentoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        
        <div class="modal-content">
            
            <div class="modal-header bg-warning">
                
                <p class="modal-title" id="tituloLabel" style="font-size: 1.2em"><i class="fas fa-user-edit px-2"></i> Actualizar Medicamento</p>
                    
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        
                    <span aria-hidden="true">&times;</span>
                
                </button>

            </div>
        
            <form method="POST" action="#" class="was-validated" id="updateMedicamentoForm">

                @csrf

                @method('PUT')
            
            <div class="modal-body">
                
                <div class="form-row">

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="categoria">Categoria</label>

                            <select name="categoria_id" id="categoria_id" class="form-control selectpicker" data-live-search="true" title="Seleccione la Categoria de su medicamento" required>

                                @foreach($categorias as $categoria)

                                    <option value="{{ $categoria->id }}">{{ $categoria->Categorias }}</option>
                                                                
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="name">Medicamento</label>

                            <input type="text" class="form-control" id="medicamentoUpdate" name="medicamento" placeholder="Bion 3" required>

                            <div class="invalid-feedback">

                                Por favor Ingrese el Medicamento

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-sm-6">

                            <label for="principioActivo">Principio Activo</label>

                            <input type="text" id="principioActivoUpdate" name="principioActivo" class="form-control" placeholder="Probiótico" required/>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese la Principio Activo

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="laboratorio">Laboratorio</label>

                            <input type="text" class="form-control" id="laboratorioUpdate" name="laboratorio" placeholder="MERCK" required>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese la Laboratorio

                            </div>

                        </div>

                    </div>

                    <div class="form-row">
                        
                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="lote">Lote</label>

                            <input type="text" class="form-control" id="loteUpdate" name="lote" placeholder="90895601" required>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese la Lote 

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="fechaVencimiento">Fecha Vencimiento</label>

                            <input type="text" class="form-control" id="fechaVencimientoUpdate" name="fechaVencimiento" placeholder="1900-01-01" required>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese un Fecha Vencimiento 

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="stock">Stock</label>

                            <input type="number" min="0" class="form-control" id="stockUpdate" name="stock" placeholder="100" required>
                            
                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese un Stock

                            </div>

                        </div>
                        
                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="precioComercio">Precio Comercio</label>

                            <input type="number" min="0" class="form-control" id="precioComercioUpdate" name="precioComercio" placeholder="$ 10000" required>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese el Precio Comercio 

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="precioInventario">Precio Inventario</label>

                            <input type="number" min="0" class="form-control" id="precioInventarioUpdate" name="precioInventario" placeholder="$ 1000" required>
                            
                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese el Precio Inventario

                            </div>

                        </div>

                    </div>
                

                <div class="form-row">

                    <button type="submit" class="btn btn-success btn-block">

                        <i class="fas fa-check-circle"></i>

                        Guardar Medicamento

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
<!-- Actualizar Usuario -->

@endsection

@push('scripts')

    <!-- JQuery DataTable -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js" ></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>

<!-- JQuery DatePicker -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- Boostrap Select -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>

<script>

$(document).ready(function () {

    $( "#fechaVencimiento" ).datepicker({
                dateFormat: "yy-mm-dd",
                firstDay: 1,
                dayNamesMin: [ "Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab" ],
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
                numberOfMonths: 1,
            });

    // Start Configuration DataTable
    var table = $('#medicamentosTable').DataTable({

        "paginate"  : true,

        "order"     : ([0, 'desc']),

        "language"  : {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "No existen Medicamentos registrados, aún...",
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

    //Start Edit Record
    table.on('click', '.actualizar', function () {

        $tr = $(this).closest('tr');

        if ($($tr).hasClass('child')) {

            $tr = $tr.prev('.parent');

        }

        var data = table.row($tr).data();

        console.log(data);

        $('#categoriaUpdate').val(data[1]);
        $('#medicamentoUpdate').val(data[2]);
        $('#principioActivoUpdate').val(data[3]);
        $('#laboratorioUpdate').val(data[4]);
        $('#loteUpdate').val(data[5]);
        $('#fechaVencimientoUpdate').val(data[6]);
        $('#stockUpdate').val(data[7]);
        $('#precioComercioUpdate').val(data[8]);
        $('#precioInventarioUpdate').val(data[9]);

        $('#updateMedicamentoForm').attr('action', '/farmacia/medicamentos/' + data[0]);
        $('#updateMedicamentoModal').modal('show');

    });
    //End Edit Record

    var total = 0;
        $('#medicamentosTable').DataTable().rows().data().each(function(el, index){
          //Asumiendo que es la columna 5 de cada fila la que quieres agregar a la sumatoria
          total += parseInt(el[9]);
        });

        $('#total').val(total);

        console.log(total);
});

</script>

@endpush