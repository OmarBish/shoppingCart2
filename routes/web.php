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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->post('/cart', function () {
    $attr['user_id']=auth()->id();
    $attr['total']=0;
    $attr['product_count']=0;
    $cart = App\cart::updateOrCreate($attr); 

    return [
        'cart' => $cart
    ];
});

Route::middleware('auth')->get('/cart', function () {
    // $attr['user_id']=auth()->id();
    
    // $cart = App\cart::create($attr); 

    return view('creatCart');
});

Route::post('/cart/add', function () {
    
//     $attr = request()->validate([
//         'products' => 'required',
//     ]);
//     $products = $attr['products'];
//    $cart=App\cart::get()->where('id',auth()->id());
//     foreach ($products as $product){
        
//         App\product::create([
//             'cart_id'=>$cart[0]->id,
//             'name'=>$product['name'],
//             'price'=>$product['price'],
//             'currency_iso_code'=>$product['currency_iso_code']
//         ]);
//     }
    
    $attr = request()->validate([
        'name' => 'required',
        'price' => 'required',
        'currency_iso_code' => 'required',
    ]);
    
    $cart=App\cart::get()->where('id',auth()->id())->first();
    
        
        App\product::create([
            'cart_id'=>$cart->id,
            'name'=>$attr['name'],
            'price'=>$attr['price'],
            'currency_iso_code'=>$attr['currency_iso_code']
        ]);
    
    
    
        $count=App\product::get()->where('cart_id',$cart->id)->count();
        $sum=App\product::get()->where('cart_id',$cart->id)->sum('price');
    return [
        'status' => "success",
        'products' => App\product::get()->where('cart_id',$cart->id),
        'count' =>  $count,
        'sum' => $sum
    ];
    

});
Auth::routes();

Route::get('/home', 'HomeController@index');

