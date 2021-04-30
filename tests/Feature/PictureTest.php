<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Picture;
use App\Models\Group;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PictureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the gallery (pictures index for public) is accessible by everyone.
     */
    public function testGalleryIsAccessibleByEveryone()
    {
        $response = $this->get(
            route('gallery')
        );

        $response->assertStatus(200);
    }

    /**
     * Test that the pictures index is not accessible by visitors.
     */
    public function testPicturesIndexIsNotAccessibleByVisitors()
    {
        $response = $this->get(
            route('staff.pictures.index')
        );

        $response->assertRedirect(route('login.show-form'));
    }

    /**
     * Test that the pictures index is accessible by staff members.
     */
    public function testPicturesIndexIsAccessibleByStaffMembers()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(
            route('staff.pictures.index')
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
            route('staff.pictures.create')
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot store a picture.
     */
    public function testANonAuthorizedUserCannotStoreAPicture()
    {
        Storage::fake();

        $user = User::factory()->create();
        $pictureData = [
            'name' => str_shuffle('abcdefg'),
            'description' => str_shuffle('hijklm'),
            'picture_file' => UploadedFile::fake()->image('test.png', 1920, 1080)->size(3000),
        ];

        $response = $this->actingAs($user)->post(
            route('staff.pictures.store'),
            $pictureData
        );

        Storage::disk()->assertMissing('gallery/' . $pictureData['picture_file']->hashName());
        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot see the edition page.
     */
    public function testANonAuthorizedUserCannotSeeTheEditionPage()
    {
        $user = User::factory()->create();

        $picture = Picture::factory()
            ->for(User::factory())
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.pictures.edit', $picture)
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot update a picture.
     */
    public function testANonAuthorizedUserCannotUpdateAPicture()
    {
        $user = User::factory()->create();

        $picture = Picture::factory()
            ->for(User::factory())
            ->create();
        $editedPictureData = Picture::factory()->make()->toArray();

        $response = $this->actingAs($user)->patch(
            route('staff.pictures.update', $picture),
            $editedPictureData
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot delete many pictures.
     */
    public function testANonAuthorizedUserCannotDeleteManyPictures()
    {
        $user = User::factory()->create();

        $pictures = Picture::factory()
            ->count(2)
            ->for(User::factory())
            ->create();

        $picturesData = [
            'pictures' => $pictures->pluck('id')->toArray(),
        ];

        $response = $this->actingAs($user)->delete(
            route('staff.pictures.destroy-many'),
            $picturesData
        );

        $this->assertDatabaseHas('pictures', [
            'name' => $pictures[0]['name'],
        ]);
        $this->assertDatabaseHas('pictures', [
            'name' => $pictures[1]['name'],
        ]);
        $response->assertRedirect(route('staff.pictures.index'));
        $response->assertSessionHasErrors('select_mode');
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
                        'name' => 'Add pictures to the gallery (with the ability to manage them)',
                        'slug' => 'add-pictures-to-gallery',
                    ]))
            )
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.pictures.create')
        );

        $response->assertStatus(200);
    }

    /**
     * Test that an authorized user can store a picture.
     */
    public function testAnAuthorizedUserCanStoreAPicture()
    {
        Storage::fake();

        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Add pictures to the gallery (with the ability to manage them)',
                        'slug' => 'add-pictures-to-gallery',
                    ]))
            )
            ->create();

        $numberOfActivities = Activity::count();

        $pictureData = [
            'name' => str_shuffle('abcdefg'),
            'description' => str_shuffle('hijklm'),
            'picture_file' => UploadedFile::fake()->image('test.png', 1920, 1080)->size(3000),
        ];

        $response = $this->actingAs($user)->post(
            route('staff.pictures.store'),
            $pictureData
        );

        $this->assertDatabaseHas('pictures', [
            'name' => $pictureData['name'],
        ]);
        Storage::disk()->assertExists('gallery/' . $pictureData['picture_file']->hashName());
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('staff.pictures.index'));
    }

    /**
     * Test that an authorized user can see the edition page.
     */
    public function testAnAuthorizedUserCanSeeTheEditionPage()
    {
        $user = User::factory()->create();

        $picture = Picture::factory()
            ->for($user)
            ->create();

        dump($picture);

        $response = $this->actingAs($user)->get(
            route('staff.pictures.edit', $picture)
        );

        $response->assertStatus(200);
    }

    /**
     * Test that an authorized user can update a picture.
     */
    public function testAnAuthorizedUserCanUpdateAPicture()
    {
        $user = User::factory()->create();

        $numberOfActivities = Activity::count();

        $picture = Picture::factory()
            ->for($user)
            ->create();
        $editedPictureData = [
            'name' => str_shuffle('abcdefg'),
            'description' => str_shuffle('hijklm'),
        ];

        $response = $this->actingAs($user)->patch(
            route('staff.pictures.update', $picture),
            $editedPictureData
        );

        $this->assertDatabaseHas('pictures', [
            'name' => $editedPictureData['name'],
        ]);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('staff.pictures.index'));
    }

    /**
     * Test that an authorized user can delete many pictures.
     */
    public function testAnAuthorizedUserCanDeleteManyPictures()
    {
        $user = User::factory()->create();

        $numberOfActivities = Activity::count();

        $pictures = Picture::factory()
            ->count(2)
            ->for($user)
            ->create();

        $picturesData = [
            'pictures' => $pictures->pluck('id')->toArray(),
        ];

        $response = $this->actingAs($user)->delete(
            route('staff.pictures.destroy-many'),
            $picturesData
        );

        $this->assertDeleted($pictures[0]);
        $this->assertDeleted($pictures[1]);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('staff.pictures.index'));
    }
}
