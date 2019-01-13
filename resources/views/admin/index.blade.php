@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-12">
                @component("admin.lte-components.small-box", [
                    "color" => 'aqua',
                    "icon" => 'clipboard',
                    "text" => 'Pedidos Abertos Hoje',
                    "number" => $numberOfOrdersCreatedToday,
                    "route" => route("home"),
                ])
                @endcomponent
            </div>

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop
