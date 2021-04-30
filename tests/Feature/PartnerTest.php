<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Group;
use App\Models\Partner;
use App\Models\PartnerCategory;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PartnerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the partners (partners index for public) are accessible by everyone.
     */
    public function testPartnersAreAccessible()
    {
        $response = $this->get(
            route('partners')
        );

        $response->assertStatus(200);
    }

    /**
     * Test that the partners index is not accessible by visitors.
     */
    public function testPartnersIndexIsNotAccessibleByVisitors()
    {
        $response = $this->get(
            route('staff.partners.index')
        );

        $response->assertRedirect(route('login.show-form'));
    }

    /**
     * Test that the partners index is accessible by staff members.
     */
    public function testPartnersIndexIsAccessibleByStaffMembers()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(
            route('staff.partners.index')
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
            route('staff.partners.create')
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot store a partner.
     */
    public function testANonAuthorizedUserCannotStoreAPartner()
    {
        $user = User::factory()->create();

        $partnerCategory = PartnerCategory::factory()->create();
        $partnerData = Partner::factory()->make()->toArray();

        $response = $this->actingAs($user)->post(
            route('staff.partners.store'),
            array_merge(
                $partnerData,
                [
                    'category_id' => $partnerCategory->id,
                ]
            )
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot see the edition page.
     */
    public function testANonAuthorizedUserCannotSeeTheEditionPage()
    {
        $user = User::factory()->create();

        $partner = Partner::factory()
            ->for(PartnerCategory::factory(), 'category')
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.partners.edit', $partner)
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot update a partner.
     */
    public function testANonAuthorizedUserCannotUpdateAPartner()
    {
        $user = User::factory()->create();

        $partner = Partner::factory()
            ->for(PartnerCategory::factory(), 'category')
            ->create();

        $otherPartnerCategory = PartnerCategory::factory()->create();
        $editedPartnerData = Partner::factory()->make()->toArray();

        $response = $this->actingAs($user)->patch(
            route('staff.partners.update', $partner),
            array_merge(
                $editedPartnerData,
                [
                    'category_id' => $otherPartnerCategory->id,
                ]
            )
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot delete a partner.
     */
    public function testANonAuthorizedUserCannotDeleteAPartner()
    {
        $user = User::factory()->create();

        $partner = Partner::factory()
            ->for(PartnerCategory::factory(), 'category')
            ->create();

        $response = $this->actingAs($user)->delete(
            route('staff.partners.destroy', $partner)
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
                        'name' => 'Manage partners',
                        'slug' => 'manage-partners',
                    ]))
            )
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.partners.create')
        );

        $response->assertStatus(200);
    }

    /**
     * Test that an authorized user can store a partner.
     */
    public function testAnAuthorizedUserCanStoreAPartner()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Manage partners',
                        'slug' => 'manage-partners',
                    ]))
            )
            ->create();

        $numberOfActivities = Activity::count();

        $partnerCategory = PartnerCategory::factory()->create();
        $partnerData = Partner::factory()->make();

        $response = $this->actingAs($user)->post(
            route('staff.partners.store'),
            array_merge(
                $partnerData->toArray(),
                [
                    'category_id' => $partnerCategory->id,
                ]
            )
        );

        $this->assertDatabaseHas('partners', [
            'name' => $partnerData['name'],
        ]);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('staff.partners.index'));
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
                        'name' => 'Manage partners',
                        'slug' => 'manage-partners',
                    ]))
            )
            ->create();

        $partner = Partner::factory()
            ->for(PartnerCategory::factory(), 'category')
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.partners.edit', $partner)
        );

        $response->assertStatus(200);
    }

    /**
     * Test that an authorized user can update a partner.
     */
    public function testAnAuthorizedUserCanUpdateAPartner()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Manage partners',
                        'slug' => 'manage-partners',
                    ]))
            )
            ->create();

        $numberOfActivities = Activity::count();

        $partner = Partner::factory()
            ->for(PartnerCategory::factory(), 'category')
            ->create();

        $otherPartnerCategory = PartnerCategory::factory()->create();
        $editedPartnerData = Partner::factory()->make();

        $response = $this->actingAs($user)->patch(
            route('staff.partners.update', $partner),
            array_merge(
                $editedPartnerData->toArray(),
                [
                    'category_id' => $otherPartnerCategory->id,
                ]
            )
        );

        $this->assertDatabaseHas('partners', [
            'name' => $editedPartnerData['name'],
        ]);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('staff.partners.index'));
    }

    /**
     * Test that an authorized user can delete a partner.
     */
    public function testAnAuthorizedUserCanDeleteAPartner()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Manage partners',
                        'slug' => 'manage-partners',
                    ]))
            )
            ->create();

        $numberOfActivities = Activity::count();

        $partner = Partner::factory()
            ->for(PartnerCategory::factory(), 'category')
            ->create();

        $response = $this->actingAs($user)->delete(
            route('staff.partners.destroy', $partner)
        );

        $this->assertDeleted($partner);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('staff.partners.index'));
    }
}
