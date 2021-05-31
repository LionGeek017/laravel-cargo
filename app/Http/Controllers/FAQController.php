<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index() {
        $faqs = FAQ::all();
        $metaTags = (object)[
            'title' => 'Ответы на частозадаваемые вопросы',
            'keywords' => 'вопросы, ответы',
            'description' => 'Страница с частозадаваемыми вопросами о системе и ответы на них',
        ];
        return view('faq', compact('faqs', 'metaTags'));
    }
}
