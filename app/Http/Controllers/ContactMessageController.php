<?php

namespace App\Http\Controllers;

use App\Filters\ContactMessageFilters;
use App\Http\Requests\Contact\StoreContactMessageRequest;
use App\Models\ActivityType;
use App\Models\ContactCategory;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Gate;

/**
 * Class ContactMessageController
 * @package App\Http\Controllers
 */
class ContactMessageController extends Controller
{
    /**
     * Display the list of the received contact messages.
     *
     * @param ContactMessageFilters $filters
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(ContactMessageFilters $filters)
    {
        Gate::authorize('manage-contact-messages');

        $contactMessages = ContactMessage::filter($filters)->with('category')->paginate(20);

        return view('contact-messages.index')
                ->with(compact('contactMessages'));
    }

    /**
     * Display the given contact message.
     *
     * @param ContactMessage $contactMessage
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(ContactMessage $contactMessage)
    {
        Gate::authorize('manage-contact-messages');

        $contactMessage = $contactMessage->load('category');

        return view('contact-messages.show')
                ->with(compact('contactMessage'));
    }

    /**
     * Display the form to send a contact message.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = ContactCategory::all();

        return view('contact-messages.create')
                ->with(compact('categories'));
    }

    /**
     * Store a contact message.
     *
     * @param StoreContactMessageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreContactMessageRequest $request)
    {
        $contactMessage = ContactCategory::find($request->category_id)->messages()->create($request->validated());

        activity(ActivityType::CREATED)
            ->subject("fas fa-envelope", "Contact Message #{$contactMessage->id}")
            ->description($contactMessage->discord ? "Discord: {$contactMessage->discord}" : "Email: {$contactMessage->email}")
            ->log();

        flash('You have successfully sent the message!')->success();

        return redirect()->route('contact-messages.success-page');
    }

    /**
     * Mark the given contact message as read.
     *
     * @param ContactMessage $contactMessage
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function markAsRead(ContactMessage $contactMessage)
    {
        Gate::authorize('manage-contact-messages');

        $contactMessage->update([
            'status' => ContactMessage::READ,
        ]);

        activity(ActivityType::MARKED_AS_READ)
            ->subject("fas fa-envelope", "Contact Message #{$contactMessage->id}")
            ->description($contactMessage->discord ? "Discord: {$contactMessage->discord}" : "Email: {$contactMessage->email}")
            ->log();

        flash("You have successfully marked the message as read!")->success();

        return redirect()->route('staff.contact-messages.index');
    }

    /**
     * Mark the given contact message as unread.
     *
     * @param ContactMessage $contactMessage
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function markAsUnread(ContactMessage $contactMessage)
    {
        Gate::authorize('manage-contact-messages');

        $contactMessage->update([
            'status' => ContactMessage::UNREAD,
        ]);

        activity(ActivityType::MARKED_AS_UNREAD)
            ->subject("fas fa-envelope", "Contact Message #{$contactMessage->id}")
            ->description($contactMessage->discord ? "Discord: {$contactMessage->discord}" : "Email: {$contactMessage->email}")
            ->log();

        flash("You have successfully marked the message as unread!")->success();

        return redirect()->route('staff.contact-messages.index');
    }

    /**
     * Delete the given contact message.
     *
     * @param ContactMessage $contactMessage
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(ContactMessage $contactMessage)
    {
        Gate::authorize('manage-contact-messages');

        $contactMessage->delete();

        activity(ActivityType::DELETED)
            ->subject("fas fa-envelope", "Contact Message #{$contactMessage->id}")
            ->description($contactMessage->discord ? "Discord: {$contactMessage->discord}" : "Email: {$contactMessage->email}")
            ->log();

        flash("You have successfully deleted the message!")->success();

        return redirect()->route('staff.contact-messages.index');
    }
}
