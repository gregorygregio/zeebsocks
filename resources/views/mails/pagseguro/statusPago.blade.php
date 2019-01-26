@extends('layouts.mail')

@section('title', 'Início')

@section('custom-css-links')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="text-center">
      <h1>O seu pagamento foi aceito !</h1>
    </div>

    <p>
      Olá, {{ $order->client->name }} ! O seu pagamento pelo pedido {{ $order->id }} foi confirmado. 
    </p>
@endsection
