<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'title',
        'description',
        'period',
        'price',
        'status'
    ];
    public static $status = [
        'недоступная',
        'активная'
    ];
    public static $withRelations = [
        'history'
    ];
    public static $type = [
        1 => [
            'name' => 'Грузоотправитель',
            'ico' => '<i class="fas fa-boxes"></i>',
            'bg' => 'primary'
        ],
        2 => [
            'name' => 'Водитель',
            'ico' => '<i class="fas fa-truck-moving"></i>',
            'bg' => 'warning'
        ],
        3 => [
            'name' => 'Диспетчер',
            'ico' => '<i class="fas fa-headset"></i>',
            'bg' => 'info'
        ]
    ];

    public function history() {
        return $this->hasMany(SubscriptionHistory::class, 'subscription_id');
    }
}
