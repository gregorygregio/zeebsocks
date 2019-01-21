<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::redirect('/', '/home');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/product/{product}', "HomeController@showProduct");


Route::post('/cart/add/{id}', "CartController@addItem");

Route::get('/cart', "CartController@index")->name('cart');

Route::get('/cart/removeItem/{id}', "CartController@removeItem");


Route::middleware('auth')->group(function(){

    Route::get('/pedido', "PedidoController@index")->name("pedido.index");
    Route::get('/pedido/address', "PedidoController@confirmAddress")->name("pedido.address");


    Route::get('/pedido/summary', "PedidoController@sumPedido")->name('pedido.summary');
    Route::get('/pedido/end', "PedidoController@endPedido")->name('pedido.end');
    Route::get('/pedido/list/{status?}', "PedidoController@listOrders")->name('pedido.list');

    Route::get('/user', "UserController@index")->name('user.index');
    Route::get('/user/password', "UserController@alterPassword")->name('user.password');
    Route::get('/user/profile', "UserController@alterProfile")->name('user.profile');
    Route::get('/user/address', "UserController@alterAddress")->name('user.address');
    Route::get('/user/address/{zipcode}', "UserController@getLocationByZipCode");

    Route::post('/user/address', "UserController@storeAddress")->name('user.address.store');
    Route::post('/user/password', "UserController@storePassword")->name('user.password.store');
    Route::post('/user/profile', "UserController@storeProfile")->name('user.profile.store');



    Route::get('/pagseguro/redirect', "PedidoController@redirectPagSeguro")->name('pagseguro.redirect');
});



Route::group(["middleware" => ['auth', 'admin'] ], function () {

    Route::get('/adm/panel', "Admin\AdminController@index")->name('admin.index');

    Route::get('/adm/panel/products', "Admin\ProductController@list")->name('admin.products');

    Route::get('/adm/panel/products/edit/{id}', "Admin\ProductController@edit")->name('admin.products.edit');

    Route::post('/adm/panel/products/update/{id}', "Admin\ProductController@update")->name('admin.products.update');

    Route::get('/adm/panel/products/create', "Admin\ProductController@create")->name('admin.products.create');

    Route::post('/adm/panel/products/store', "Admin\ProductController@store")->name('admin.products.store');

    Route::get('/adm/panel/orders/{state}', "Admin\PedidoController@listOrders")->name('admin.orders');

    Route::get('/adm/panel/orders/show/{orderId}', "Admin\PedidoController@showOrder")->name('admin.orders.view');

});






Route::post('/pagseguro/notification', [
    'uses' => '\laravel\pagseguro\Platform\Laravel5\NotificationController@notification',
    'as' => 'pagseguro.notification',
]);


// Route::post('/pagseguro/notification', function() {
//   $job = (new App\Jobs\SendTestMailJob)
//       ->delay( Carbon\Carbon::now()->addSeconds(5) );
//   dispatch($job);
// })->name('pagseguro.notification');


Route::get('scheduleemail', function() {
    $job = (new App\Jobs\SendTestMailJob)
        ->delay( Carbon\Carbon::now()->addSeconds(15) );
    dispatch($job);
      //  $data = array('name'=>"Virat Gandhi");
      //  Mail::send('mail', $data, function($message) {
      //     $message->to('abc@gmail.com', 'Tutorials Point')->subject
      //        ('Laravel HTML Testing Mail');
      //     $message->from('xyz@gmail.com','Virat Gandhi');
      //  });
       echo "HTML Email Sent. Check your inbox.";
});

Route::get('sendhtmlemail', function() {
  Mail::to('gregorygregio27@gmail.com', 'Gregory Gregio')
  ->send(new App\Mail\SendTestEmail("nome"));
       echo "HTML Email Sent. Check your inbox.";
});
