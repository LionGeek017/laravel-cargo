<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index(Request $request) {
        $slug = $request->slug;
        $content = Content::select()->where('slug', $slug)->firstOrFail();
        $metaTags = (object)[
            'title' => $content->meta_title,
            'keywords' => $content->meta_keywords,
            'description' => $content->meta_description,
        ];
        return view('content-static', compact('content', 'metaTags'));
    }


}
