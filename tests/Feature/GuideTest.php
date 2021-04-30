<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\Guide;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GuideTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a non-authorized user cannot see a specific guide.
     */
    public function testANonAuthorizedUserCannotSeeASpecificGuide()
    {
        $guide = Guide::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(
            route('staff.guides.show', $guide)
        );

        $response->assertStatus(403);
    }

    /**
     * Test that an authorized user can see a specific guide.
     */
    public function testAnAuthorizedUserCanSeeASpecificGuide()
    {
        $guide = Guide::factory()->create();

        $role = Role::factory()
            ->for(Group::factory())
            ->create();

        $guide->roles()->attach($role);

        $user = User::factory()
            ->hasAttached($role)
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.guides.show', $guide)
        );

        $response->assertStatus(200);
    }

    /**
     * Test that the guides index is not accessible by visitors.
     */
    public function testGuidesIndexIsNotAccessibleByVisitors()
    {
        $response = $this->get(
            route('staff.guides.index')
        );

        $response->assertRedirect(route('login.show-form'));
    }

    /**
     * Test that the guides index is accessible by staff members.
     */
    public function testGuidesIndexIsAccessibleByStaffMembers()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(
            route('staff.guides.index')
        );

        $response->assertStatus(200);
    }

    /**
     * Test that a non-authorized user cannot see the creation page.
     */
    public function testANonAuthorizedUserCannotSeeTheCreationPage()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(
            route('staff.guides.create')
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot store a guide.
     */
    public function testANonAuthorizedUserCannotStoreAGuide()
    {
        $user = User::factory()->create();

        $guideData = Guide::factory()->make()->toArray();

        $response = $this->actingAs($user)->post(
            route('staff.guides.store'),
            $guideData
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot see the edition page.
     */
    public function testANonAuthorizedUserCannotSeeTheEditionPage()
    {
        $user = User::factory()->create();

        $guide = Guide::factory()->create();

        $response = $this->actingAs($user)->get(
            route('staff.guides.edit', $guide)
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot update a guide.
     */
    public function testANonAuthorizedUserCannotUpdateAGuide()
    {
        $user = User::factory()->create();

        $guide = Guide::factory()->create();
        $editedGuideData = Guide::factory()->make()->toArray();

        $response = $this->actingAs($user)->patch(
            route('staff.guides.update', $guide),
            $editedGuideData
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot delete a guide.
     */
    public function testANonAuthorizedUserCannotDeleteAGuide()
    {
        $user = User::factory()->create();

        $guide = Guide::factory()->create();

        $response = $this->actingAs($user)->delete(
            route('staff.guides.destroy', $guide)
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
                        'name' => 'Manage guides',
                        'slug' => 'manage-guides',
                    ]))
            )
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.guides.create')
        );

        $response->assertStatus(200);
    }

    /**
     * Test that an authorized user can store a guide.
     */
    public function testAnAuthorizedUserCanStoreAGuide()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Manage guides',
                        'slug' => 'manage-guides',
                    ]))
            )
            ->create();

        $numberOfActivities = Guide::count();

        $guideData = Guide::factory()->make();

        $response = $this->actingAs($user)->post(
            route('staff.guides.store'),
            $guideData->toArray()
        );

        $this->assertDatabaseHas('guides', [
            'title' => $guideData['title'],
        ]);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('staff.guides.show', Guide::latest()->first()));
    }

    /**
     * Test that an authorized user can see the edition page.
     */
    public function testAnAuthorizedUserCanSeeTheEditionPage()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Manage guides',
                        'slug' => 'manage-guides',
                    ]))
            )
            ->create();

        $guide = Guide::factory()->create();

        $response = $this->actingAs($user)->get(
            route('staff.guides.edit', $guide)
        );

        $response->assertStatus(200);
    }

    /**
     * Test that an authorized user can update a guide.
     */
    public function testAnAuthorizedUserCanUpdateAGuide()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Manage guides',
                        'slug' => 'manage-guides',
                    ]))
            )
            ->create();

        $numberOfActivities = Guide::count();

        $guide = Guide::factory()->create();
        $editedGuideData = Guide::factory()->make();

        $response = $this->actingAs($user)->patch(
            route('staff.guides.update', $guide),
            $editedGuideData->toArray()
        );

        $this->assertDatabaseHas('guides', [
            'title' => $editedGuideData['title'],
        ]);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('staff.guides.show', $guide));
    }

    /**
     * Test that an authorized user can delete a guide.
     */
    public function testAnAuthorizedUserCanDeleteAGuide()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Manage guides',
                        'slug' => 'manage-guides',
                    ]))
            )
            ->create();

        $numberOfActivities = Guide::count();

        $guide = Guide::factory()->create();

        $response = $this->actingAs($user)->delete(
            route('staff.guides.destroy', $guide)
        );

        $this->assertDeleted($guide);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('staff.guides.index'));
    }
}
