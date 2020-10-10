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

            <div class="card shadow">

                <div class="card-header h5 bg-dark text-white">

                    <i class="icofont-listing-number px-1"></i>

                    Ver Noticia

                </div>


                <div class="card-body">

                	<div>
                		
                		<strong>Nombre Noticia: </strong>{{ $post->name }}

                	</div>

                	<div class="mb-3">
                		
                		<strong>URL Amigable Noticia: </strong>{{ $post->slug }}

                	</div>

                    <div class="mb-3">
                        
                        <strong>Desarrollo Noticia: </strong>{{ $post->body }}

                    </div>

                	<div>
                		
                		<a href="{{ route('posts.index') }}" class="btn btn-warning btn-block">
                			
                			<i class="icofont-double-left"></i>

                			Volver

                		</a>

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
        
</script>

@endpush