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


                    @component('components.panel', [ 'title' => 'Confirmar Endereço' ])
                        @if($hasAddress)

                            <div class="text-center">
                                <h3>Por favor, verifique se o endereço a seguir está atualizado</h3>
                            </div>
                            <br>

                            <form action="{{ route('user.address.store') }}" method="POST">
                                @include("components.address-form", ['edit' => !$hasAddress, "address" => $address ])
                            </form>

                                <div class="row">
                                    <div class="col-lg-4 col-xs-12">

                                        <a href="{{ route('user.address') }}" class="btn btn-block btn-warning"  >
                                            <i class="fa fa-wrench"></i>
                                            CORRIGIR INFORMAÇÕES
                                        </a>
                                        <br>
                                        <br>
                                    </div>

                                    <div class="col-lg-4 col-lg-offset-4  col-xs-12  col-xs-offset-0">

                                        <a class="btn btn-success btn-block" href="{{ route("pedido.summary") }}" >
                                            <i class="fa fa-check"></i>
                                            CONFIRMAR
                                        </a>
                                    </div>
                                </div>

                                @if(session("success"))
                                    <br />
                                    <div class="alert alert-success text-center">
                                        {{ session("success")  }}
                                    </div>
                                @endif


                        @else
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3 col-xs-12">
                                    <h3>Você ainda não cadastrou seu endereço !</h3>
                                </div>
                            </div>

                            <a type="button" href="{{ route('user.address') }}" class="btn btn-success btn-block" >
                                <i class="fa fa-plus"></i>
                                CADASTRAR
                            </a>
                        @endif


                    @endcomponent

                </div>
            </div>
        </div>
    </section>
@endsection