<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionHistory extends Model
{
    use HasFactory;
    public static $withRelations = [
        'subscription',
        'user',
        'admin'
    ];

    public function subscription() {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function admin() {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
