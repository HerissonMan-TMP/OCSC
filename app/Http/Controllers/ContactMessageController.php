<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\StoreContactMessageRequest;
use App\Models\ContactCategory;
use App\Models\ContactMessage;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ContactMessageController extends Controller
{
    /**
     * A Question instance.
     *
     * @var ContactMessage
     */
    protected $contactMessage;

    public function __construct(ContactMessage $contactMessage)
    {
        $this->contactMessage = $contactMessage;
    }

    /**
     * Display the list of contact messages received.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        Gate::authorize('read-contact-messages');

        $contactMessages = ContactMessage::with('category')->latest()->get();

        return view('contact-messages.index')
                ->with('contactMessages', $contactMessages);
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
        Gate::authorize('read-contact-messages');

        $contactMessage = $contactMessage->load('category');

        return view('contact-messages.show')
                ->with('contactMessage', $contactMessage);
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
                ->with('categories', $categories);
    }

    /**
     * Store a contact message.
     *
     * @param StoreContactMessageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreContactMessageRequest $request)
    {
        ContactCategory::find($request->category_id)->messages()->create($request->validated());

        return redirect()->route('contact-messages.show-success');
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
        Gate::authorize('change-contact-messages-status');

        $contactMessage->status = 'read';
        $contactMessage->save();

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
        Gate::authorize('change-contact-messages-status');

        $contactMessage->status = 'unread';
        $contactMessage->save();

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
        Gate::authorize('delete-contact-messages');

        $contactMessage->delete();

        return redirect()->route('staff.hub');
    }
}
