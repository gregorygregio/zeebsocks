@extends('layouts.app')

@section('title', "Confirmar Endereço")

@section('custom-css-links')
    <link href="{{ asset('css/user/index.css') }}" rel="stylesheet">
@endsection

@section('content')
    <section class="section-block">
        <div class="container">
            <div class="row">
                <div class="col-md-12">


                    @component('components.panel', [ 'title' => 'Pedido Finalizado !' ])
                        <div class="row text-center">
                            <!--div class="pull-left">
                                <img src="{{ asset("/images/zeeb-tiger.png") }}"/>
                            </div-->
                            <h1>Obrigado !</h1>
                        </div>

                    @endcomponent

                </div>
            </div>
        </div>
    </section>
@endsection