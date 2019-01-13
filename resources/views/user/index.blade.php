@extends('layouts.app')

@section('title', $user->name)

@section('custom-css-links')
    <link href="{{ asset('css/user/index.css') }}" rel="stylesheet">
@endsection


@section('content')
    <section class="section-block">
        <div class="container">
            <div class="row">
                <div class="col-md-12">


                    @component('components.panel', [ 'title' => 'Dados de conta' ])

                        <div class="row">
                            @component('components.form-group', [ 'label' => 'EMAIL', 'value' => $user->email , 'readonly' => true, "name" => "" ])
                            @endcomponent

                            <div class="form-group  col-md-6 col-xs-12">
                                <label for="inputPassword" class="col-sm-2 col-form-label">SENHA</label>
                                <div class="col-sm-12">
                                    <a type="button" href="{{ route('user.password') }}" class="btn btn-primary btn-block" >ALTERAR SENHA</a>
                                </div>
                            </div>
                        </div>

                    @endcomponent



                    @component('components.panel', [ 'title' => 'Dados pessoais' ])
                        <div class="row">

                            @component('components.form-group', [ 'label' => 'NOME', 'value' => $user->name, 'readonly' => true, "name" => "" ])
                            @endcomponent

                            @component('components.form-group', [ 'label' => 'CPF', 'value' => $user->cpf, 'readonly' => true, "name" => "" ])
                            @endcomponent


                            @component('components.form-group', [ 'label' => 'Telefone', 'value' => $user->phone, 'readonly' => true, "name" => "" ])
                            @endcomponent


                            @component('components.form-group', [ 'label' => 'DATA DE NASCIMENTO', 'value' => $user->birth, 'readonly' => true, "name" => "" ])
                            @endcomponent

                        </div>

                        <a type="button" href="{{ route('user.profile') }}" class="btn btn-primary btn-block" >
                            <i class="fa fa-wrench"></i>
                            EDITAR
                        </a>

                    @endcomponent



                    @component('components.panel', [ 'title' => 'Endereço' ])

                        @if(is_null($user->address))
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-3 col-xs-12">
                                        <h3>Você ainda não cadastrou seu endereço !</h3>
                                    </div>
                                </div>

                                <a type="button" href="{{ route('user.address') }}" class="btn btn-success btn-block" >
                                    <i class="fa fa-plus"></i>
                                    CADASTRAR
                                </a>
                        @else


                                @include("components.address-form", ['edit' => false, "address" => $user->address])


                                <a type="button" href="{{ route('user.address') }}" class="btn btn-primary btn-block" >
                                    <i class="fa fa-wrench"></i>
                                    EDITAR
                                </a>

                        @endif
                    @endcomponent


                </div>
            </div>
        </div>
    </section>
@endsection