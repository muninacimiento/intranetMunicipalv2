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

                <div class="card-header text-center text-white bg-secondary mb-3">

                    <div class="col text-center">
                            
                        <h3 class="font-weight-lighter">Administración de Contactos Municipales</h3>

                        <div class="col-md-12">
                            
                            <a href="{{ route('contacts.create') }}" class="text-decoration-none">

                                <button class="btn btn-success btn-sm">

                                    <i class="icofont-plus"></i>

                                    Nuevo Contacto

                                </button>

                            </a>
                            
                        </div>

                    </div>

                </div>


                <div class="card-body">

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

                        <table class="display" id="contactosTable" style="font-size: 0.9em;">

                            <thead>
                                <tr class="table-active">
                                    <th>ID</th>
                                    <th>Dependencia</th>
                                    <th>Unidad</th>
                                    <th>Teléfono</th>
                                    <th style="width: 7%;"></th>
                                    <th style="width: 11%;"></th>
                                    <th style="width: 10%;"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->id }}</td>
                                    <td>{{ $contact->dependency->name }}</td>
                                    <td>{{ $contact->unidad }}</td>
                                    <td>{{ $contact->telefono }}</td>
                                    <td>

										<a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ver Detalle del Contacto">

                                            <i class="icofont-eye-alt"></i> Ver

                                        </a>

                                    </td>

                                    <td>

										<a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Modificar Contacto">
                                                
                                            <i class="icofont-refresh"></i> Actualizar

                                        </a>

                                    </td>

                                    <td>

                                        {!! Form::open(['route'=>['contacts.destroy', $contact->id], 'method'=>'DELETE']) !!}

                                            <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Eliminar Contacto">
                                                    
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
            var table = $('#contactosTable').DataTable({

                "paginate"  : true,

                "order"     : ([0, 'desc']),

                "language"  : {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "No existen contactos municipales, aún...",
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