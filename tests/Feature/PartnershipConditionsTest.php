<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Group;
use App\Models\PartnershipConditions;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PartnershipConditionsTest extends TestCase
{
    use RefreshDatabase;

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
            route('staff.partnership-conditions.create')
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot store a new version of the partnership conditions.
     */
    public function testANonAuthorizedUserCannotStoreANewVersionOfThePartnershipConditions()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()->for(Group::factory())
            )
            ->create();

        $partnershipConditionsData = PartnershipConditions::factory()->make();

        $response = $this->actingAs($user)->post(
            route('staff.partnership-conditions.store'),
            $partnershipConditionsData->toArray()
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
                        'name' => 'Edit partnership conditions & information',
                        'slug' => 'edit-partnership-conditions-and-info',
                    ]))
            )
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.partnership-conditions.create')
        );

        $response->assertStatus(200);
    }

    /**
     * Test that an authorized user can store a new version of the partnership conditions.
     */
    public function testAnAuthorizedUserCanStoreANewVersionOfThePartnershipConditions()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Edit partnership conditions & information',
                        'slug' => 'edit-partnership-conditions-and-info',
                    ]))
            )
            ->create();

        $numberOfActivities = Activity::count();

        $partnershipConditionsData = PartnershipConditions::factory()->make();

        $response = $this->actingAs($user)->post(
            route('staff.partnership-conditions.store'),
            $partnershipConditionsData->toArray()
        );

        $this->assertDatabaseHas('partnership_conditions', [
            'content' => $partnershipConditionsData['content'],
        ]);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('partners'));
    }
}
