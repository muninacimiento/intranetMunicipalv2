<!--
/*
 *  JFuentealba @itux
 *  created at Febrary 07, 2022 - 09:26 am
 *  updated at 
 */
-->

@extends('layouts.app')
@section('content')
<div id="allWindow">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-warning shadow">
                <div class="card-header text-center bg-warning">
                	@include('sispam.menu')
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
<script>
    $(document).ready(function () {
        var height = $(window).height();
            $('#allWindow').height(height);

    });
</script>
@endpush
