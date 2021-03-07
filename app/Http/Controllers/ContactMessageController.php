<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\StoreContactMessageRequest;
use App\Models\ContactCategory;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ContactMessageController extends Controller
{
    public function index()
    {
        Gate::authorize('read-contact-messages');

        $contactMessages = ContactMessage::with('category')->latest()->get();

        return view('contact-messages.index')
                ->with('contactMessages', $contactMessages);
    }

    public function show(ContactMessage $contactMessage)
    {
        Gate::authorize('read-contact-messages');

        $contactMessage = $contactMessage->load('category');

        return view('contact-messages.show')
                ->with('contactMessage', $contactMessage);
    }

    public function create()
    {
        $categories = ContactCategory::all();

        return view('contact-messages.create')
                ->with('categories', $categories);
    }

    public function store(StoreContactMessageRequest $request)
    {
        $contactMessage = new ContactMessage;
        $contactMessage->truckersmp_id = $request->truckersmp_id;
        $contactMessage->vtc = $request->vtc;
        $contactMessage->discord = $request->discord;
        $contactMessage->email = $request->email;
        $contactMessage->message = $request->message;
        $contactMessage->category()->associate($request->category_id);

        $contactMessage->save();

        return redirect()->route('contact-messages.show-success');
    }

    public function showSuccess()
    {
        return view('contact-messages.success-page');
    }

    public function markAsRead(ContactMessage $contactMessage)
    {
        Gate::authorize('change-contact-messages-status');

        $contactMessage->status = 'read';
        $contactMessage->save();

        return redirect()->route('staff.contact-messages.index');
    }

    public function markAsUnread(ContactMessage $contactMessage)
    {
        Gate::authorize('change-contact-messages-status');

        $contactMessage->status = 'unread';
        $contactMessage->save();

        return redirect()->route('staff.contact-messages.index');
    }

    public function destroy(ContactMessage $contactMessage)
    {
        Gate::authorize('delete-contact-messages');

        $contactMessage->delete();

        return redirect()->route('staff.hub');
    }
}
