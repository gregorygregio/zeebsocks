@extends('layouts.app')

@section('title', "Meu carrinho"  )

@section('custom-css-links')
    <link href="{{ asset('css/cart/list.css') }}" rel="stylesheet">
@endsection

@section('content')



    <section class="section-block">


        <div class="container">
            <div class="row">


                <div class="col-md-8 col-xs-12">
                    <h2>Carrinho de compras</h2>

                    @if(session('success'))

                        <div class="alert alert-success text-center">
                            {{ session('success')  }}
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger text-center">
                            {{ session('error')  }}
                        </div>
                    @endif
                    <table class="table product-list">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Preço</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($cart->items as $item)
                            <?php $product =  $item->product ?>

                                <tr>
                                    <td><img class="product-img" src="{{ asset("/storage/products/thumbs/" . $product->type_r->type . "/"  . $product->main_image) }}" /></td>
                                    <td><a href="{{ url("product/" . $product->url_id)  }}">{{ $product->name }}</a></td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->getTotalPrice() }}</td>
                                    <td><a href="{{ url("cart/removeItem/" . $product->id)  }}" class="btn btn-danger"><i class="fa fa-times"></i></a></td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-md-4 col-xs-12">
                    <div class="order-resume panel panel-success">

                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>
                                        Subtotal( {{ $cart->getTotalQuantity() }} ):
                                    </td>
                                    <td>
                                        <div class="pull-right"> {{ $cart->getTotalPrice() }}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Frete:
                                    </td>
                                    <td>
                                        <div class="pull-right">
                                            @isset($frete)
                                                {{ $frete }}
                                            @else
                                                <a class="decoration" href="{{ route("user.address") }}">Cadastrar endereço</a>
                                            @endisset
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Total:
                                    </td>
                                    <td>
                                        <div class="pull-right">
                                            R$
                                            @isset($frete)
                                                {{ $cart->getTotalPrice() + $frete }}
                                            @else
                                                {{ $cart->getTotalPrice() }} <small>(frete não incluso)</small>
                                            @endisset
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <br>

                        @if(!$cart->isEmpty())
                            <a href="{{ route("pedido.address") }}" class="btn btn-primary btn-block">
                                <i class="fa fa-shopping-basket"></i>
                                CONTINUAR COMPRA
                            </a>
                        @else
                            <div class="text-center">
                                Seu carrinho está vazio ! <a class="decoration" href="{{ route("home") }}"> Voltar às compras</a>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </section>


@endsection
