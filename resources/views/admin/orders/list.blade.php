@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop


@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-11 col-xs-12">
              
                @component('admin.lte-components.table', [
                    "title" => "Pedidos abertos",
                    "tableId" => "tabelaPedidos"
                ])

                  @slot("thead")
                    <tr>
                        <th>ID</th>
                        <th>USER</th>
                        <th>CEP</th>
                        <th>DATA</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                  @endslot

                    @foreach($orders as $order)
                      <tr>
                          <td>{{ $order->id }}</td>
                          <td>{{ $order->user_id }}</td>
                          <td>{{ $order->zipcode }}</td>
                          <td>{{ $order->created_at }}</td>
                          <td>{{ $order->order_total }}</td>
                          <td>
                            <a href="{{ route("admin.orders.view", $order->id) }}">
                              <i class="fa fa-eye"></i>
                            </a>
                          </td>
                      </tr>
                    @endforeach
                @endcomponent
            </div>
        </div>
    </div>
@stop
