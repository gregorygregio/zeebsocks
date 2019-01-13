@extends('layouts.app')

@section('title', $product->name  )

@section('custom-css-links')
    <link href="{{ asset('css/product/show.css') }}" rel="stylesheet">
@endsection

@section('content')



    <section class="section-block">


        <div class="container">
            <div class="row">


                <div class="col-md-4 col-xs-12">
                    <div class="product-img-displayer">
                        <img src="{{ asset("/storage/products/" . $product->type_r->type . "/"  . $product->main_image) }}" />
                    </div>
                </div>



                <div class="col-md-8 col-xs-12">
                    <h2>{{ $product->name  }}</h2>
                    <h4>R$ {{ $product->price  }}</h4>

                    <div class="product-description">
                        {{ $product->description }}
                    </div>

                    <form method="POST" action="{{ url("/cart/add/" . $product->id) }}">

                        {{ csrf_field() }}

                        <label class="form-group">
                            Quantidade: <input type="number" class="product-quantity" value="1" name="quantity">
                        </label>

                        <div class="button-add-carrinho">
                            <button class="btn btn-block btn-success">Adicionar ao carrinho <i class="fa fa-shopping-cart"></i></button>
                        </div>

                        <br>
                        @if(session('success'))

                            <div class="alert alert-success text-center">
                                {{ session('success')  }}
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-danger text-center">
                                {{ session('error')  }}
                            </div>
                        @endif

                    </form>
                </div>


            </div>
        </div>

    </section>

    <section class="section-block">
        <div class="container">
          <h3>Produtos semelhantes</h3>
          <div class="row">
              @foreach($relatedProducts as $relatedProduct)
                <div class="col-lg-3 col-xs-12">
                  @component("components.product-frame", [ "product" => $relatedProduct ])
                  @endcomponent
                </div>
              @endforeach
          </div>
        </div>
    </section>


@endsection
