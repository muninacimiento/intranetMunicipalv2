<!--
/*
 *  JFuentealba @itux
 *  created at Febrary 07, 2022 - 11:47 am
 *  updated at 
 */
-->
@extends('layouts.app')
@section('content')
<div id="allWindow">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-warning shadow">
                <div class="card-header text-center text-dark bg-warning">
                    @include('sispam.menu')
                </div>
                <div class="card-body">
                    <div class="row mt-5">
                        <div class="col text-center text-secondary">
                            <h3>Detalle del Vehiculo / {{ $detalleVehiculo->patente }}</h3>
                            <div class="text-secondary">
                                {{ $dateCarbon }}
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="row">
                        <div class="col"></div>
                        <div class="col">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Marca</td>
                                        <th scope="row">{{ $detalleVehiculo->marca }}</th>
                                    </tr>
                                    <tr>
                                        <td>Modelo</td>
                                        <th scope="row">{{ $detalleVehiculo->modelo }}</th>
                                    </tr>
                                    <tr>
                                        <td>Año</td>
                                        <th scope="row">{{ $detalleVehiculo->anio }}</th>
                                    </tr>
                                    <tr>
                                        <td>Número Motor</td>
                                        <th scope="row">{{ $detalleVehiculo->noMotor }}</th>
                                    </tr>
                                    <tr>
                                        <td>Número Chasís</td>
                                        <th scope="row">{{ $detalleVehiculo->noChasis }}</th>
                                    </tr>
                                    <tr>
                                        <td>Rendimiento</td>
                                        <th scope="row">{{ $detalleVehiculo->rendimiento }}</th>
                                    </tr>
                                    <tr>
                                        <td>Color</td>
                                        <th scope="row">{{ $detalleVehiculo->color }}</th>
                                    </tr>
                                    <tr>
                                        <td>Tipo Combustible</td>
                                        <th scope="row">{{ $detalleVehiculo->motor }}</th>
                                    </tr>
                                    <tr>
                                        <td>Conductor Responsable</td>
                                        <th scope="row">{{ $detalleVehiculo->Conductor }}</th>
                                    </tr>
                                    <tr>
                                        <td>Registrado Por</td>
                                        <th scope="row">{{ $detalleVehiculo->Registrado }}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection