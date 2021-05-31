<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;
    public static $status = [
        'блок',
        'активный'
    ];

    public static $withRelations = [
        'category'
    ];

    public function category() {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public static function postsCount($categories) {
        $postsCount = 0;
        foreach ($categories as $category) {
            $postsCount += $category->posts->count();
        }
        return $postsCount;
    }
}
