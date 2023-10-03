<?php

namespace App\Http\Controllers;

use App\Models\Answers;
use App\Models\Questions;
use App\Models\Quiz;
use App\Models\Settings;
use App\Models\CommonQuestions;
use App\Models\Quiz_optios_order;
use App\Models\Article;
use App\Models\UserQuiz;
use App\Models\CategoryQuiz;
use App\Models\QuickQuiz;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class DashboardController extends Controller
{

    public function search($lang = 'ar')
    {

        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {

            $quick_quiz = QuickQuiz::select('id', 'quiz_name', 'slug', 'category', 'type')->where('is_featured', true)->where('quiz_name', 'like',  '%' . request('search') . '%');
            $data = UserQuiz::select('id', 'quiz_name', 'slug', 'category', 'type')->where('is_featured', true)->where('quiz_name', 'like',  '%' . request('search') . '%')->union($quick_quiz)->paginate(12);

            return view('pages.dashboard.search')->with('data', $data)
                ->with('query', request('search'));
        } else {
            abort(404);
        }
    }
    public function index($lang)
    {

        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {
            //  return $lang;

            $Article_ar =  Article::where('is_arabic', true)->where('status', 'A')->where('is_featured', true)->orderBy('featured_at', 'desc')->take(6)->get();
            $Article_en =  Article::where('is_arabic', false)->where('status', 'A')->where('is_featured', true)->orderBy('featured_at', 'desc')->take(6)->get();

            $Usequizzes_ar = UserQuiz::where('lang', 'ar')->where('is_featured', true)->orderBy('featured_at', 'desc')->take(3)->get();
            $Usequizzes_en = UserQuiz::where('lang', 'en')->where('is_featured', true)->orderBy('featured_at', 'desc')->take(3)->get();

            return view('pages.dashboard.index')->with('Usequizzes_ar', $Usequizzes_ar)
                ->with('Usequizzes_en', $Usequizzes_en)
                ->with('Article_ar', $Article_ar)
                ->with('Article_en', $Article_en);
        } else {
            abort(404);
        }
    }


    public function all_usersquizzes($lang = 'ar')
    {
        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {
            $count =  UserQuiz::where('is_featured', true)->count();
            $usersquizzes_ar = UserQuiz::where('lang', 'ar')->where('is_featured', true)->orderBy('featured_at', 'desc')->paginate(12);
            $usersquizzes_en = UserQuiz::where('lang', 'en')->where('is_featured', true)->orderBy('featured_at', 'desc')->paginate(12);
            $status = "usersquizzes";
            $categories_ar = CategoryQuiz::where('lang', 'ar')->latest()->get();
            $categories_en = CategoryQuiz::where('lang', 'en')->latest()->get();
            $count_categories =  CategoryQuiz::count();

            $quickquizzes_ar = QuickQuiz::where('lang', 'ar')->where('is_featured', true)->orderBy('featured_at', 'desc')->paginate(12);
            $quickquizzes_en = QuickQuiz::where('lang', 'en')->where('is_featured', true)->orderBy('featured_at', 'desc')->paginate(12);

            return view('pages.dashboard.usersquizzes_page')->with('quickquizzes_ar', $quickquizzes_ar)
                ->with('quickquizzes_en', $quickquizzes_en)
                ->with('usersquizzes_ar', $usersquizzes_ar)
                ->with('usersquizzes_en', $usersquizzes_en)
                ->with('count', $count)
                ->with('count_categories', $count_categories)
                ->with('categories_ar', $categories_ar)
                ->with('categories_en', $categories_en)
                ->with('status', $status);
        } else {
            abort(404);
        }
    }

    public function all_quickquizzes($lang = 'ar')
    {
        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {
            $count =  QuickQuiz::where('is_featured', true)->count();
            $quickquizzes_ar = QuickQuiz::where('lang', 'ar')->where('is_featured', true)->orderBy('featured_at', 'desc')->paginate(12);
            $quickquizzes_en = QuickQuiz::where('lang', 'en')->where('is_featured', true)->orderBy('featured_at', 'desc')->paginate(12);
            $status = "quickquizzes";
            $categories_ar = CategoryQuiz::where('lang', 'ar')->latest()->get();
            $categories_en = CategoryQuiz::where('lang', 'en')->latest()->get();
            $count_categories =  CategoryQuiz::count();

            $usersquizzes_ar = UserQuiz::where('lang', 'ar')->where('is_featured', true)->orderBy('featured_at', 'desc')->paginate(12);
            $usersquizzes_en = UserQuiz::where('lang', 'en')->where('is_featured', true)->orderBy('featured_at', 'desc')->paginate(12);

            return view('pages.dashboard.quickquizzes_page')->with('quickquizzes_ar', $quickquizzes_ar)
                ->with('quickquizzes_en', $quickquizzes_en)
                ->with('usersquizzes_ar', $usersquizzes_ar)
                ->with('usersquizzes_en', $usersquizzes_en)
                ->with('count', $count)
                ->with('count_categories', $count_categories)
                ->with('categories_ar', $categories_ar)
                ->with('categories_en', $categories_en)
                ->with('status', $status);
        } else {
            abort(404);
        }
    }

    public function cate_quizzes($slug, $lang = 'ar')
    {
        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);
        if ($lang == 'ar' || $lang == 'en') {
            $category = CategoryQuiz::where('slug',$slug)->first();
            $title = $category->name;
            $status = $category->id;

            $quick_quiz = QuickQuiz::select('id', 'quiz_name', 'slug', 'category', 'type')->where('category', $category->id);
            $data = UserQuiz::select('id', 'quiz_name', 'slug', 'category', 'type')->where('category', $category->id)->union($quick_quiz)->paginate(12);

            $categories_ar = CategoryQuiz::where('lang', 'ar')->latest()->get();
            $categories_en = CategoryQuiz::where('lang', 'en')->latest()->get();
            $count_categories =  CategoryQuiz::count();
            $usersquizzes = UserQuiz::where('is_featured', true)->orderBy('featured_at', 'desc')->paginate(12);
            $quickquizzes = QuickQuiz::where('is_featured', true)->orderBy('featured_at', 'desc')->paginate(12);

            $usersquizzes_ar = UserQuiz::where('lang', 'ar')->where('is_featured', true)->orderBy('featured_at', 'desc')->paginate(12);
            $usersquizzes_en = UserQuiz::where('lang', 'en')->where('is_featured', true)->orderBy('featured_at', 'desc')->paginate(12);


            $quickquizzes_ar = QuickQuiz::where('lang', 'ar')->where('is_featured', true)->orderBy('featured_at', 'desc')->paginate(12);
            $quickquizzes_en = QuickQuiz::where('lang', 'en')->where('is_featured', true)->orderBy('featured_at', 'desc')->paginate(12);


            return view('pages.dashboard.cat_quizzes_page')->with('status', $status)
                ->with('data', $data)
                ->with('count_categories', $count_categories)
                ->with('quickquizzes', $quickquizzes)
                ->with('usersquizzes', $usersquizzes)
                ->with('usersquizzes_ar', $usersquizzes_ar)
                ->with('usersquizzes_en', $usersquizzes_en)
                ->with('quickquizzes_ar', $quickquizzes_ar)
                ->with('quickquizzes_en', $quickquizzes_en)
                ->with('categories_ar', $categories_ar)
                ->with('categories_en', $categories_en)
                ->with('category', $category)
                ->with('title', $title);
        } else {
            abort(404);
        }
    }


    public function about($lang = 'ar')
    {

        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {
            return view('pages.dashboard.about')
                ->with('aboutUs_text_ar', Settings::first()->aboutUs_text_ar)
                ->with('aboutUs_text_en', Settings::first()->aboutUs_text_en);
        } else {
            abort(404);
        }
    }

    public function contact($lang = 'ar')
    {

        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {
            //  return $lang;
            return view('pages.dashboard.contact');
        } else {
            abort(404);
        }
    }

    public function common($lang = 'ar')
    {

        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {

            $common_questions = CommonQuestions::all();

            $count_ar =  CommonQuestions::where('is_arabic', true)->count();
            $count_en =  CommonQuestions::where('is_arabic', false)->count();

            $common_questions_ar =  CommonQuestions::where('is_arabic', true)->latest()->get();
            $common_questions_en = CommonQuestions::where('is_arabic', false)->latest()->get();

            return view('pages.dashboard.common')
                ->with('common_questions', $common_questions)
                ->with('common_questions_ar', $common_questions_ar)
                ->with('common_questions_en', $common_questions_en);
        } else {
            abort(404);
        }
    }

    public function privacy_policy($lang = 'ar')
    {

        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {
            //  return $lang;
            return view('pages.dashboard.privacy_policy')
                ->with('policy_ar', Settings::first()->policy_ar)
                ->with('policy_en', Settings::first()->policy_en);
        } else {
            abort(404);
        }
    }

    public function terms_of_service($lang = 'ar')
    {

        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {
            //  return $lang;
            return view('pages.dashboard.terms_of_service')
                ->with('terms_ar', Settings::first()->terms_ar)
                ->with('terms_en', Settings::first()->terms_en);
        } else {
            abort(404);
        }
    }
}
