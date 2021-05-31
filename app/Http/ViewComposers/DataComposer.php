<?php

namespace App\Http\ViewComposers;
use App\Models\BlogCategory;
use App\Models\MetaTag;
use Illuminate\View\View;

use Carbon\Carbon;

class DataComposer
{
    public static function compose(View $view) {
        $date = Carbon::now();
        $dateUnix = strtotime($date);
        $blogCategories = BlogCategory::all();
        $query = MetaTag::findOrFail(1);
        $ogImage = $query->img;

        $view->with([
            'date' => $date,
            'dateUnix' => $dateUnix,
            'blogCategories' => $blogCategories,
            'ogImage' => $ogImage,
        ]);

        return $view;
    }

}
