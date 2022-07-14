<!--
/*
 *  JFuentealba @itux
 *  created at September 10, 2019 - 11:23 am
 *  updated at November 11, 2020 - 8:24 pm
 */
-->
<h1 class="font-weight-lighter">
                	
    Farmacia Municipal <br> 

	<small>Sistema de Ventas e Inventario de Medicamentos</small>	

</h1>

<div class="text-white">
	

</div>

<ul class="nav justify-content-center menu">

	<li class="nav-item">

		@can('farmacia.index')

	    <a class="nav-link text-white" href="{{ action('UsuarioFarmaciaController@index') }}" >
	    	
	    	<i class="fas fa-users px-1"></i>

	    	Usuarios	

	    </a>

	    @endcan

  	</li>

  	<li class="nav-item dropdown">

	    <a class="nav-link text-white dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
	    		
	    	<i class="fas fa-prescription-bottle px-1"></i>

	    	Medicamentos

	    </a>

		<div class="dropdown-menu">

		    <a class="dropdown-item text-danger" href="{{ route('medicamentos.index') }}">

		    	<i class="fas fa-prescription-bottle-alt px-1"></i>

		    	Gestionar Medicamentos

		    </a>

		   	<div class="dropdown-divider"></div>

		   	<a class="dropdown-item text-danger" href="{{ route('categoria.index') }}">

		    	<i class="fas fa-cogs px-1"></i>

		    	Gestionar Categoría

		    </a>	

		</div>

  	</li>

  	<li class="nav-item dropdown">

  		<a class="nav-link text-white dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
	    		
	    	<i class="fas fa-dollar-sign px-1"></i>

	    	Venta de Medicamentos

	    </a>

	    <div class="dropdown-menu">
    
	    	<a class="nav-link text-danger" href="{{ route('ventas.index') }}">

	    		<i class="fas fa-cash-register px-1"></i>

	    		Realizar Venta

	    	</a>

	    	<div class="dropdown-divider"></div>

	    	<a class="nav-link text-danger" href="{{ route('ventas.consulta') }}">

	    		<i class="fas fa-question px-1"></i>

	    		Consultar Venta

	    	</a>

	    </div>
  	
  	</li>
 	
  	<li class="nav-item dropdown">

  		<a class="nav-link text-white dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
	    		
	    	<i class="icofont-question"></i>

	    	Consultas

	    </a>

	    <div class="dropdown-menu">
    
	    	<a class="nav-link text-danger" href="{{ route('consultas.movimientoMedicamentos') }}">

	    		<i class="icofont-retweet px-1"></i>

	    		Movimiento de Medicamentos

	    	</a>

	    	<div class="dropdown-divider"></div>

	    	<a class="nav-link text-danger" href="{{ route('consultas.medicamentosSinStock') }}">

	    		<i class="icofont-ban px-1"></i>

	    		Medicamentos Sin Stock

	    	</a>

	    	<div class="dropdown-divider"></div>

	    	<a class="nav-link text-danger" href="{{ route('consultas.medicamentosVencidos') }}">

	    		<i class="icofont-barcode px-1"></i>

	    		Medicamentos Vencidos

	    	</a>

	    </div>
  	
  	</li>

	
</ul>