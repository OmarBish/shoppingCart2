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

    $cart=auth()->user()->cart()->first();
        

    if($cart == Null){
        $cart =false;
        return view('home')->with([
            'cart' => $cart,
            'products' => '',
            'count' => '',
            'total' => ''
        ]);
    }else{
        $cart_id=$cart->id;
        $cart=true;
        $products=App\product::get()->where('cart_id',$cart_id);
    return view('home')->with([
        'cart' => $cart,
        'products' => $products,
        'count' => $products->count(),
        'total' => $products->sum('price')
        ]);
    }
});

Route::middleware('auth')->get('/cart', function () {
    // $attr['user_id']=auth()->id();
    
    // $cart = App\cart::create($attr); 

    return view('home')->with([
        'cart' => auth()->user()->cart()->first()->id,
    ]);
});

Route::middleware('auth')->post('/cart/add', function () {
    $attr = request()->validate([
        'name' => 'required',
        'price' => 'required|integer',
        'currency_iso_code' => 'required',
    ]);
    
    $cart=auth()->user()->cart()->first();
    
        
        $product=App\product::create([
            'cart_id'=>$cart->id,
            'name'=>$attr['name'],
            'price'=>$attr['price'],
            'currency_iso_code'=>$attr['currency_iso_code']
        ]);
    
    
    
        $count=App\product::get()->where('cart_id',$cart->id)->count();
        $sum=App\product::get()->where('cart_id',$cart->id)->sum('price');



        $cart=auth()->user()->cart()->first();
        

    if($cart == Null){
        $cart =false;
        return view('home')->with([
            'cart' => $cart,
            'products' => '',
            'count' => '',
            'total' => ''
        ]);
    }else{
        $cart_id=$cart->id;
        $cart=true;
        $products=App\product::get()->where('cart_id',$cart_id);
    return view('home')->with([
        'cart' => $cart,
        'products' => $products,
        'count' => $products->count(),
        'total' => $products->sum('price'),
        'name' => $product->name,
        'price' => $product->price,
        'currency_iso_code' => $product->currency_iso_code
        ]);
    }

});
Auth::routes();

Route::get('/home', 'HomeController@index');

