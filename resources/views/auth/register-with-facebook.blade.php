@extends('layouts.app')


@section('title', 'Cadastro')


@section('custom-css-links')
    <link href="{{ asset('css/auth/register.css') }}" rel="stylesheet">
@endsection




@section('custom-js-links')
    <script src="{{ asset('js/vanilla-masker.min.js') }}"></script>
    <script src="{{ asset('js/auth/register.js') }}"></script>
@endsection

@section('content')
    <section class="section-block">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Register</div>

                        <div class="panel-body">
                            <form class="form-horizontal" method="POST" action="{{ route('register.facebook') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="social_id" value="{{ $social_id }}">

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Nome</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ (null !== old('name')) ? old('name') : $user->name }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ (null !== old('email')) ? old('email') : $user->email }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>



                                <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">CPF</label>

                                    <div class="col-md-6">
                                        <input id="cpf" type="text" class="form-control" name="cpf" value="{{ old('cpf') }}" required>

                                        @if ($errors->has('cpf'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('cpf') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Register
                                        </button>
                                        @if (session('error'))
                                            <div class="alert alert-danger text-center">
                                                {{ session('error')  }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
