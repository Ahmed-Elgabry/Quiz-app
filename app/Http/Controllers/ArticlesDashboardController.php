<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Settings;
use App\Models\article_statistics;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ArticlesDashboardController extends Controller
{

    public function all_articles($lang = 'ar')
    {

        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {
            $Article_ar =  Article::where('is_arabic', true)->where('status', 'A')->latest()->paginate(12);
            $Article_en = Article::where('is_arabic', false)->where('status', 'A')->latest()->paginate(12);
            $status = "all_articles";
            return view('pages.dashboard.articles.all_articles')->with('Article_ar', $Article_ar)
                ->with('Article_en', $Article_en)
                ->with('status', $status);
        } else {
            abort(404);
        }
    }


    public function search($lang = 'ar')
    {

        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {
            $articles = Article::where('title', 'like',  '%' . request('search') . '%')->where('status', 'A')->get();
            return view('pages.dashboard.articles.search')
                ->with('articles', $articles)
                ->with('query', request('search'));
        } else {
            abort(404);
        }
    }


    public function view($slug, $lang = 'ar')
    {
        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {
            $article = Article::where('slug', $slug)->where('status', 'A')->first();
            if (!$article) {
                abort(404);
            }
            if ($lang == 'ar') {
                $latest_articles = Article::where('status', 'A')->where('is_arabic', 1)->latest()->take(5)->get();
            } else {
                $latest_articles = Article::where('status', 'A')->where('is_arabic', 0)->latest()->take(5)->get();
            }

            article_statistics::updateOrCreate(['article_id' => $article->id,], ['views' => DB::raw('views + 1'),]);

            if ($lang == 'ar') {
                $all_articles = Article::select('id')->where('status', 'A')->where('is_arabic', 1)->get();
            } else {
                $all_articles = Article::select('id')->where('status', 'A')->where('is_arabic', 0)->get();
            }
            $most_views_article = article_statistics::whereIn('article_id', $all_articles)->orderBy('views', 'desc')->take(5)->get();

            return view('pages.dashboard.articles.view')
                ->with('article', $article)
                ->with('latest_articles', $latest_articles)
                ->with('most_views_article', $most_views_article);
        } else {
            abort(404);
        }
    }
}
