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


Route::middleware('auth')->get('/cart', function () {
    // $attr['user_id']=auth()->id();
    
    // $cart = App\cart::create($attr); 

    return view('home')->with([
        'cart' => auth()->user()->cart()->first()->id,
    ]);
});


Auth::routes();

Route::get('/home', 'HomeController@index');



Route::middleware('auth')->post('/a/cart', function () {
    $attr['user_id']=auth()->id();
    $attr['total']=request('total');
    $attr['product_count']=request('product_count');
    $cart = App\cart::updateOrCreate($attr); 

    return [
        'cart' => $cart
    ];
});

Route::middleware('auth')->post('/a/cart/add', function () {
       
    $attr = request()->validate([
        'name' => 'required',
        'price' => 'required',
        'currency_iso_code' => 'required',
    ]);
    
    $cart=App\cart::get()->where('id',auth()->id())->first();
    
        
        $product=App\product::create([
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
        'sum' => $sum,
        "product_id" => $product->id
    ];
    

});

