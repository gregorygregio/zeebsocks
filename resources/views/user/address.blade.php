@extends('layouts.app')

@section('title', "Endereço")

@section('custom-css-links')
    <link href="{{ asset('css/user/index.css') }}" rel="stylesheet">
@endsection



@section('custom-js-links')
    <script src="{{ asset('js/freteService.js') }}"></script>
    <script src="{{ asset('js/vanilla-masker.min.js') }}"></script>
    <script src="{{ asset('js/user/address.js') }}"></script>
@endsection

@section('content')
    <section class="section-block">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger text-center" id="formAlert">
                    </div>

                    @component('components.panel', [ 'title' => 'Endereço' ])

                        <form action="{{ route('user.address.store') }}" method="POST">
                            @include("components.address-form", ['edit' => false, "address" => $address ])

                            <button class="btn btn-success btn-block" disabled="disabled" id="btnSalvar">
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