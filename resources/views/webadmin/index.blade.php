<!--
/*
 *  JFuentealba @itux
 *  created at September 10, 2019 - 11:46 am
 *  updated at 
 */
-->

@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card border-dark shadow">

                <div class="card-header text-center text-white bg-dark">

                	@include('webadmin.menu')

                </div>

                <div class="card-body">

                    @if (session('status'))

                        <div class="alert alert-success" role="alert">

                            {{ session('status') }}

                        </div>

                    @endif
                    
                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<!-- JQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js" ></script>

<script>
    
    $(document).ready(function () {
        var height = $(window).height();
            $('#allWindow').height(height);

    });

</script>

@endpush
