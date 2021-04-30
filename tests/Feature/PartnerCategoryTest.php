<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Group;
use App\Models\PartnerCategory;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PartnerCategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the partner categories index is not accessible by visitors.
     */
    public function testPartnerCategoriesIndexIsNotAccessibleByVisitors()
    {
        $response = $this->get(
            route('staff.partner-categories.index')
        );

        $response->assertRedirect(route('login.show-form'));
    }

    /**
     * Test that the partner categories index is accessible by staff members.
     */
    public function testPartnerCategoriesIndexIsAccessibleByStaffMembers()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(
            route('staff.partner-categories.index')
        );

        $response->assertStatus(200);
    }

    /**
     * Test that a non-authorized user cannot store an partner category.
     */
    public function testANonAuthorizedUserCannotStoreAPartnerCategory()
    {
        $user = User::factory()->create();
        $partnerCategoryData = PartnerCategory::factory()->make()->toArray();

        $response = $this->actingAs($user)->post(
            route('staff.partner-categories.store'),
            $partnerCategoryData
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot see the edition page.
     */
    public function testANonAuthorizedUserCannotSeeTheEditionPage()
    {
        $user = User::factory()->create();
        $partnerCategory = PartnerCategory::factory()->create();

        $response = $this->actingAs($user)->get(
            route('staff.partner-categories.edit', $partnerCategory)
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot update a partner category.
     */
    public function testANonAuthorizedUserCannotUpdateAPartnerCategory()
    {
        $user = User::factory()->create();
        $partnerCategory = PartnerCategory::factory()->create();
        $editedPartnerCategoryData = PartnerCategory::factory()->make()->toArray();

        $response = $this->actingAs($user)->patch(
            route('staff.partner-categories.update', $partnerCategory),
            $editedPartnerCategoryData
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot delete a partner category.
     */
    public function testANonAuthorizedUserCannotDeleteAPartnerCategory()
    {
        $user = User::factory()->create();
        $partnerCategory = PartnerCategory::factory()->create();

        $response = $this->actingAs($user)->delete(
            route('staff.partner-categories.destroy', $partnerCategory)
        );

        $response->assertStatus(403);
    }

    /**
     * Test that an authorized user can store an partner category.
     */
    public function testAnAuthorizedUserCanStoreAnArticle()
    {
        $group = Group::factory()->create();

        $role = Role::factory()
            ->for($group)
            ->hasAttached(Permission::create([
                'name' => 'Manage partner categories',
                'slug' => 'manage-partner-categories',
            ]))
            ->create();

        $user = User::factory()
            ->hasAttached($role)
            ->create();

        $numberOfActivities = Activity::count();

        $partnerCategoryData = PartnerCategory::factory()->make();

        $response = $this->actingAs($user)->post(
            route('staff.partner-categories.store'),
            $partnerCategoryData->toArray()
        );

        $this->assertDatabaseHas('partner_categories', [
            'name' => $partnerCategoryData['name'],
        ]);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('staff.partner-categories.index'));
    }

    /**
     * Test that an authorized user can see the edition page.
     */
    public function testAnAuthorizedUserCanSeeTheEditionPage()
    {
        $group = Group::factory()->create();

        $role = Role::factory()
            ->for($group)
            ->hasAttached(Permission::create([
                'name' => 'Manage partner categories',
                'slug' => 'manage-partner-categories',
            ]))
            ->create();

        $user = User::factory()
            ->hasAttached($role)
            ->create();

        $partnerCategory = PartnerCategory::factory()->create();

        $response = $this->actingAs($user)->get(
            route('staff.partner-categories.edit', $partnerCategory)
        );

        $response->assertStatus(200);
    }

    /**
     * Test that an authorized user can update an partner category.
     */
    public function testAnAuthorizedUserCanUpdateAnArticle()
    {
        $group = Group::factory()->create();

        $role = Role::factory()
            ->for($group)
            ->hasAttached(Permission::create([
                'name' => 'Manage partner categories',
                'slug' => 'manage-partner-categories',
            ]))
            ->create();

        $user = User::factory()
            ->hasAttached($role)
            ->create();

        $numberOfActivities = Activity::count();

        $partnerCategory = PartnerCategory::factory()->create();
        $editedPartnerCategoryData = PartnerCategory::factory()->make();

        $response = $this->actingAs($user)->patch(
            route('staff.partner-categories.update', $partnerCategory),
            $editedPartnerCategoryData->toArray()
        );

        $this->assertDatabaseHas('partner_categories', [
            'name' => $editedPartnerCategoryData['name'],
        ]);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('staff.partner-categories.index'));
    }

    /**
     * Test that an authorized user can delete an partner category.
     */
    public function testAnAuthorizedUserCanDeleteAnArticle()
    {
        $group = Group::factory()->create();

        $role = Role::factory()
            ->for($group)
            ->hasAttached(Permission::create([
                'name' => 'Manage partner categories',
                'slug' => 'manage-partner-categories',
            ]))
            ->create();

        $user = User::factory()
            ->hasAttached($role)
            ->create();

        $numberOfActivities = Activity::count();

        $partnerCategory = PartnerCategory::factory()->create();

        $response = $this->actingAs($user)->delete(
            route('staff.partner-categories.destroy', $partnerCategory)
        );

        $this->assertDeleted($partnerCategory);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('staff.partner-categories.index'));
    }
}
