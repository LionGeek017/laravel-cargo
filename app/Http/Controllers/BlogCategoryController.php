<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index(Request $request, $categorySlug) {

        $category = BlogCategory::where('slug', $categorySlug)->firstOrFail();
        $posts = BlogPost::with(BlogPost::$withRelations)
            ->where('status', 1)
            ->where('category_id', $category->id)
            ->orderBy('created_at')
            ->paginate(10);

        $metaTags = (object)[
            'title' => $category->meta_title,
            'keywords' => $category->meta_keywords,
            'description' => $category->meta_description,
        ];

        return view('blog.index', compact('posts', 'metaTags'));

    }
}
