<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;

class SignUpTest extends TestCase
{
    /**
     * Test SignUp
     *
     * @return void
     */
    public function signup_Test()
    {
        $user = factory(User::class)->make();

        $response = $this->get('/register');
        $response->assertStatus(200);

        $response = $this->postJson('/register', [
            'email' => $user->email,
            'password'=>'123123123',
            'password_cofirm'=>'123123123'
            ]);
            $response->assertStatus(200);

    }
}
