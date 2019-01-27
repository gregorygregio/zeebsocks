@extends('layouts.mail')

@section('title', 'Zeeb - Status Pago')

@section('custom-css-links')
    .tiger-image{
      display: none;
    }

    .pedido-table{
      width: 96%;
    }
    @media (min-width: 768px){
        .pedido-table{
          display:inline-block;
          vertical-align: top;
        }
        .tiger-image {
          width: 16%;
          display:inline-block;
        }
        .tiger-image img{
          width: 100%;
        }

        .pedido-table{
          width: 82%;
        }
    }

    .pedido-table table {
      font-size: 18px;
      width: 100%;
      border-top: solid 2px #d3e0e9;
      border-collapse: collapse;
      border-spacing: 0;
    }

    .pedido-table table tr td {
      padding: 8px;
      line-height: 1.6;
      border-bottom: 1px solid #ddd;
      text-align:center;
    }

    .pedido-table table tfoot  {
      background-color: #ddd;
      font-weight:bold;
    }

    .pedido-table table .product-img {
      width: 65px;
    }

@endsection


@section('main-message')
    <div class="text-center">
      O seu pagamento foi aceito !
    </div>
@endsection
@section('content')

    <p>
      Olá, {{ $order->client->getFirstName() }} ! O seu pagamento pelo pedido de código {{ $order->id }} foi confirmado. O seu pedido deverá ser enviado em breve.
    </p>

    <div class="pedido-items">
      <div class="tiger-image">
        <img src="{{ asset("/images/zeeb-tiger.png") }}"/>
      </div>
      <div class="pedido-table">


        <table class="table">
            <thead>
              <tr>
                <th></th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Valor</th>
              </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <?php $product = $item->product ?>
                <tr>
                    <td><img class="product-img" src="{{ asset("/storage/products/thumbs/" . $product->type_r->type . "/"  . $product->main_image) }}" /></td>
                    <td><a href="{{ url("product/" . $product->url_id)  }}">{{ $product->name }}</a></td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->getTotalPrice() }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
              <tr>
                  <td>
                    Código do pedido: {{ $order->id }}
                  </td>
                  <td></td>
                  <td></td>
                  <td>R$ {{ $order->order_total }}</td>
              </tr>
            </tfoot>
        </table>

      </div>

    </div>
@endsection
