<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Group;
use App\Models\Permission;
use App\Models\PrivacyPolicy;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PrivacyPolicyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that everyone can see the privacy policy.
     */
    public function testEveryoneCanSeeThePrivacyPolicy()
    {
        $response = $this->get(
            route('privacy-policy.show')
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
            route('staff.website-settings.privacy-policy.create')
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot store a new version of the privacy policy.
     */
    public function testANonAuthorizedUserCannotStoreANewVersionOfThePrivacyPolicy()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()->for(Group::factory())
            )
            ->create();

        $privacyPolicyData = PrivacyPolicy::factory()->make();

        $response = $this->actingAs($user)->post(
            route('staff.website-settings.privacy-policy.store'),
            $privacyPolicyData->toArray()
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
                        'name' => 'Edit privacy policy',
                        'slug' => 'edit-privacy-policy',
                    ]))
            )
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.website-settings.privacy-policy.create')
        );

        $response->assertStatus(200);
    }

    /**
     * Test that an authorized user can store a new version of the privacy policy.
     */
    public function testAnAuthorizedUserCanStoreANewVersionOfThePrivacyPolicy()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Edit privacy policy',
                        'slug' => 'edit-privacy-policy',
                    ]))
            )
            ->create();

        $numberOfActivities = Activity::count();

        $privacyPolicyData = PrivacyPolicy::factory()->make();

        $response = $this->actingAs($user)->post(
            route('staff.website-settings.privacy-policy.store'),
            $privacyPolicyData->toArray()
        );

        $this->assertDatabaseHas('privacy_policies', [
            'content' => $privacyPolicyData['content'],
        ]);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('privacy-policy.show'));
    }
}
