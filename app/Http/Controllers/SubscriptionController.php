<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index() {
        $subscriptions = Subscription::select()->orderBy('price', 'asc')->get();
        $type = Subscription::$type;
        return view('subscribe', compact('subscriptions', 'type'));
    }
}
