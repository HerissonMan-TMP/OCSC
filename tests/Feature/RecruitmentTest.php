<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Group;
use App\Models\Permission;
use App\Models\Recruitment;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecruitmentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that an open recruitment page is accessible by everyone.
     */
    public function testOpenRecruitmentPageIsAccessible()
    {
        $recruitment = Recruitment::factory()
            ->open()
            ->for(Role::factory()->for(Group::factory()))
            ->for(User::factory())
            ->create();

        $response = $this->get(
            route('recruitments.show', $recruitment)
        );

        $response->assertStatus(200);
    }

    /**
     * Test that a closed recruitment page is not accessible.
     */
    public function testClosedRecruitmentPageIsNotAccessible()
    {
        $recruitment = Recruitment::factory()
            ->for(Role::factory()->for(Group::factory()))
            ->for(User::factory())
            ->create();

        $response = $this->get(
            route('recruitments.show', $recruitment)
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot see the recruitments index.
     */
    public function testANonAuthorizedUserCannotSeeTheRecruitmentsIndex()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(
            route('staff.recruitments.index')
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot see the creation page.
     */
    public function testANonAuthorizedUserCannotSeeTheCreationPage()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(
            route('staff.recruitments.create')
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot store a recruitment.
     */
    public function testANonAuthorizedUserCannotStoreARecruitment()
    {
        $user = User::factory()->create();

        $recruitmentData = Recruitment::factory()
            ->inTheFuture()
            ->for(Role::factory()->recruitable()->for(Group::factory()))
            ->for(User::factory())
            ->make();

        $response = $this->actingAs($user)->post(
            route('staff.recruitments.store'),
            $recruitmentData->toArray()
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot see the edition page.
     */
    public function testANonAuthorizedUserCannotSeeTheEditionPage()
    {
        $user = User::factory()->create();

        $recruitment = Recruitment::factory()
            ->open()
            ->for(Role::factory()->recruitable()->for(Group::factory()))
            ->for(User::factory())
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.recruitments.edit', $recruitment)
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot update a recruitment.
     */
    public function testANonAuthorizedUserCannotUpdateARecruitment()
    {
        $user = User::factory()->create();

        $recruitment = Recruitment::factory()
            ->open()
            ->for(Role::factory()->recruitable()->for(Group::factory()))
            ->for(User::factory())
            ->create();

        $editedRecruitmentData = Recruitment::factory()
            ->open()
            ->for(Role::factory()->recruitable()->for(Group::factory()))
            ->for(User::factory())
            ->make();

        $response = $this->actingAs($user)->patch(
            route('staff.recruitments.update', $recruitment),
            $editedRecruitmentData->toArray()
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot delete a recruitment.
     */
    public function testANonAuthorizedUserCannotDeleteARecruitment()
    {
        $user = User::factory()->create();

        $recruitment = Recruitment::factory()
            ->for(Role::factory()->recruitable()->for(Group::factory()))
            ->for(User::factory())
            ->create();

        $response = $this->actingAs($user)->delete(
            route('staff.recruitments.destroy', $recruitment)
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
                        'name' => 'Manage recruitments',
                        'slug' => 'manage-recruitments',
                    ]))
            )
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.recruitments.create')
        );

        $response->assertStatus(200);
    }

    /**
     * Test that an authorized user can store a recruitment.
     */
    public function testAnAuthorizedUserCanStoreARecruitment()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Manage recruitments',
                        'slug' => 'manage-recruitments',
                    ]))
            )
            ->create();

        $numberOfActivities = Activity::count();

        $recruitmentData = Recruitment::factory()
            ->inTheFuture()
            ->for(Role::factory()->recruitable()->for(Group::factory()))
            ->for(User::factory())
            ->make();

        $response = $this->actingAs($user)->post(
            route('staff.recruitments.store'),
            $recruitmentData->toArray()
        );

        $this->assertDatabaseHas('recruitments', [
            'start_at' => $recruitmentData['start_at'],
        ]);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('staff.recruitments.index'));
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
                        'name' => 'Manage recruitments',
                        'slug' => 'manage-recruitments',
                    ]))
            )
            ->create();

        $recruitment = Recruitment::factory()
            ->open()
            ->for(Role::factory()->recruitable()->for(Group::factory()))
            ->for(
                User::factory()->hasAttached(
                    Role::factory()->for(Group::factory())
                )
            )
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.recruitments.edit', $recruitment)
        );

        $response->assertStatus(200);
    }

    /**
     * Test that an authorized user can update a recruitment.
     */
    public function testAnAuthorizedUserCanUpdateARecruitment()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Manage recruitments',
                        'slug' => 'manage-recruitments',
                    ]))
            )
            ->create();

        $numberOfActivities = Activity::count();

        $recruitment = Recruitment::factory()
            ->open()
            ->for(Role::factory()->recruitable()->for(Group::factory()))
            ->for(User::factory())
            ->create();

        $editedRecruitmentData = Recruitment::factory()
            ->open()
            ->for(Role::factory()->recruitable()->for(Group::factory()))
            ->for(User::factory())
            ->make();

        $response = $this->actingAs($user)->patch(
            route('staff.recruitments.update', $recruitment),
            $editedRecruitmentData->toArray()
        );

        $this->assertDatabaseHas('recruitments', [
            'start_at' => $editedRecruitmentData['start_at'],
        ]);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('staff.recruitments.index'));
    }

    /**
     * Test that an authorized user can delete a recruitment.
     */
    public function testAnAuthorizedUserCanDeleteARecruitment()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Manage recruitments',
                        'slug' => 'manage-recruitments',
                    ]))
            )
            ->create();

        $numberOfActivities = Activity::count();

        $recruitment = Recruitment::factory()
            ->for(Role::factory()->recruitable()->for(Group::factory()))
            ->for(User::factory())
            ->create();

        $response = $this->actingAs($user)->delete(
            route('staff.recruitments.destroy', $recruitment)
        );

        $this->assertDeleted($recruitment);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('staff.recruitments.index'));
    }
}
