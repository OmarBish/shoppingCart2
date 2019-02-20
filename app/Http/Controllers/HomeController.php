<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cart=auth()->user()->cart()->first();
        

        if($cart == Null){
            $cart =false;
        }else{
            $cart_id=$cart->id;
            $cart=true;
        }
        
        $products=product::get()->where('cart_id',$cart_id);
        return view('home')->with([
            'cart' => $cart,
            'products' => $products,
            'count' => $products->count(),
            'total' => $products->sum('price')
        ]);
            
    }
}
