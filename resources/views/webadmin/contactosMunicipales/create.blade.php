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
                <div class="card-header bg-dark text-white h4">
                    <i class="icofont-plus-circle"></i>
                    Crear Nuevo Contacto
                </div>
                @if(count($errors))
                    <div class="alert alert-danger alert-dismissible fade show shadow mb-3" role="alert">          
                        <ul>
                            @foreach($errors->all() as $error)
                            <li><i class="icofont-close-circled"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card-body">
                	{!! Form::open(['route'=>'contacts.store']) !!}
                		@include('webadmin.contactosMunicipales.partials.form')
                	{!! Form::close() !!}
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