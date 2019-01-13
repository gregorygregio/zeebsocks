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
                  <h3>Cadastro</h3>
                </div>

                <div class="box-body">
                  <form method="post" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">


                    {{ csrf_field() }}

                    <div class="form-group">
                      <input type="text" class="form-control" name="name" placeholder="Nome do produto" id="inputName">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="price" placeholder="Preço" id="inputPrice">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="url_id" placeholder="URL" id="inputURL">
                    </div>


                    <div class="form-group">
                      <label>
                        Tipo de produto
                      </label>
                        <select type="text" class="form-control" name="type" >
                          @foreach($productTypes as $type)
                            <option value="{{ $type->id }}">
                              {{ $type->type }}
                            </option>
                          @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                      <textarea class="form-control" name="description" placeholder="Descrição" rows="5"></textarea>
                    </div>


                    <div class="form-group">
                      <label>Imagem Principal</label>
                      <input type="file" class="form-control" name="main_image" >
                    </div>

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
