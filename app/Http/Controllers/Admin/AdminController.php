<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
        public function index() {
            $numberOfOrdersCreatedToday = Order::whereDate("created_at",  \Carbon\Carbon::now()->format('Y-m-d'))->count();

            return view('admin.index', [ "numberOfOrdersCreatedToday" => $numberOfOrdersCreatedToday ]);
        }
}
