<?php

namespace App\Http\ViewComposers;
use App\Models\BlogCategory;
use App\Models\Content;
use App\Models\MetaTag;
use Illuminate\View\View;

use Carbon\Carbon;

class LinkPageStatic
{
    public static function compose(View $view) {
        $pagesStatic = Content::all();
        $view->with([
            'pagesStatic' => $pagesStatic
        ]);
        return $view;
    }

}
