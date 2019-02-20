<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\App\cart;

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
            $cart=true;
        }
        return view('home')->with([
            'cart' => $cart
        ]);
            
    }
}
