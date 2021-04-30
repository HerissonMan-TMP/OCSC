<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a user can log in.
     */
    public function testUserCanLogIn()
    {
        $user = User::factory()->create();

        $this->post(
            route('login.authenticate'),
            [
                'email' => $user->email,
                'password' => 'password',
            ]
        );

        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test that a user can log out.
     */
    public function testUserCanLogOut()
    {
        $user = User::factory()->create();

        $this->post(
            route('login.authenticate'),
            [
                'email' => $user->email,
                'password' => 'password',
            ]
        );

        $this->post(route('staff.logout'));

        $this->assertGuest();
    }
}
