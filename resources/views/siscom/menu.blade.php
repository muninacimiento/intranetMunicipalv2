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
	    	
	    	<i class="fas fa-cart-plus px-1"></i>

	    	Solicitudes	

	    </a>

	    @endcan

		<div class="dropdown-menu">

			@can('solicitud.index')

		    <a class="dropdown-item text-primary" href="{{ route('solicitud.index') }}">

		    	<i class="fas fa-pencil-alt px-1"></i>

		    	Gestionar Solicitud

		    </a>

		    @endcan

		    @can('admin.recepcionarSolicitud')

		   	<div class="dropdown-divider"></div>

		   	<a class="dropdown-item text-primary" href="{{ route('admin.recepcionarSolicitud') }}">

		    	<i class="fas fa-inbox px-1"></i>

		    	Recepcionar Solicitudes

		    </a>

		    @endcan		

		    @can('admin.index')

		   	<div class="dropdown-divider"></div>

		   	<a class="dropdown-item text-primary" href="{{ route('admin.index') }}">

		    	<i class="fas fa-cogs px-1"></i>

		    	Administrar Solicitudes

		    </a>

		    @endcan		

		    @can('admin.consulta')
		    <div class="dropdown-divider"></div>

		   	<a class="dropdown-item text-primary" href="{{ route('admin.consulta') }}">

		    	<i class="fas fa-question px-1"></i>

		    	Consultar Solicitudes

		    </a>
		    @endcan

		</div>

  	</li>

  	<li class="nav-item dropdown">

  		@can('ordenCompra.index')

	    <a class="nav-link text-white dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
	    		
	    	<i class="far fa-credit-card px-1"></i>

	    	Órdenes de Compra

	    </a>

		<div class="dropdown-menu">

			<a class="dropdown-item text-primary" href="{{ route('ordenCompra.index') }}">

			    <i class="fas fa-cash-register px-1"></i>

			    Gestionar Órdenes de Compra

			</a>

			<div class="dropdown-divider"></div>

			<a class="dropdown-item text-primary" href="{{ route('proveedores.index') }}">

			    <i class="fas fa-clipboard-list px-1"></i>

			    Gestionar Proveedores

			</a>

		</div>

		@endcan

  	</li>

  	@can('licitacion.index')
  	
  	<li class="nav-item">
    
    	<a class="nav-link text-white" href="{{ route('licitacion.index') }}">

    		<i class="fas fa-cubes px-1"></i>

    		Licitaciones

    	</a>
  	
  	</li>

  	@endcan

  	@can('factura.index')
  	
  	<li class="nav-item">
    
    	<a class="nav-link text-white" href="{{ route('factura.index') }}">

    		<i class="fas fa-dollar-sign px-1"></i>

    		Facturas

    	</a>
  	
  	</li>

  	@endcan

  	<!--@can('factura.index')-->
  	
  	<li class="nav-item">
    
    	<a class="nav-link text-white" href="{{ route('reporte.index') }}">

    		<i class="fas fa-copy px-1"></i>

    		Reportes

    	</a>
  	
  	</li>

  	<!--@endcan-->

</ul>