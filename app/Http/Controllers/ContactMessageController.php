<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\StoreContactMessageRequest;
use App\Models\ContactCategory;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function show(ContactMessage $contactMessage)
    {
        $contactMessage = $contactMessage->load('category');

        return view('staff.contact-messages.show')
                ->with('contactMessage', $contactMessage);
    }

    public function create()
    {
        $categories = ContactCategory::all();

        return view('contact.create')
                ->with('categories', $categories);
    }

    public function showSuccess()
    {
        return view('contact.success-page');
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

    public function markAsRead(ContactMessage $contactMessage)
    {
        $contactMessage->is_marked_as_read = true;
        $contactMessage->save();

        return back();
    }

    public function markAsUnread(ContactMessage $contactMessage)
    {
        $contactMessage->is_marked_as_read = false;
        $contactMessage->save();

        return back();
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()->route('staff.hub');
    }
}
