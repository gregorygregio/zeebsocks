@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop


@section('css')
    <link rel="stylesheet" href="{{ asset('/css/admin_custom.css') }}">
@stop

@section('js')
  <script src="{{ asset('/js/admin/product/form.js') }}"></script>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3>Atualização</h3>
                </div>

                <div class="box-body">
                  <form method="post" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">


                    {{ csrf_field() }}

                    <div class="form-group">
                      <input type="text" class="form-control" name="name" placeholder="Nome do produto" id="inputName" value="{{$product->name}}">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="price" placeholder="Preço" id="inputPrice" value="{{$product->price}}">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="url_id" placeholder="URL" id="inputURL" value="{{$product->url_id}}">
                    </div>


                    <div class="form-group">
                      <label>
                        Tipo de produto
                      </label>
                        <select type="text" class="form-control" name="type" >
                          @foreach($productTypes as $type)
                            <option value="{{ $type->id }}" {{ $type->id == $product->type ? "selected=selected" : "" }}>
                              {{ $type->type }}
                            </option>
                          @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                      <textarea class="form-control" name="description" placeholder="Descrição" rows="5">{{$product->description}}</textarea>
                    </div>


                    <div class="form-group">
                      <label>Imagem Principal</label>
                      <input type="file" id="mainImage" class="form-control" name="main_image" style="display: none">
                      <input type="hidden" id="imageUpdated" name="image_updated" value="0">
                      <button id="btnAlterarImagem" class="btn btn-warning">Alterar Imagem</button>
                    </div>
                      <img class="product-main-img" src="{{ asset("/storage/products/" . $product->type_r->type . "/"  . $product->main_image) }}" />

                    <div class="form-group">
                      <button class="btn btn-success pull-right">Salvar <i class="fa fa-save"></i></button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
@stop
