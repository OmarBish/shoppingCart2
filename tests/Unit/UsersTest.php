<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use refreshDatabase;
    /** @test */
    public function a_user_may_have_cart()
    {
        $user=factory('App\User')->create();


        $user->cart()->create();
        $this->assertTrue($user->cart()->get() != null );
    }
}
