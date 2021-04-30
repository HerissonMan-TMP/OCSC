<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Group;
use App\Models\Download;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DownloadTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a non-authorized user cannot download a specific download.
     */
    public function testANonAuthorizedUserCannotDownloadASpecificDownload()
    {
        $download = Download::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(
            route('staff.downloads.download', $download)
        );

        $response->assertStatus(403);
    }

    /**
     * Test that an authorized user can download a specific download.
     */
    public function testAnAuthorizedUserCanDownloadASpecificDownload()
    {
        Storage::fake();

        $file = UploadedFile::fake()->create('test.pdf', 5000);

        $file->store('downloads');

        $download = Download::factory()->create([
            'path' => $file->hashName(),
        ]);

        $role = Role::factory()
            ->for(Group::factory())
            ->create();

        $download->roles()->attach($role);

        $user = User::factory()
            ->hasAttached($role)
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.downloads.download', $download)
        );

        $response->assertStatus(200);
    }

    /**
     * Test that the downloads index is not accessible by visitors.
     */
    public function testDownloadsIndexIsNotAccessibleByVisitors()
    {
        $response = $this->get(
            route('staff.downloads.index')
        );

        $response->assertRedirect(route('login.show-form'));
    }

    /**
     * Test that the downloads index is accessible by staff members.
     */
    public function testDownloadsIndexIsAccessibleByStaffMembers()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(
            route('staff.downloads.index')
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
            route('staff.downloads.create')
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot store a download.
     */
    public function testANonAuthorizedUserCannotStoreADownload()
    {
        Storage::fake();

        $user = User::factory()->create();

        $downloadData = [
            'name' => str_shuffle('abcdefg'),
            'file' => UploadedFile::fake()->create('test.pdf', 5000),
        ];

        $response = $this->actingAs($user)->post(
            route('staff.downloads.store'),
            $downloadData
        );

        Storage::disk()->assertMissing($downloadData['file']->hashName());
        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot see the edition page.
     */
    public function testANonAuthorizedUserCannotSeeTheEditionPage()
    {
        $user = User::factory()->create();

        $download = Download::factory()->create();

        $response = $this->actingAs($user)->get(
            route('staff.downloads.edit', $download)
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot update a download.
     */
    public function testANonAuthorizedUserCannotUpdateADownload()
    {
        $user = User::factory()->create();

        $download = Download::factory()->create();
        $editedDownloadData = Download::factory()->make()->toArray();

        $response = $this->actingAs($user)->patch(
            route('staff.downloads.update', $download),
            $editedDownloadData
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot delete a download.
     */
    public function testANonAuthorizedUserCannotDeleteADownload()
    {
        $user = User::factory()->create();

        $download = Download::factory()->create();

        $response = $this->actingAs($user)->delete(
            route('staff.downloads.destroy', $download)
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
                        'name' => 'Manage downloads',
                        'slug' => 'manage-downloads',
                    ]))
            )
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.downloads.create')
        );

        $response->assertStatus(200);
    }

    /**
     * Test that an authorized user can store a download.
     */
    public function testAnAuthorizedUserCanStoreADownload()
    {
        Storage::fake();

        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Manage downloads',
                        'slug' => 'manage-downloads',
                    ]))
            )
            ->create();

        $numberOfActivities = Activity::count();

        $downloadData = [
            'name' => str_shuffle('abcdefg'),
            'file' => UploadedFile::fake()->create('test.pdf', 5000),
        ];

        $response = $this->actingAs($user)->post(
            route('staff.downloads.store'),
            $downloadData
        );

        $this->assertDatabaseHas('downloads', [
            'name' => $downloadData['name'],
        ]);
        Storage::disk()->assertExists('downloads/' . $downloadData['file']->hashName());
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('staff.downloads.index'));
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
                        'name' => 'Manage downloads',
                        'slug' => 'manage-downloads',
                    ]))
            )
            ->create();

        $download = Download::factory()->create();

        $response = $this->actingAs($user)->get(
            route('staff.downloads.edit', $download)
        );

        $response->assertStatus(200);
    }

    /**
     * Test that an authorized user can update a download.
     */
    public function testAnAuthorizedUserCanUpdateADownload()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Manage downloads',
                        'slug' => 'manage-downloads',
                    ]))
            )
            ->create();

        $numberOfActivities = Activity::count();

        $download = Download::factory()->create();
        $editedDownloadData = [
            'name' => str_shuffle('abcdefg'),
        ];

        $response = $this->actingAs($user)->patch(
            route('staff.downloads.update', $download),
            $editedDownloadData
        );

        $this->assertDatabaseHas('downloads', [
            'name' => $editedDownloadData['name'],
        ]);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('staff.downloads.index'));
    }

    /**
     * Test that an authorized user can delete a download.
     */
    public function testAnAuthorizedUserCanDeleteADownload()
    {
        Storage::fake();

        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Manage downloads',
                        'slug' => 'manage-downloads',
                    ]))
            )
            ->create();

        $downloadData = [
            'name' => str_shuffle('abcdefg'),
            'file' => UploadedFile::fake()->create('test.pdf', 5000),
        ];

        $this->actingAs($user)->post(
            route('staff.downloads.store'),
            $downloadData
        );

        $download = Download::latest()->first();

        $numberOfActivities = Activity::count();

        $response = $this->actingAs($user)->delete(
            route('staff.downloads.destroy', $download)
        );

        Storage::disk()->assertMissing('downloads/' . $download->path);
        $this->assertDeleted($download);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('staff.downloads.index'));
    }
}
