<!--
/*
 *  JFuentealba @itux
 *  created at September 10, 2019 - 11:23 am
 *  updated at 
 */
-->
<h1 class="font-weight-lighter">
                	
    SisCoM - 

	<small>Sistema de Compras Públicas Municipales</small>	

</h1>

<div class="text-white">
	

</div>

<ul class="nav justify-content-center menu">

	<li class="nav-item dropdown">

		@can('siscom.index')

	    <a class="nav-link text-white dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
	    	
	    	<i class="icofont-cart-alt px-1" style="font-size: 1.3em;"></i>

	    	Solicitudes	

	    </a>

	    @endcan

		<div class="dropdown-menu">

			@can('solicitud.index')

		    <a class="dropdown-item text-primary" href="{{ route('solicitud.index') }}">

		    	<i class="icofont-ui-edit px-1" style="font-size: 1.3em;"></i>

		    	Gestionar Solicitud

		    </a>

		    @endcan

		    @can('admin.recepcionarSolicitud')

		   	<div class="dropdown-divider"></div>

		   	<a class="dropdown-item text-primary" href="{{ route('admin.recepcionarSolicitud') }}">

		    	<i class="icofont-inbox px-1" style="font-size: 1.3em;"></i>

		    	Recepcionar Solicitudes

		    </a>

		    @endcan		

		    @can('admin.index')

		   	<div class="dropdown-divider"></div>

		   	<a class="dropdown-item text-primary" href="{{ route('admin.index') }}">

		    	<i class="icofont-ui-settings px-1" style="font-size: 1.3em;"></i>

		    	Administrar Solicitudes

		    </a>

		    @endcan		

		    @can('admin.consulta')
		    <div class="dropdown-divider"></div>

		   	<a class="dropdown-item text-primary" href="{{ route('admin.consulta') }}">

		    	<i class="icofont-search-folder px-1" style="font-size: 1.3em;"></i>

		    	Consultar Solicitudes

		    </a>
		    @endcan

		</div>

  	</li>

  	<li class="nav-item dropdown">

  		@can('ordenCompra.index')

	    <a class="nav-link text-white dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
	    		
	    	<i class="icofont-visa-alt px-1" style="font-size: 1.3em;"></i>

	    	Órdenes de Compra

	    </a>

		<div class="dropdown-menu">

			<a class="dropdown-item text-primary" href="{{ route('ordenCompra.index') }}">

			    <i class="icofont-ui-settings px-1" style="font-size: 1.3em;"></i>

			    Gestionar Órdenes de Compra

			</a>

			<div class="dropdown-divider"></div>

			<a class="dropdown-item text-primary" href="{{ route('proveedores.index') }}">

			    <i class="icofont-users-alt-1 px-1" style="font-size: 1.3em;"></i>

			    Gestionar Proveedores

			</a>

		</div>

		@endcan

  	</li>

  	@can('licitacion.index')
  	
  	<li class="nav-item">
    
    	<a class="nav-link text-white" href="{{ route('licitacion.index') }}">

    		<i class="icofont-papers px-1" style="font-size: 1.3em;"></i>

    		Licitaciones

    	</a>
  	
  	</li>

  	@endcan

  	<li class="nav-item dropdown">

	  	@can('factura.index')

	  		<a class="nav-link text-white dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">

	  			<i class="icofont-dollar px-1" style="font-size: 1.3em;"></i>

	  			Facturas

	  		</a>

	  	@endcan

	  	<div class="dropdown-menu">

	  		@can('factura.index')

			<a class="dropdown-item text-primary" href="{{ route('factura.index') }}">

			    <i class="icofont-ui-settings px-1" style="font-size: 1.3em;"></i>

			    Gestionar Facturas

			</a>

			@endcan

			<div class="dropdown-divider"></div>

			@can('factura.consulta')

			<a class="dropdown-item text-primary" href="{{ route('factura.consulta') }}">

			    <i class="icofont-search-folder px-1" style="font-size: 1.3em;"></i>

			    Consultar Facturas

			</a>

			@endcan

		</div>
  	
  	</li>

  	<li class="nav-item dropdown">

  		@can('contrato.index')

	  		<a class="nav-link text-white dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">

			    <i class="icofont-law-document px-1" style="font-size: 1.3em;"></i>
	  			
	  			Contratos

	  		</a>

	  	@endcan

	  	<div class="dropdown-menu">

	  		@can('contrato.index')

			<a class="dropdown-item text-primary" href="{{ route('contratos.index') }}">

			    <i class="icofont-ui-settings px-1" style="font-size: 1.3em;"></i>

			    Gestionar Contratos

			</a>

			@endcan

			<div class="dropdown-divider"></div>

			@can('boletaGarantia.index')

			<a class="dropdown-item text-primary" href="{{ route('boletasGarantia.index') }}">

    			<i class="icofont-ui-settings px-1" style="font-size: 1.3em;"></i>

			    Gestionar Boletas de Garantia

			</a>

			@endcan

		</div>

  	</li>

  	@can('reportes.index')
  	
  	<li class="nav-item">
    
    	<a class="nav-link text-white" href="{{ route('reporte.index') }}">

    		<i class="fas fa-copy px-1"></i>

    		Reportes

    	</a>
  	
  	</li>

  	@endcan

</ul>