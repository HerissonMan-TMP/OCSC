<?php

namespace App\Http\Controllers;

use App\Filters\SubscriberFilters;
use App\Http\Requests\Subscriber\StoreSubscriberRequest;
use App\Models\ActivityType;
use App\Models\Subscriber;
use Crypt;
use Hash;
use Illuminate\Support\Facades\Gate;

/**
 * Class SubscriberController
 * @package App\Http\Controllers
 */
class SubscriberController extends Controller
{
    /**
     * Display the list of the subscribed people.
     *
     * @param SubscriberFilters $filters
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(SubscriberFilters $filters)
    {
        Gate::authorize('manage-subscribers');

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
        Gate::authorize('delete-subscriber', $subscriber);

        $subscriber->delete();

        activity(ActivityType::UNSUBSCRIBED)
            ->byAnonymous()
            ->description($subscriber->email)
            ->log();

        flash('Successfully unsubscribed from the newsletter!')->success();

        return redirect()->route('homepage');
    }
}
