<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TemporaryPasswordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a new user must change his temporary password.
     */
    public function testNewUserMustChangeHisTemporaryPassword()
    {
        $user = User::factory()
            ->withTemporaryPassword()
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.hub')
        );

        $response->assertStatus(302);
    }

    /**
     * Test that a user without temporary password must not change his temporary password.
     */
    public function testUserWithoutTemporaryPasswordMustNotChangeHisTemporaryPassword()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(
            route('staff.hub')
        );

        $response->assertStatus(200);
    }
}
