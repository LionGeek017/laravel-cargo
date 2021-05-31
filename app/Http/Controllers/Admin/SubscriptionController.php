<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Subscription;
use App\Models\SubscriptionHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = Subscription::$status;
        $posts = Subscription::with(Subscription::$withRelations)->get();
        return view('admin.subscription.list', compact('posts', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subscription.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubscriptionRequest $request)
    {
        if(Subscription::where('type', $request->type)->count() > 0) {
            return redirect()->back()->with('prohibited', 'Подписка с типом ' . $request->type . ' уже существует');
        }
        Subscription::create($request->all());
        return redirect()->route('adminchik.subscriptions.index')->with('success', 'Подписка успешно создана');
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
        $post = Subscription::findOrFail($id);
        return view('admin.subscription.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubscriptionRequest $request, $id)
    {
        $post = Subscription::findOrFail($id);
        $post->update($request->all());
        return redirect()->route('adminchik.subscriptions.index')->with('success', 'Подписка успешно сохранена');
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
