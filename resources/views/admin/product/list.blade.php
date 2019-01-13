@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="{{ asset('/js/admin/product/list.js') }}"></script>
@stop


@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-11 col-xs-12">
              <div class="row">
                <p class="pull-right">
                  <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Novo <i class="fa fa-plus"></i></a>
                </p>
              </div>
                @component('admin.lte-components.table', [
                    "title" => "Produtos",
                    "tableId" => "tabelaProdutos"
                ])

                  @slot("thead")
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>URL</th>
                        <th>Data de criação</th>
                        <th>Thumbnail</th>
                        <th></th>
                    </tr>
                  @endslot

                    @foreach($products as $product)
                      <tr>
                          <td class="product-id">{{ $product->id }}</td>
                          <td class="product-name">{{ $product->name }}</td>
                          <td>{{ $product->url_id }}</td>
                          <td>{{ $product->getCreationData() }}</td>
                          <td><img class="product-img" src="{{ asset("/storage/products/thumbs/" . $product->type_r->type . "/"  . $product->main_image) }}" /></td>
                          <td>
                            <a href="{{ route("admin.products.edit", $product->id) }}">
                              <i class="fa fa-wrench"></i>
                            </a>
                          </td>
                      </tr>
                    @endforeach
                @endcomponent
            </div>
        </div>
    </div>
@stop
