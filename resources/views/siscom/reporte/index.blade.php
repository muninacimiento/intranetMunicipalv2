<!--
/*
 *  JFuentealba @itux
 *  created at September 10, 2019 - 11:46 am
 *  updated at 
 */
-->

@extends('layouts.app')

@section('content')
<div id="allWindow">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card border-primary shadow">

                <div class="card-header text-center text-white bg-primary">

                	@include('siscom.menu')

                </div>

                <div class="card-body">

                    @if (session('status'))

                        <div class="alert alert-success" role="alert">

                            {{ session('status') }}

                        </div>

                    @endif

                    <div class="card-body">

                        <div class="row mt-2">

                            <div class="col-md-12 text-center">
                                
                                <h3>Listado de Reportes</h3>

                                <div class="text-secondary">

                                    {{ $dateCarbon }}

                                </div>

                            </div>

                        </div>

                        <div class="card mb-3">

                            <h5 class="card-header">Estado de Solicitudes</h5>
                            
                            <div class="card-body">

                                <div class="mb-2">
                                    
                                    <p class="card-text">Listado de las Solicitudes por Estado:</p>

                                </div>
                                        
                                <div class="mb-2">
                                
                                    <select name="estadoSolicitud" id="estadoSolicitud" class="custom-select" required>

                                        <option value="1">Creada</option>
                                        <option value="2">Pendiente</option>
                                        <option value="3">Recepcionada</option>
                                        <option value="4">Asignada a Comprador</option>
                                        <option value="5">Re-Asignada a Comprador</option>
                                        <option value="6">En Proceso de Compra</option>
                                        <option value="7">En Proceso de Entrega</option>
                                        <option value="8">En Proceso de Licitación</option>
                                        <option value="9">Productos Recepcionados</option>
                                        <option value="10">Solicitud Gestionada Completamente</option>
                                        <option value="11">Solicitud Entregada Completamente</option>
                                        <option value="12">Anulada</option>

                                    </select>    

                                </div>
                                
                                <div>
                                        
                                    <a href="#" class="btn btn-primary">Ver Reporte</a>

                                </div>
                            
                            </div>
                        
                        </div>

                        <div class="card">

                            <h5 class="card-header">Estado de Órdenes de Compra</h5>
                            
                            <div class="card-body">
                            
                                <div class="mb-2">
                                    
                                    <p class="card-text">Listado de las Órdenes de Compra por Estado:</p>

                                </div>
                                        
                                <div class="mb-2">
                                
                                    <select name="estadoOC" id="estadoOC" class="custom-select" required>

                                        <option value="1">Emitida</option>
                                        <option value="2">Recepcionada y en Revisión por C&S</option>
                                        <option value="3">Revisión por C&S</option>
                                        <option value="4">Aprobada por C&S</option>
                                        <option value="5">Rechazada por C&S</option>
                                        <option value="6">En Revisión por Profesional DAF</option>
                                        <option value="7">Aprobada por Profesional DAF</option>
                                        <option value="8">Rechazada por Profesional DAF</option>
                                        <option value="9">En Firma DAF</option>
                                        <option value="10">Aprobada por DAF</option>
                                        <option value="11">Rechazada por DAF</option>
                                        <option value="12">En Firma Alcaldía</option>
                                        <option value="13">Aprobada por Alcaldía</option>
                                        <option value="14">En Firma Administración</option>
                                        <option value="15">Aprobada por Administración</option>
                                        <option value="16">Lista para Enviar a Proveedor</option>
                                        <option value="17">Enviada a Proveedor</option>
                                        <option value="18">Enviada a Proveedor con Excepción</option>
                                        <option value="19">Productos Recepcionados</option>
                                        <option value="20">Facturada</option>
                                        <option value="21">Parcialmente Facturada</option>
                                        <option value="22">Anulada</option>
                                        <option value="24">Productos Recepcionados Parcialmente</option>

                                    </select>    

                                </div>
                                
                                <div>
                                        
                                    <a href="#" class="btn btn-primary">Ver Reporte</a>

                                </div>
                            
                            </div>
                        
                        </div>

                    </div>
                    
                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>
    
    $(document).ready(function () {
        var height = $(window).height();
            $('#allWindow').height(height);

    });

</script>

@endpush
