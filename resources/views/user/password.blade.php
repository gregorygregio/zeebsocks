@extends('layouts.app')

@section('title', "Alteração de senha")

@section('custom-css-links')
    <link href="{{ asset('css/user/index.css') }}" rel="stylesheet">
@endsection




@section('content')
    <section class="section-block">
        <div class="container">
            <div class="row">
                <div class="col-md-12">


                    @component('components.panel', [ 'title' => 'Alteração de senha' ])

                        <form action="{{ route('user.password.store') }}" method="POST">


                            <div class="row">
                                {{ csrf_field() }}

                                <div class="form-group  col-md-12 col-xs-12">
                                    <label class="col-sm-12 col-form-label">Senha atual</label>
                                    <div class="col-sm-12">
                                        <input type="password" name="currentPassword" class="form-control" required>
                                    </div>
                                </div>


                                <div class="form-group  col-md-12 col-xs-12">
                                    <label class="col-sm-12 col-form-label">Nova senha</label>
                                    <div class="col-sm-12">
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                </div>


                                <div class="form-group  col-md-12 col-xs-12">
                                    <label class="col-sm-12 col-form-label">Confirmar senha</label>
                                    <div class="col-sm-12">
                                        <input type="password" name="password_confirmation" class="form-control" required>
                                    </div>
                                </div>

                            </div>

                            <button class="btn btn-success btn-block" id="btnSalvar">
                                <i class="fa fa-save"></i>
                                SALVAR
                            </button>


                            @if(session("success"))
                                <br />
                                <div class="alert alert-success text-center">
                                    {{ session("success")  }}
                                </div>
                            @elseif(session("error") || $errors->any())
                                <br />
                                <div class="alert alert-danger text-center">
                                    {{ session("error")  }}

                                    <ul style="list-style-type: none">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif



                        </form>

                    @endcomponent
                </div>
            </div>
        </div>
    </section>
@endsection