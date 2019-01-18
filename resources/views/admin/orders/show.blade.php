@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop


@section('content')
    <div class="container">

        <div class="row">
          <div class="col-md-11 col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3>Pedido </h3>
              </div>


              <div class="box-body">
                <div class="container">
                  <h4>Cliente</h4>
                  <div class="row">

                    <div class="col-lg-2">
                      <label>
                        Nome
                      </label>
                      <div class="form-group">
                        {{$client->name}}
                      </div>
                    </div>

                    <div class="col-lg-2">
                      <label>
                        E-mail
                      </label>
                      <div class="form-group">
                        {{$client->email}}
                      </div>
                    </div>

                    <div class="col-lg-2">
                      <label>
                        CPF
                      </label>
                      <div class="form-group">
                        {{$client->cpf}}
                      </div>
                    </div>

                    <div class="col-lg-2">
                      <label>
                        TELEFONE
                      </label>
                      <div class="form-group">
                        {{$client->phone}}
                      </div>
                    </div>

                    <div class="col-lg-2">
                      <label>
                        DATA DE NASCIMENTO
                      </label>
                      <div class="form-group">
                        {{$client->birth}}
                      </div>
                    </div>

                  </div>
                </div>

                <div class="container">
                  <hr />
                  <h4>Endereço de Entrega</h4>
                  <div class="row">

                    <div class="col-lg-2">
                      <label>
                        Logradouro
                      </label>
                      <div class="form-group">
                        {{$client->address->address}}
                      </div>
                    </div>

                    <div class="col-lg-1">
                      <label>
                        Número
                      </label>
                      <div class="form-group">
                        {{$client->address->number}}
                      </div>
                    </div>
                    @if(!is_null($client->address->complement))

                      <div class="col-lg-1">
                        <label>
                          Complemento
                        </label>
                        <div class="form-group">
                          {{$client->address->complement}}
                        </div>
                      </div>
                    @endif


                    <div class="col-lg-2">
                      <label>
                        Bairro
                      </label>
                      <div class="form-group">
                        {{$client->address->bairro}}
                      </div>
                    </div>

                    <div class="col-lg-2">
                      <label>
                        Cidade
                      </label>
                      <div class="form-group">
                        {{$client->address->city}}
                      </div>
                    </div>

                    <div class="col-lg-1">
                      <label>
                        Estado
                      </label>
                      <div class="form-group">
                        {{$client->address->state}}
                      </div>
                    </div>

                    <div class="col-lg-1">
                      <label>
                        CEP
                      </label>
                      <div class="form-group">
                        {{$client->address->zipcode}}
                      </div>
                    </div>
                  </div>
                </div>

                <div class="container">
                  <hr />
                  <div class="row">
                    <div class="col-lg-4">
                      <label>
                        DATA DO PEDIDO
                      </label>
                      <div class="form-group">
                        {{ $order->getOrderDate() }}
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <label>
                        DATA DO PAGAMENTO
                      </label>
                      <div class="form-group">
                        {{ $order->getPaymentDate() }}
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <label>
                        DATA DE ENTREGA
                      </label>
                      <div class="form-group">
                        {{ $order->payment_date }}
                      </div>
                    </div>
                  </div>
                </div>



                <div class="">
                  <div class="box-body table-responsive no-padding">
                      <table class="table table-hover" id="">
                          <thead>
                            <tr>
                                <th>NOME</th>
                                <th>QUANTIDADE</th>
                                <th>VALOR</th>
                            </tr>
                          </thead>
                          <tbody>
                                @foreach($order->items as $item)
                                <?php $product = $item->product ?>
                                  <tr>
                                      <td>{{ $product->name }}</td>
                                      <td>{{ $item->quantity }}</td>
                                      <td>{{ $item->total_amount }}</td>
                                  </tr>
                                @endforeach
                          </tbody>
                        </table>
                  </div>
                </div>


                <div class="container">
                  <div class="row">
                    <div class="col-lg-2 col-lg-offset-6">
                        @if($order->status === App\Entities\Order::STATUS_PAGO)
                        <button class="btn btn-success btn-block"><i class="fa fa-truck"></i> Enviar pedido</button>
                        @elseif($order->status === App\Entities\Order::STATUS_ENVIADO)
                        <button class="btn btn-primary btn-block"><i class="fa fa-close"></i> Finalizar pedido</button>
                        @endif
                    </div>
                    <div class="col-lg-2">
                      <button class="btn btn-danger btn-block"><i class="fa fa-trash-o"></i> Cancelar pedido</button>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
    </div>
@stop
