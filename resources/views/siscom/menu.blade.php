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

			@can('siscom.index')

		    <a class="dropdown-item text-primary" href="{{action('SCM_SolicitudController@index')}}">

		    	<i class="fas fa-pencil-alt px-1"></i>

		    	Gestionar Solicitud

		    </a>

		    @endcan

		    @can('admin.index')

		   	<div class="dropdown-divider"></div>

		   	<a class="dropdown-item text-primary" href="{{ action('SCM_AdminSolicitudController@index') }}">

		    	<i class="fas fa-cogs px-1"></i>

		    	Administrar Solicitudes

		    </a>

		    <div class="dropdown-divider"></div>

		    <a class="dropdown-item text-primary" href="#">

		    	<i class="fas fa-dolly px-1"></i>

		    	Entrega de Productos en Stock

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

			<a class="dropdown-item text-primary" href="{{ action('OrdenCompraController@index') }}">

			    <i class="fas fa-cash-register px-1"></i>

			    Gestionar Órdenes de Compra

			</a>

			<div class="dropdown-divider"></div>

			<a class="dropdown-item text-primary" href="#">

			    <i class="fas fa-check-circle px-1"></i>

			    Recepción de Productos OC

			</a>

			    <div class="dropdown-divider"></div>

			<a class="dropdown-item text-primary" href="{{ action('ProveedoresController@index') }}">

			    <i class="fas fa-clipboard-list px-1"></i>

			    Gestionar Proveedores

			</a>

		</div>

		@endcan

  	</li>

  	@can('licitaciones.index')
  	
  	<li class="nav-item">
    
    	<a class="nav-link text-white" href="#">

    		<i class="fas fa-cubes px-1"></i>

    		Licitaciones

    	</a>
  	
  	</li>

  	@endcan

  	@can('factura.index')
  	
  	<li class="nav-item">
    
    	<a class="nav-link text-white" href="#">

    		<i class="fas fa-dollar-sign px-1"></i>

    		Facturas

    	</a>
  	
  	</li>

  	@endcan

</ul>