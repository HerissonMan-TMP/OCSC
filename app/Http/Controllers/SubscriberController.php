<?php

namespace App\Http\Controllers;

use App\Filters\PictureFilters;
use App\Http\Requests\Subscriber\StoreSubscriberRequest;
use App\Models\ActivityType;
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
     * Display the list of the subscribed people.
     *
     * @param PictureFilters $filters
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(PictureFilters $filters)
    {
        $subscribers = Subscriber::filter($filters)->paginate(20);

        return view('subscribers.index')
                ->with(compact('subscribers'));
    }

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

        activity(ActivityType::SUBSCRIBED)
                ->byAnonymous()
                ->description($subscriber->email)
                ->log();

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

        activity(ActivityType::UNSUBSCRIBED)
            ->byAnonymous()
            ->description($subscriber->email)
            ->log();

        flash('Successfully unsubscribed from the newsletter!')->success();

        return redirect()->route('homepage');
    }
}
