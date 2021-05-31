<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogCategoryRequest;
use App\Models\BlogCategory;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
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
    public function index()
    {
        $categories = BlogCategory::with(['posts'])->paginate(10);
        return view('admin.blog.categories-list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.category-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryRequest $request)
    {
        $category = new BlogCategory();
        if($request->user()->cannot('create', $category)) {
            return Redirect::back()->with('prohibited', 'У вас нет прав для создания категории');
        }

        $category->name = $request->name;
        $category->description = $request->description;
        $category->slug = $request->slug;

        if($request->file('img')) {
            $path = Storage::putFile('public', $request->file('img'));
            $url = Storage::url($path);
            $category->img = $url;
        }

        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->meta_keywords = $request->meta_keywords;
        $category->save();

        return redirect()->route('adminchik.categories.index')->with('success', 'Категория успешно создана');
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
        $category = BlogCategory::findOrFail($id);
        return view('admin.blog.category-edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryRequest $request, $id)
    {
        $category = BlogCategory::findOrFail($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->slug = $request->slug;

        if($request->file('img')) {
            $path = Storage::putFile('public', $request->file('img'));
            $url = Storage::url($path);
            $category->img = $url;
        }

        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->meta_keywords = $request->meta_keywords;
        $category->update();
        return redirect()->route('adminchik.categories.index')->with('success', 'Категория успешно обновлена');
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
