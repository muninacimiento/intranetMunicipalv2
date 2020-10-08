<!--
/*
 *  JFuentealba @itux
 *  created at September 10, 2020 - 11:46 am
 *  updated at October 4, 2020 - 10:07 am
 */
-->

@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card border-dark shadow">

                <div class="card-header text-center text-white bg-dark">

                    @include('webadmin.menu')

                </div>


                <div class="card-body">

                    <div class="row mt-5">

                        <div class="col-md-6 text-center">
                            
                            <h3>Listado de Categorias Creadas</h3>

                            <div class="text-secondary">

                                {{ $dateCarbon }}

                            </div>

                        </div>

                        <div class="col-md-6">
                            
                            <a href="{{ route('categories.create') }}" class="text-decoration-none">

                                <button class="btn btn-warning btn-block boton">

                                    <i class="icofont-plus"></i>

                                    Nueva Categoria

                                </button>

                            </a>
                            
                        </div>

                    </div>

                    <hr class="my-4">

                    @if (session('info'))

                        <div class="alert alert-success alert-dismissible fade show shadow mb-3" role="alert">
                              
                            <i class="icofont-check-circled"></i>
                             
                            <strong> {{ session('info') }} </strong>
                            
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            
                                <span aria-hidden="true">&times;</span>
                              
                            </button>

                        </div>
                   
                    @endif

                    
                    <div>

                        <table class="display" id="categoriasTable" style="font-size: 0.9em;">

                            <thead>

                                <tr class="table-active">

                                    <th>ID</th>

                                    <th style="width: 60%;">Nombre Categoria</th>

                                    <th style="width: 9%;"></th>
                                    
                                    <th style="width: 13%;"></th>

                                    <th style="width: 12%;"></th>


                                </tr>

                            </thead>

                            <tbody>

                                @foreach($categories as $category)

                                <tr>

                                    <td>{{ $category->id }}</td>

                                    <td>{{ $category->name }}</td>

                                    <td>

										<a href="{{ route('categories.show', $category->id) }}" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Ver Detalle de la Categoria">

                                            <i class="icofont-eye-alt"></i> Ver

                                        </a>

                                    </td>

                                    <td>

										<a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Modificar la Categoria">
                                                
                                            <i class="icofont-refresh"></i> Actualizar

                                        </a>

                                    </td>

                                    <td>

                                        {!! Form::open(['route'=>['categories.destroy', $category->id], 'method'=>'DELETE']) !!}

                                            <button class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Eliminar Etiqueta">
                                                    
                                                <i class="icofont-delete-alt"></i> Eliminar

                                            </button>

                                        {!! Form::close() !!}

                                    </td>

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

<!-- JQuery DataTable -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js" ></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>

<!-- JQuery DatePicker -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
        
        $(document).ready(function () {

            // Start Configuration DataTable
            var table = $('#categoriasTable').DataTable({

                "paginate"  : true,

                "order"     : ([0, 'desc']),

                "language"  : {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "No existen solicitudes generadas por su unidad, aún...",
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