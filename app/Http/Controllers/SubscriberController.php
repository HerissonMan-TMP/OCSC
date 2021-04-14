<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subscriber\StoreSubscriberRequest;
use App\Models\Subscriber;
use Crypt;
use Hash;

/**
 * Class SubscriberController
 * @package App\Http\Controllers
 */
class SubscriberController extends Controller
{
    /**
     * Store a new subscriber in the database.
     *
     * @param StoreSubscriberRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSubscriberRequest $request)
    {
        $subscriber = new Subscriber;

        $subscriber->email = $request->email;
        $subscriber->unsubscribe_token = Crypt::encryptString($request->email);

        $subscriber->save();

        flash('You have successfully subscribed to our newsletter!')->success();

        return back();
    }

    /**
     * Delete a subscription from the database.
     *
     * @param Subscriber $subscriber
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        flash('You have successfully unsubscribed from our newsletter!')->success();

        return redirect()->route('homepage');
    }
}
