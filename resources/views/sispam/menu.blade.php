<!--
/*
 *  JFuentealba @itux
 *  created at Febrary 07, 2022 - 11:23 am
 *  updated at 
 */
-->
<h1 class="font-weight-lighter">                	
    SisPAM - 
	<small>Sistema de Gestión del Parque Automotriz Municipal</small>	
</h1>

<ul class="nav justify-content-center menu">
	<li class="nav-item dropdown">
		@can('sispam.index')
	    <a class="nav-link text-dark dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">    	
		<i class="icofont-car-alt-1 px-1" style=" font-size: 1.3rem;"></i> Vehículos Municipales	
	    </a>
	    @endcan
		<div class="dropdown-menu bg-warning">
			@can('sispam.index')
		    <a class="dropdown-item text-dark " href="{{ action('VehiculosController@index') }}">
			<i class="icofont-swoosh-up px-1" style=" font-size: 1.3rem;"></i> Ingresar Vehículo
		    </a>
		    @endcan
		    @can('reservar.index')
		   	<div class="dropdown-divider"></div>
		   	<a class="dropdown-item text-dark" href="{{ action('ReservasVehiculosController@index') }}">
			   <i class="icofont-clock-time px-1" style=" font-size: 1.3rem;"></i> Reservar Vehículo
		    </a>
		    @endcan	
		    @can('combustible.index')
		   	<div class="dropdown-divider"></div>
		   	<a class="dropdown-item text-dark" href="{{ action('CombustibleController@index') }}">
			   <i class="icofont-brand-shell px-1" style=" font-size: 1.3rem;"></i> Cargar Combustible
		    </a>
		    @endcan
			@can('vehiculos.mantenciones')
		   	<div class="dropdown-divider"></div>
		   	<a class="dropdown-item text-dark" href="{{ action('MantencionVehiculosController@index') }}" >	
				<i class="icofont-tools-bag px-1" style=" font-size: 1.4rem;"></i> Mantenciones
	    	</a>
		    @endcan
			@can('vehiculos.darDeBaja')
		   	<div class="dropdown-divider"></div>
		   	<a class="dropdown-item text-dark" href="{{ action('DarDeBajaVehiculosController@index') }}">
			   <i class="icofont-swoosh-down px-1" style=" font-size: 1.3rem;"></i> Dar de Baja
		    </a>
		    @endcan		
		</div>
  	</li>
	<li class="nav-item">
	    <a class="nav-link text-dark" href="{{ action('ConductoresController@index') }}" >
		<i class="icofont-business-man px-1" style=" font-size: 1.4rem;"></i>
	    	Conductores
	    </a>
  	</li>
	<li class="nav-item dropdown">
		@can('sispam.index')
	    <a class="nav-link text-dark dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">    	
		<i class="icofont-search-document px-1" style=" font-size: 1.4rem;"></i> Informes	
	    </a>
	    @endcan
		<div class="dropdown-menu bg-warning">
			@can('combustibles.consultaRendimiento')
		    <a class="dropdown-item text-dark " href="{{ route('combustibles.consultaRendimiento') }}">
			<i class="icofont-swoosh-up px-1" style=" font-size: 1.3rem;"></i> Rendimiento
		    </a>
		    @endcan
		    @can('mantenciones.consultaMantenciones')
		   	<div class="dropdown-divider"></div>
		   	<a class="dropdown-item text-dark" href="{{ route('mantenciones.consultaMantenciones') }}">
			   <i class="icofont-clock-time px-1" style=" font-size: 1.3rem;"></i> Estado
		    </a>
		    @endcan	
			@can('reservas.consulta')
		   	<div class="dropdown-divider"></div>
		   	<a class="dropdown-item text-dark" href="{{ route('reservas.consulta') }}" >	
				<i class="icofont-tools-bag px-1" style=" font-size: 1.4rem;"></i> Reservas
	    	</a>
		    @endcan
		</div>
  	</li>
</ul>