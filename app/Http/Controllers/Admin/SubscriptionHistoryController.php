<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionHistoryRequest;
use App\Models\Subscription;
use App\Models\SubscriptionHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = SubscriptionHistory::with(SubscriptionHistory::$withRelations);
        if($request->has('subscription_id')) {
            $query->where('subscription_id', $request->subscription_id);
        }
        $posts = $query->orderBy('updated_at', 'desc')
            ->paginate(10)
            ->withQueryString();
        return view('admin.subscription.history', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $subscriptions = Subscription::all();
        $users = User::all();
        $userId = $request->user_id ?? null;
        return view('admin.subscription.history-create', compact('users', 'subscriptions', 'userId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubscriptionHistoryRequest $request)
    {
        $subscription = Subscription::findOrFail($request->subscription_id);
        $dt = Carbon::now();

        $post = new SubscriptionHistory();
        $post->user_id = $request->user_id;
        $post->subscription_id = $request->subscription_id;
        $post->type = $subscription->type;
        $post->admin_id = $request->user()->id ?? null;
        $post->date_start = $dt;
        $post->date_end = $request->date_end . ' ' . $dt->format('H:i:s');
        $post->save();
        return redirect()->route('adminchik.history.index')->with('success', 'Пользователь успешно подписан');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = SubscriptionHistory::with(SubscriptionHistory::$withRelations)->findOrFail($id);
        $subscriptions = Subscription::all();
        $users = User::all();
        $userId = $request->user_id ?? null;
        return view('admin.subscription.history-edit', compact('post', 'users', 'subscriptions', 'userId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubscriptionHistoryRequest $request, $id)
    {
        $subscription = Subscription::findOrFail($request->subscription_id);
        $dt = Carbon::now();

        $post = SubscriptionHistory::findOrFail($id);
        $post->subscription_id = $request->subscription_id;
        $post->type = $subscription->type;
        $post->admin_id = $request->user()->id ?? null;
        $post->date_start = $dt;
        $post->date_end = $request->date_end . ' ' . $dt->format('H:i:s');
        $post->update();
        return redirect()->route('adminchik.history.index')->with('success', 'Подписка успешно отредактирована');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
