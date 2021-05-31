<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MetaTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class MetaTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $post = MetaTag::findOrFail($id);
        return view('admin.meta-seo', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = MetaTag::findOrFail($id);

        if($request->user()->cannot('update', $post)) {
            return Redirect::back()->with('prohibited', 'У вас нет прав для обновления поста');
        }

        $post->title = $request->title;
        $post->description = $request->description;
        $post->keywords = $request->keywords;
        if($request->file('img')) {
            $path = Storage::putFile('public', $request->file('img'));
            $url = Storage::url($path);
            $post->img = $url;
        }
        $post->slogan_top = $request->slogan_top;
        $post->seo_main = $request->seo_main;
        $post->seo_cargo = $request->seo_cargo;
        $post->seo_car = $request->seo_car;
        $post->update();

        return redirect()->route('adminchik.index')->with('success', 'Мета теги и СЕО контент успешно обновлен');
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
