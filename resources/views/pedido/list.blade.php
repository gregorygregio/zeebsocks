@extends('layouts.app')

@section('title', "Meus Pedidos")

@section('custom-css-links')
    <link href="{{ asset('css/pedido/list.css') }}" rel="stylesheet">
@endsection

@section('content')
    <section class="section-block">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <ul class="nav nav-tabs">
                        <li class="{{ $orderStatus === \App\Entities\Order::STATUS_PENDENTE ? "active" : "" }}">
                            <a href="{{ route("pedido.list") + "/" + \App\Entities\Order::STATUS_PENDENTE }}">Pedidos pendentes</a>
                        </li>
                        <li class="{{ $orderStatus === \App\Entities\Order::STATUS_ENVIADO ? "active" : "" }}">
                            <a href="{{ route("pedido.list") + "/" + \App\Entities\Order::STATUS_ENVIADO }}">Pedidos Enviados</a>
                        </li>
                        <li class="{{ $orderStatus === \App\Entities\Order::STATUS_PAGO ? "active" : "" }}">
                            <a href="{{ route("pedido.list") + "/" + \App\Entities\Order::STATUS_PAGO }}">Pedidos pagos</a>
                        </li>
                        <li class="{{ $orderStatus === \App\Entities\Order::STATUS_CANCELADO ? "active" : "" }}">
                            <a href="{{ route("pedido.list") + "/" + \App\Entities\Order::STATUS_CANCELADO }}">Pedidos cancelados</a>
                        </li>
                    </ul>


                    <br>
                    @foreach($orders as $order)
                    <div class="order-box">
                        <div class="order-head-info">

                            <div class="pull-right">
                                Número do pedido: {{ $order->id }}
                            </div>


                            <table class="table order-info">
                                <tbody>
                                    <tr>
                                        <td>Data de pedido</td>
                                        <td>CEP destinatário</td>
                                        <td>Total</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $order->getOrderDate() }}</td>
                                        <td>{{ $order->zipcode }}</td>
                                        <td>R$ {{ $order->order_total }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="order-items">
                            <table class="table">
                                <tbody>
                                    @foreach($order->items as $item)
                                    <?php $product = $item->product ?>
                                    <tr>
                                        <td><img class="product-img" src="{{ asset("/storage/products/thumbs/" . $product->type_r->type . "/"  . $product->main_image) }}" /></td>
                                        <td><a href="{{ url("product/" . $product->url_id)  }}">{{ $product->name }}</a></td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->getTotalPrice() }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>



                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection
