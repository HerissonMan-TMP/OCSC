<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Group;
use App\Models\LegalNotice;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LegalNoticeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that everyone can see the legal notice.
     */
    public function testEveryoneCanSeeTheLegalNotice()
    {
        $response = $this->get(
            route('legal-notice.show')
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
            route('staff.website-settings.legal-notice.create')
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot store a new version of the legal notice.
     */
    public function testANonAuthorizedUserCannotStoreANewVersionOfTheLegalNotice()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()->for(Group::factory())
            )
            ->create();

        $legalNoticeData = LegalNotice::factory()->make();

        $response = $this->actingAs($user)->post(
            route('staff.website-settings.legal-notice.store'),
            $legalNoticeData->toArray()
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
                        'name' => 'Edit legal notice',
                        'slug' => 'edit-legal-notice',
                    ]))
            )
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.website-settings.legal-notice.create')
        );

        $response->assertStatus(200);
    }

    /**
     * Test that an authorized user can store a new version of the legal notice.
     */
    public function testAnAuthorizedUserCanStoreANewVersionOfTheLegalNotice()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Edit legal notice',
                        'slug' => 'edit-legal-notice',
                    ]))
            )
            ->create();

        $numberOfActivities = Activity::count();

        $legalNoticeData = LegalNotice::factory()->make();

        $response = $this->actingAs($user)->post(
            route('staff.website-settings.legal-notice.store'),
            $legalNoticeData->toArray()
        );

        $this->assertDatabaseHas('legal_notices', [
            'content' => $legalNoticeData['content'],
        ]);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('legal-notice.show'));
    }
}
