@extends('layouts.app')

@section('title', 'Início')

@section('custom-css-links')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('content')

<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 banner" id="homeBanner">
                <div id="zeebLogo">
                    <img src="{{ asset("/images/logo.jpeg") }}"/>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="section-block">


    <div class="container">

        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-lg-3 col-md-4 col-xs-12">
                            <a href="{{ url("/product/" . $product->url_id) }}">
                                <div class="product-box product-exibition">
                                    <img class="product-img" src="{{ asset("/storage/products/thumbs/" . $product->type_r->type . "/"  . $product->main_image) }}" />
                                    <div class="product-description">{{ $product->name  }}</div>
                                    <div class="product-price">R$ {{ $product->price  }}</div>
                                </div>
                            </a>
                        </div>

                    @endforeach
                </div>
            </div>
            <div class="col-md-3 col-xs-12">
                <!--img src="{{ asset("/images/zeeb-tiger.png") }}" style="height: 830px;"/-->
            </div>
        </div>
    </div>

</section>


@endsection
