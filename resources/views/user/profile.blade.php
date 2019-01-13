@extends('layouts.app')

@section('title', "Alteração de dados pessoais")

@section('custom-css-links')
    <link href="{{ asset('css/user/index.css') }}" rel="stylesheet">
@endsection



@section('custom-js-links')
    <script src="{{ asset('js/vanilla-masker.min.js') }}"></script>
    <script src="{{ asset('js/user/profile.js') }}"></script>
@endsection


@section('content')
    <section class="section-block">
        <div class="container">
            <div class="row">
                <div class="col-md-12">


                    @component('components.panel', [ 'title' => 'Alteração de dados pessoais' ])

                        <form action="{{ route('user.profile.store') }}" method="POST" id="profileForm">


                            <div class="row">
                                {{ csrf_field() }}

                                <div class="form-group  col-md-12 col-xs-12">
                                    <label class="col-sm-12 col-form-label">Nome</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                    </div>
                                </div>


                                <div class="form-group  col-md-12 col-xs-12">
                                    <label class="col-sm-12 col-form-label">Telefone</label>
                                    <div class="col-sm-12">
                                        <input type="text" id="phoneInput" name="phone" class="form-control" value="{{ $user->phone }}" required>
                                    </div>
                                </div>


                                <div class="form-group  col-md-12 col-xs-12">
                                    <label class="col-sm-12 col-form-label">Data de nascimento</label>
                                    <div class="col-sm-12">
                                        <input type="text" id="birthInput" name="birth" class="form-control" value="{{ $user->birth }}" required>
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