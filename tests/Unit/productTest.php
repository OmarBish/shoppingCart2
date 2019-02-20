<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class productTest extends TestCase
{
    use refreshDatabase;

    /** @test */
    public function a_cart_may_have_many_products()
    {
        $user=factory('App\User')->create();

        $cart=$user->cart()->create();

        $cart->products()->create([
            'name' => 'java',
            'price' => '100'
        ]);

        $this->assertEquals('java',$cart->products()->first()->name);
        $this->assertEquals('100',$cart->products()->first()->price);


    }
}
