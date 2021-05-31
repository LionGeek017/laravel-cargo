<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function index(Request $request) {

        $metaTags = (object)[
            'title' => 'Блог',
            'keywords' => 'Ключи блога',
            'description' => 'Краткое описание блога',
        ];

        $posts = BlogPost::with(BlogPost::$withRelations)
            ->where('status', 1)
            ->orderBy('created_at')
            ->paginate();
        return view('blog.index', compact('posts', 'metaTags'));

    }

    public function show(Request $request, $categorySlug, $id, $postSlug) {

        $post = BlogPost::with(BlogPost::$withRelations)
            ->findOrFail($id);
        if($request->user()->cannot('view', $post)) {
            abort(404);
        }
        $metaTags = (object)[
            'title' => $post->meta_title,
            'keywords' => $post->meta_keywords,
            'description' => $post->meta_description,
        ];
        return view('blog.post-view', compact('post', 'metaTags'));

    }
}
