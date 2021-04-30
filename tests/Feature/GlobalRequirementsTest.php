<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\GlobalRequirements;
use App\Models\Group;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GlobalRequirementsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that everyone can see the global requirements.
     */
    public function testEveryoneCanSeeTheGlobalRequirements()
    {
        $response = $this->get(
            route('global-requirements.show')
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
            route('staff.global-requirements.create')
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot store a new version of the global requirements.
     */
    public function testANonAuthorizedUserCannotStoreANewVersionOfTheGlobalRequirements()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()->for(Group::factory())
            )
            ->create();

        $globalRequirementsData = GlobalRequirements::factory()->make();

        $response = $this->actingAs($user)->post(
            route('staff.global-requirements.store'),
            $globalRequirementsData->toArray()
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
                        'name' => 'Edit global requirements',
                        'slug' => 'edit-global-requirements',
                    ]))
            )
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.global-requirements.create')
        );

        $response->assertStatus(200);
    }

    /**
     * Test that an authorized user can store a new version of the global requirements.
     */
    public function testAnAuthorizedUserCanStoreANewVersionOfTheGlobalRequirements()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Edit global requirements',
                        'slug' => 'edit-global-requirements',
                    ]))
            )
            ->create();

        $numberOfActivities = Activity::count();

        $globalRequirementsData = GlobalRequirements::factory()->make();

        $response = $this->actingAs($user)->post(
            route('staff.global-requirements.store'),
            $globalRequirementsData->toArray()
        );

        $this->assertDatabaseHas('global_requirements', [
            'content' => $globalRequirementsData['content'],
        ]);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('global-requirements.show'));
    }
}
