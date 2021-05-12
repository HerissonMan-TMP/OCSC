<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Application;
use App\Models\Group;
use App\Models\Permission;
use App\Models\Recruitment;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApplicationTest extends TestCase
{
    //use RefreshDatabase;

    /**
     * Test that a visitor can send an application.
     */
    public function testAVisitorCanSendAnApplication()
    {
        $numberOfActivities = Activity::count();

        $recruitment = Recruitment::factory()
            ->for(Role::factory()->for(Group::factory()))
            ->for(User::factory())
            ->open()
            ->create();

        $applicationData = Application::factory()
            ->for($recruitment)
            ->make();

        $response = $this->post(
            route('recruitments.applications.store', $recruitment),
            array_merge(
                $applicationData->toArray(),
                [
                    'consent' => true,
                ]
            )
        );

        $this->assertDatabaseHas('applications', [
            'discord' => $applicationData['discord'],
        ]);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('applications.success-page'));
    }

    /**
     * Test that a non-authorized user cannot see the applications index of a recruitment.
     */
    public function testANonAuthorizedUserCannotSeeTheApplicationsIndexOfARecruitment()
    {
        $user = User::factory()->create();

        $recruitment = Recruitment::factory()
            ->for(Role::factory()->for(Group::factory()))
            ->for(User::factory())
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.recruitments.applications.index', $recruitment)
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot see an application.
     */
    public function testANonAuthorizedUserCannotSeeAnApplication()
    {
        $user = User::factory()->create();

        $application = Application::factory()
            ->for(
                Recruitment::factory()
                    ->for(Role::factory()->for(Group::factory()))
                    ->for(User::factory())
            )
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.applications.show', $application)
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot accept an application.
     */
    public function testANonAuthorizedUserCannotAcceptAnApplication()
    {
        $user = User::factory()
            ->create();

        $application = Application::factory()
            ->for(
                Recruitment::factory()
                    ->for(Role::factory()->for(Group::factory()))
                    ->for(User::factory())
            )
            ->create();

        $response = $this->actingAs($user)->post(
            route('staff.applications.accept', $application)
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot decline an application.
     */
    public function testANonAuthorizedUserCannotDeclineAnApplication()
    {
        $user = User::factory()
            ->create();

        $application = Application::factory()
            ->for(
                Recruitment::factory()
                    ->for(Role::factory()->for(Group::factory()))
                    ->for(User::factory())
            )
            ->create();

        $response = $this->actingAs($user)->post(
            route('staff.applications.decline', $application)
        );

        $response->assertStatus(403);
    }

    /**
     * Test that an authorized user can see an application.
     */
    public function testAnAuthorizedUserCanSeeAnApplication()
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

        $application = Application::factory()
            ->for(
                Recruitment::factory()
                    ->for(Role::factory()->for(Group::factory()))
                    ->for(User::factory())
            )
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.applications.show', $application)
        );

        $response->assertStatus(200);
    }

    /**
     * Test that an authorized user can accept an application.
     */
    public function testAnAuthorizedUserCanAcceptAnApplication()
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

        $application = Application::factory()
            ->for(
                Recruitment::factory()
                    ->for(Role::factory()->for(Group::factory()))
                    ->for(User::factory())
            )
            ->create();

        $response = $this->actingAs($user)->post(
            route('staff.applications.accept', $application)
        );

        $this->assertDatabaseHas('applications', [
            'discord' => $application['discord'],
            'status' => Application::ACCEPTED,
        ]);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('staff.users.create', [
            'email' => $application['email'],
            'role_id' => $application->recruitment->role->id,
        ]));
    }

    /**
     * Test that an authorized user can decline an application.
     */
    public function testAnAuthorizedUserCanDeclineAnApplication()
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

        $application = Application::factory()
            ->for(
                Recruitment::factory()
                    ->for(Role::factory()->for(Group::factory()))
                    ->for(User::factory())
            )
            ->create();

        $response = $this->actingAs($user)->post(
            route('staff.applications.decline', $application)
        );

        $this->assertDatabaseHas('applications', [
            'discord' => $application['discord'],
            'status' => Application::DECLINED,
        ]);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('staff.recruitments.applications.index', $application->recruitment));
    }
}
