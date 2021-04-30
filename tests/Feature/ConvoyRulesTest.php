<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\ConvoyRules;
use App\Models\Group;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConvoyRulesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that everyone can see the convoy rules.
     */
    public function testEveryoneCanSeeTheConvoyRules()
    {
        $response = $this->get(
            route('convoy-rules.show')
        );

        $response->assertStatus(200);
    }

    /**
     * Test that a non-authorized user cannot see the creation page.
     */
    public function testANonAuthorizedUserCannotSeeTheCreationPage()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()->for(Group::factory())
            )
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.convoy-rules.create')
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot store a new version of the convoy rules.
     */
    public function testANonAuthorizedUserCannotStoreANewVersionOfTheConvoyRules()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()->for(Group::factory())
            )
            ->create();

        $convoyRulesData = ConvoyRules::factory()->make();

        $response = $this->actingAs($user)->post(
            route('staff.convoy-rules.store'),
            $convoyRulesData->toArray()
        );

        $response->assertStatus(403);
    }

    /**
     * Test that an authorized user can see the creation page.
     */
    public function testAnAuthorizedUserCanSeeTheCreationPage()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Edit convoy rules',
                        'slug' => 'edit-convoy-rules',
                    ]))
            )
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.convoy-rules.create')
        );

        $response->assertStatus(200);
    }

    /**
     * Test that an authorized user can store a new version of the convoy rules.
     */
    public function testAnAuthorizedUserCanStoreANewVersionOfTheConvoyRules()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Edit convoy rules',
                        'slug' => 'edit-convoy-rules',
                    ]))
            )
            ->create();

        $numberOfActivities = Activity::count();

        $convoyRulesData = ConvoyRules::factory()->make();

        $response = $this->actingAs($user)->post(
            route('staff.convoy-rules.store'),
            $convoyRulesData->toArray()
        );

        $this->assertDatabaseHas('convoy_rules', [
            'content' => $convoyRulesData['content'],
        ]);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('convoy-rules.show'));
    }
}
