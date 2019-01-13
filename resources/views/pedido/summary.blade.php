@extends('layouts.app')

@section('title', "Resumo do pedido")

@section('custom-css-links')
    <link href="{{ asset('css/pedido/summary.css') }}" rel="stylesheet">
@endsection

@section('content')
    <section class="section-block">
        <div class="container">
            <div class="row">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Preço</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart->items as $item)
                            <?php $product =  $item->product ?>
                            <tr>
                                <td><a href="{{ url("product/" . $product->url_id)  }}">{{ $product->name }}</a></td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->getTotalPrice() }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>Frete</td>
                            <td></td>
                            <td>{{ $frete["valor"] }}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>{{ $cart->getTotalQuantity() }}</th>
                            <th class="total-price">{{ $cart->getTotalPrice() + $frete["valor"] }}</th>
                        </tr>
                    </tfoot>
                </table>

                <h3>Endereço de entrega</h3>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>{{ $address->zipcode }}</td>
                            <td>{{ $address->address }}</td>
                            <td>{{ $address->number }}</td>
                            <td>{{ $address->bairro }}</td>
                            <td>{{ $address->city }}</td>
                            <td>{{ $address->state }}</td>
                            <td>{{ $address->country }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-lg-4 col-lg-offset-8 col-xs-12">
                    <a href="{{ route("pedido.end") }}" class="btn btn-primary btn-block">
                        <i class="fa fa-shopping-bag"></i>
                        FINALIZAR COMPRA
                    </a>
                </div>

            </div>


        </div>
    </section>
@endsection