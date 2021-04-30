<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\ContactCategory;
use App\Models\ContactMessage;
use App\Models\Group;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactMessageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the contact page is accessible by everyone.
     */
    public function testContactPageIsAccessible()
    {
        $response = $this->get(
            route('contact-messages.create')
        );

        $response->assertStatus(200);
    }

    /**
     * Test that a visitor can send a contact message.
     */
    public function testAVisitorCanSendAContactMessage()
    {
        $numberOfActivities = Activity::count();

        $contactCategory = ContactCategory::factory()->create();
        $contactMessageData = ContactMessage::factory()->make();

        $response = $this->post(
            route('contact-messages.store'),
            array_merge(
                $contactMessageData->toArray(),
                [
                    'category_id' => $contactCategory->id,
                    'consent' => true,
                ]
            )
        );

        $this->assertDatabaseHas('contact_messages', [
            'message' => $contactMessageData['message'],
        ]);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('contact-messages.success-page'));
    }

    /**
     * Test that a non-authorized user cannot see the contact messages index.
     */
    public function testANonAuthorizedUserCannotSeeTheContactMessagesIndex()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(
            route('staff.contact-messages.index')
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot see a contact message.
     */
    public function testANonAuthorizedUserCannotSeeAContactMessage()
    {
        $user = User::factory()
            ->create();

        $contactMessage = ContactMessage::factory()
            ->for(ContactCategory::factory(), 'category')
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.contact-messages.show', $contactMessage)
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot mark a contact message as read.
     */
    public function testANonAuthorizedUserCannotMarkAContactMessageAsRead()
    {
        $user = User::factory()
            ->create();

        $contactMessage = ContactMessage::factory()
            ->for(ContactCategory::factory(), 'category')
            ->create();

        $response = $this->actingAs($user)->post(
            route('staff.contact-messages.mark-as-read', $contactMessage)
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot mark a contact message as unread.
     */
    public function testANonAuthorizedUserCannotMarkAContactMessageAsUnread()
    {
        $user = User::factory()
            ->create();

        $contactMessage = ContactMessage::factory()
            ->for(ContactCategory::factory(), 'category')
            ->create();

        $response = $this->actingAs($user)->post(
            route('staff.contact-messages.mark-as-unread', $contactMessage)
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot delete an contact message.
     */
    public function testANonAuthorizedUserCannotDeleteAContactMessage()
    {
        $user = User::factory()->create();

        $contactMessage = ContactMessage::factory()
            ->for(ContactCategory::factory(), 'category')
            ->create();

        $response = $this->actingAs($user)->delete(
            route('staff.contact-messages.destroy', $contactMessage)
        );

        $response->assertStatus(403);
    }

    /**
     * Test that an authorized user can see a contact message.
     */
    public function testAnAuthorizedUserCanSeeAContactMessage()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Manage contact messages',
                        'slug' => 'manage-contact-messages',
                    ]))
            )
            ->create();

        $contactMessage = ContactMessage::factory()
            ->for(ContactCategory::factory(), 'category')
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.contact-messages.show', $contactMessage)
        );

        $response->assertStatus(200);
    }

    /**
     * Test that an authorized user can mark a contact message as read.
     */
    public function testAnAuthorizedUserCanMarkAContactMessageAsRead()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Manage contact messages',
                        'slug' => 'manage-contact-messages',
                    ]))
            )
            ->create();

        $numberOfActivities = Activity::count();

        $contactMessage = ContactMessage::factory()
            ->for(ContactCategory::factory(), 'category')
            ->create();

        $response = $this->actingAs($user)->post(
            route('staff.contact-messages.mark-as-read', $contactMessage)
        );

        $this->assertDatabaseHas('contact_messages', [
            'message' => $contactMessage['message'],
            'status' => 'read',
        ]);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('staff.contact-messages.index'));
    }

    /**
     * Test that an authorized user can mark a contact message as unread.
     */
    public function testAnAuthorizedUserCanMarkAContactMessageAsUnread()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Manage contact messages',
                        'slug' => 'manage-contact-messages',
                    ]))
            )
            ->create();

        $numberOfActivities = Activity::count();

        $contactMessage = ContactMessage::factory()
            ->for(ContactCategory::factory(), 'category')
            ->create();

        $response = $this->actingAs($user)->post(
            route('staff.contact-messages.mark-as-unread', $contactMessage)
        );

        $this->assertDatabaseHas('contact_messages', [
            'message' => $contactMessage['message'],
            'status' => 'unread',
        ]);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('staff.contact-messages.index'));
    }

    /**
     * Test that an authorized user can delete an contact message.
     */
    public function testAnAuthorizedUserCanDeleteAContactMessage()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Manage contact messages',
                        'slug' => 'manage-contact-messages',
                    ]))
            )
            ->create();

        $numberOfActivities = Activity::count();

        $contactMessage = ContactMessage::factory()
            ->for(ContactCategory::factory(), 'category')
            ->create();

        $response = $this->actingAs($user)->delete(
            route('staff.contact-messages.destroy', $contactMessage)
        );

        $this->assertDeleted($contactMessage);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('staff.contact-messages.index'));
    }
}
