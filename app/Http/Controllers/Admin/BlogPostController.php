<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogPostRequest;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = BlogPost::$status;
        $query = BlogPost::select();
        if($request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        $posts = $query->orderBy('id')->paginate(10)->withQueryString();
        $categories = BlogCategory::with(['posts'])->get();
        $postsCount = BlogPost::postsCount($categories);

        return view('admin.blog.post-list', compact('posts', 'categories', 'postsCount', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posts = BlogPost::select()->paginate(10);
        $categories = BlogCategory::with(['posts'])->get();
        $postsCount = BlogPost::postsCount($categories);
        return view('admin.blog.post-create', compact('posts', 'categories', 'postsCount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogPostRequest $request)
    {
        $post = new BlogPost();
        if($request->user()->cannot('create', $post)) {
            return Redirect::back()->with('prohibited', 'У вас нет прав для создания поста');
        }

        $post->user_id = $request->user()->id;
        $post->title = $request->title;
        $post->category_id = $request->category;
        $post->slug = Str::of($request->title)->slug('-');
        $post->text_short = $request->text_short;
        $post->text_full = $request->text_full;

        if($request->file('img')) {
            $path = Storage::putFile('public', $request->file('img'));
            $url = Storage::url($path);
            $post->img = $url;
        }

        $post->meta_title = $request->meta_title;
        $post->meta_description = $request->meta_description;
        $post->meta_keywords = $request->meta_keywords;
        $post->status = $request->status ? 1 : 0;
        $post->save();

        return redirect()->route('adminchik.posts.index')->with('success', 'Пост успешно создан');
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
        $post = BlogPost::with(['category'])->findOrFail($id);
        $categories = BlogCategory::with(['posts'])->get();
        $postsCount = BlogPost::postsCount($categories);
        return view('admin.blog.post-edit', compact('post', 'categories', 'postsCount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogPostRequest $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        if($request->user()->cannot('update', $post)) {
            return Redirect::back()->with('prohibited', 'У вас нет прав для обновления поста');
        }

        $post->title = $request->title;
        $post->category_id = $request->category;
        $post->slug = Str::of($request->title)->slug('-');
        $post->text_short = $request->text_short;
        $post->text_full = $request->text_full;

        if($request->file('img')) {
            $path = Storage::putFile('public', $request->file('img'));
            $url = Storage::url($path);
            $post->img = $url;
        }

        $post->meta_title = $request->meta_title;
        $post->meta_description = $request->meta_description;
        $post->meta_keywords = $request->meta_keywords;
        $post->status = $request->status ? 1 : 0;
        $post->update();

        return redirect()->route('adminchik.posts.index')->with('success', 'Пост успешно обновлен');
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
