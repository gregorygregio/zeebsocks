<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Order;


class PedidoController extends Controller
{
    public function listOrders($status) {

        $openOrders = Order::where("status", Order::getStatusCodeByName($status))->get();
        return view('admin.orders.list', [
          "orders" => $openOrders
        ]);
    }

    public function showOrder($orderId){
      $order = Order::find($orderId);
      return view('admin.orders.show', [
        "order" => $order,
        "client" => $order->client,
      ]);
    }

}
