<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\user\QuizController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArticlesDashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryQuizController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\User\ResultsController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\QuickQuizController;
use App\Http\Controllers\AdminQuickQuiz;
use App\Http\Controllers\User\myArticlesController;
use App\Http\Controllers\MailController;

/* Route::get('refreshcaptcha', 'Auth\RegisterController@refreshCaptcha'); */

Route::get('/make/slug/userquiz', [QuizController::class, 'makeSlugforQuizzess']); // slug for quiz name for (user_quizzes)
Route::get('/make/slug/useranswers', [QuizController::class, 'makeSlugforAnswers']); // slug for quiz name for (user_answers)
Route::get('/make/slug/category', [CategoryQuizController::class, 'makeSlugforCategories']); // slug for quiz name for (user_answers)
Route::get('/sendmail', [MailController::class, 'index']);


//User Quiz
Route::name('user-quiz')->group(function () {
    Route::get('/start/{slug}/{lang?}', [QuizController::class, 'start_test'])->name('.start_test');
    Route::post('/store/{slug}/{name}/{ans}/{lang}', [QuizController::class, 'store_answers'])->name('.store_useranswers');
    Route::get('/result/{answer_slug}/{lang?}', [QuizController::class, 'get_result'])->name('.get_result');
    Route::get('/results/{slug}/{lang?}', [QuizController::class, 'get_results'])->name('.get_results');
    Route::get('/share/{slug}/{lang?}', [QuizController::class, 'share_quiz'])->name('.share_quiz');
});


//Quick Quiz
Route::prefix('/quick-quiz')->name('quick-quiz')->group(function () {
    Route::get('/access/{slug}/{lang?}', [QuickQuizController::class, 'quick_access'])->name('.quick_access');
    Route::get('/share/{slug}/{lang?}', [QuickQuizController::class, 'share_quiz'])->name('.share_quiz');
    Route::get('/settings/{slug}/{lang?}', [QuickQuizController::class, 'settings_quiz'])->name('.settings_quiz');
    Route::post('/do_settings/{slug}', [QuickQuizController::class, 'do_settings_quiz'])->name('.do_settings_quiz');
    Route::get('/create/{name}/{lang?}', [QuickQuizController::class, 'create'])->name('.create');
    Route::post('/store', [QuickQuizController::class, 'store'])->name('.store');
    Route::get('/next/{slug}/{lang?}', [QuickQuizController::class, 'create_next_question'])->name('.create_next_question');
    Route::post('/nextquestion/{id}', [QuickQuizController::class, 'store_next_question'])->name('.store_next_question');
    Route::get('/start/{slug}/{lang?}', [QuickQuizController::class, 'start_test'])->name('.start_test');
    Route::post('/store/{slug}/{name}/{ans}/{lang}', [QuickQuizController::class, 'store_answers'])->name('.store_useranswers');
    Route::get('/result/{answer_slug}/{lang?}', [QuickQuizController::class, 'get_result'])->name('.get_result');
    Route::get('/results/{slug}/{lang?}', [QuickQuizController::class, 'get_results'])->name('.get_results');
    Route::get('/get/option/{id}', [QuickQuizController::class, 'get_option_info'])->name('.get_option_info');


    Route::get('/create-survey/{name}/{lang?}', [QuickQuizController::class, 'create_survey'])->name('.create_survey');
    Route::get('/next-survey/{slug}/{lang?}', [QuickQuizController::class, 'create_survey_next_question'])->name('.create_survey_next_question');

    Route::get('/create-multiple/{name}/{lang?}', [QuickQuizController::class, 'create_multiple'])->name('.create_multiple');
    Route::get('/next-multiple/{slug}/{lang?}', [QuickQuizController::class, 'create_multiple_next_question'])->name('.create_multiple_next_question');

});

/////////////////////////////////////////////////////
Route::get('/language/{lang}', function ($lang) { Session::put('lang', $lang);  return redirect()->back(); })->name('language');
/////////////////////////////////////////////////////////////
//route for query results(search)
Route::get('/search/results/{lang?}', [DashboardController::class, 'search'])->name('search');
Route::get('/search/articles/{lang?}', [ArticlesDashboardController::class, 'search'])->name('search_articles');

///////////////////////////////////////////////////////////////
Route::get('/facebook/{slug}/{lang}', function ($slug, $lang) { return redirect('https://www.facebook.com/sharer/sharer.php?u=' . route('user-quiz.share_quiz', ['slug' => $slug, 'lang' => $lang])); })->name('UQuiz_facebook_share');
Route::get('/twitter/{slug}/{lang}',  function ($slug, $lang) { return redirect('https://twitter.com/intent/tweet?text=' . route('user-quiz.share_quiz', ['slug' => $slug, 'lang' => $lang])); })->name('UQuiz_twitter_share');
Route::get('/whatsapp/{slug}/{lang}', function ($slug, $lang) { return redirect('whatsapp://send?text=' . route('user-quiz.share_quiz', ['slug' => $slug, 'lang' => $lang])); })->name('UQuiz_whatsapp_share');

Route::get('/results/facebook/{slug}/{lang}', function ($slug, $lang) {  return redirect('https://www.facebook.com/sharer/sharer.php?u=' . route('user-quiz.get_results', ['slug' => $slug, 'lang' => $lang])); })->name('Uresults_facebook_share');
Route::get('/results/twitter/{slug}/{lang}',  function ($slug, $lang) {  return redirect('https://twitter.com/intent/tweet?text=' . route('user-quiz.get_results', ['slug' => $slug, 'lang' => $lang])); })->name('Uresults_twitter_share');
Route::get('/results/whatsapp/{slug}/{lang}', function ($slug, $lang) { return redirect('whatsapp://send?text=' . route('user-quiz.get_results', ['slug' => $slug, 'lang' => $lang])); })->name('Uresults_whatsapp_share');


Route::get('/uquizresult/facebook/{answer_slug}/{lang}', function ($answer_slug, $lang) {    return redirect('https://www.facebook.com/sharer/sharer.php?u=' . route('user-quiz.get_result', ['answer_slug' => $answer_slug, 'lang' => $lang])); })->name('Uquizresult_facebook_share');
Route::get('/uquizresult/twitter/{answer_slug}/{lang}',  function ($answer_slug, $lang) {    return redirect('https://twitter.com/intent/tweet?text=' . route('user-quiz.get_result', ['answer_slug' => $answer_slug, 'lang' => $lang])); })->name('Uquizresult_twitter_share');
Route::get('/uquizresult/whatsapp/{answer_slug}/{lang}', function ($answer_slug, $lang) {    return redirect('whatsapp://send?text=' . route('user-quiz.get_result', ['answer_slug' => $answer_slug, 'lang' => $lang])); })->name('Uquizresult_whatsapp_share');

//quick quiz
Route::get('/quickquiz/facebook/{slug}/{lang}', function ($slug, $lang) { return redirect('https://www.facebook.com/sharer/sharer.php?u=' . route('quick-quiz.share_quiz', ['slug' => $slug, 'lang' => $lang])); })->name('QQuiz_facebook_share');
Route::get('/quickquiz/twitter/{slug}/{lang}',  function ($slug, $lang) { return redirect('https://twitter.com/intent/tweet?text=' . route('quick-quiz.share_quiz', ['slug' => $slug, 'lang' => $lang])); })->name('QQuiz_twitter_share');
Route::get('/quickquiz/whatsapp/{slug}/{lang}', function ($slug, $lang) { return redirect('whatsapp://send?text=' . route('quick-quiz.share_quiz', ['slug' => $slug, 'lang' => $lang])); })->name('QQuiz_whatsapp_share');

Route::get('/quickquiz/result/facebook/{answer_slug}/{lang}', function ($answer_slug, $lang) {    return redirect('https://www.facebook.com/sharer/sharer.php?u=' . route('quick-quiz.get_result', ['answer_slug' => $answer_slug, 'lang' => $lang])); })->name('Qquizresult_facebook_share');
Route::get('/quickquiz/result/twitter/{answer_slug}/{lang}',  function ($answer_slug, $lang) {    return redirect('https://twitter.com/intent/tweet?text=' . route('quick-quiz.get_result', ['answer_slug' => $answer_slug, 'lang' => $lang])); })->name('Qquizresult_twitter_share');
Route::get('/quickquiz/result/whatsapp/{answer_slug}/{lang}', function ($answer_slug, $lang) {    return redirect('whatsapp://send?text=' . route('quick-quiz.get_result', ['answer_slug' => $answer_slug, 'lang' => $lang])); })->name('Qquizresult_whatsapp_share');

Route::get('/quickquiz/results/facebook/{slug}/{lang}', function ($slug, $lang) {  return redirect('https://www.facebook.com/sharer/sharer.php?u=' . route('quick-quiz.get_results', ['slug' => $slug, 'lang' => $lang])); })->name('Qresults_facebook_share');
Route::get('/quickquiz/results/twitter/{slug}/{lang}',  function ($slug, $lang) {  return redirect('https://twitter.com/intent/tweet?text=' . route('quick-quiz.get_results', ['slug' => $slug, 'lang' => $lang])); })->name('Qresults_twitter_share');
Route::get('/quickquiz/results/whatsapp/{slug}/{lang}', function ($slug, $lang) { return redirect('whatsapp://send?text=' . route('quick-quiz.get_results', ['slug' => $slug, 'lang' => $lang])); })->name('Qresults_whatsapp_share');

////////////////////////////////////////////////////////////
Route::get('/', function () { return redirect()->route('home', ['lang' => 'ar']); });
Route::get('/users-quizzes/{lang?}', [DashboardController::class, 'all_usersquizzes'])->name('all_usersquizzes');
Route::get('/quick-quizzes/{lang?}', [DashboardController::class, 'all_quickquizzes'])->name('all_quickquizzes');

Route::get('/about/{lang?}', [DashboardController::class, 'about'])->name('about');
Route::get('/contact/{lang?}', [DashboardController::class, 'contact'])->name('contact');
Route::get('/common_questions/{lang?}', [DashboardController::class, 'common'])->name('common');
Route::get('/privacy_policy/{lang?}', [DashboardController::class, 'privacy_policy'])->name('privacy_policy');
Route::get('/terms_of_service/{lang?}', [DashboardController::class, 'terms_of_service'])->name('terms_of_service');
Route::get('/articles/{lang?}', [ArticlesDashboardController::class, 'all_articles'])->name('all_articles');
Route::get('/quiz/{slug}/{lang?}', [DashboardController::class, 'cate_quizzes'])->name('cate_quizzes');
Route::get('/article/{slug}/{lang?}', [ArticlesDashboardController::class, 'view'])->name('view_article');
Route::get('/{lang}', [DashboardController::class, 'index'])->name('home');


Route::get('/home/logout', 'Auth\LoginController@logout')->name('logout');
Route::group(['prefix' => '/home'], function () {   Auth::routes(['verify' => true]); });

Route::group([], function () {

    Route::get('/u/dashboard', [UserController::class, 'home'])->name('dashboard')->middleware('auth');
    Route::get('/u/settings/{id}',  [UserController::class, 'settings'])->name('settings');
    Route::post('/u/settings/{id}', [UserController::class, 'do_settings'])->name('do_settings');
    Route::post('/u/changePassword', [UserController::class, 'changePassword'])->name('changePassword');
    Route::get('/u/settings', [SettingsController::class, 'setting'])->name('website_settings')->middleware('admin');
    Route::put('/u/update/settings', [SettingsController::class, 'do_setting'])->name('do_websit_setting')->middleware('admin');
    Route::get('/u/commonquestions', [SettingsController::class, 'common_questions_index'])->name('common_questions_index')->middleware('admin');
    Route::delete('/u/common_questions/delete/{id}', [SettingsController::class, 'destroy_common_questions'])->name('common_questions_delete');
    Route::post('/u/common_questions/deleteall', [SettingsController::class, 'destroyall_common_questions'])->name('.common_questions_deleteall');
    Route::get('/u/common_questions/create', [SettingsController::class, 'common_questions_create'])->name('common_questions_create')->middleware('admin');
    Route::post('/u/common_questions/store', [SettingsController::class, 'common_questions_store'])->name('common_questions_store')->middleware('admin');
    Route::get('/u/common_questions/edit/{id}', [SettingsController::class, 'common_questions_edit'])->name('common_questions_edit')->middleware('admin');
    Route::put('/u/common_questions/update/{id}', [SettingsController::class, 'common_questions_update'])->name('common_questions_update')->middleware('admin');
    Route::get('/u/privacy_policy', [SettingsController::class, 'privacy_policy'])->name('privacy_policy1')->middleware('admin');
    Route::put('/u/privacy_policy/update', [SettingsController::class, 'do_privacy_policy'])->name('do_privacy_policy')->middleware('admin');
    Route::get('/u/terms_of_service', [SettingsController::class, 'terms_of_service'])->name('terms_of_service1')->middleware('admin');
    Route::put('/u/terms_of_service/update', [SettingsController::class, 'do_terms_of_service'])->name('do_terms_of_service')->middleware('admin');
    Route::get('/u/ads', [AdsController::class, 'ads'])->name('ads')->middleware('admin');
    Route::put('/u/ads/update', [AdsController::class, 'do_ads'])->name('do_ads')->middleware('admin');




    //this group on Laravel 8
    Route::prefix('/u/articles/')->name('articles')->middleware('admin')->group(function () {
        Route::get('/', [ArticleController::class, 'index'])->name('');
        Route::get('/show/{id}', [ArticleController::class, 'showArticle'])->name('showArticle');
        Route::get('/featured', [ArticleController::class, 'featured'])->name('.featured');
        Route::get('/trashed', [ArticleController::class, 'trashed'])->name('.trashed');
        Route::get('/pending', [ArticleController::class, 'pending'])->name('.pending');
        Route::get('/approved', [ArticleController::class, 'approved'])->name('.approved');
        Route::get('/rejected', [ArticleController::class, 'rejected'])->name('.rejected');
        Route::put('/trashed/restore/{id}', [ArticleController::class, 'restore'])->name('.restore');
        Route::delete('/trashed/delete/{id}', [ArticleController::class, 'forceDelete'])->name('.forceDelete');
        Route::post('/trashed/restoreall', [ArticleController::class, 'restoreall'])->name('.restoreall');
        Route::post('/trashed/forcedeleteall', [ArticleController::class, 'forcedeleteall'])->name('.forcedeleteall');
        Route::get('/create', [ArticleController::class, 'create'])->name('.create');
        Route::post('/store', [ArticleController::class, 'store'])->name('.store');
        Route::get('/create/en', [ArticleController::class, 'create_en'])->name('.create_en');
        Route::post('/store/en', [ArticleController::class, 'store_en'])->name('.store_en');
        Route::get('/edit/{id}', [ArticleController::class, 'edit'])->name('.edit');
        Route::put('/update/{id}', [ArticleController::class, 'update'])->name('.update');
        Route::put('/update_status/{id}', [ArticleController::class, 'update_status'])->name('.update_status');
        Route::put('/update_featured/{id}', [ArticleController::class, 'update_featured'])->name('.update_featured');
        Route::delete('/delete/{id}', [ArticleController::class, 'destroy'])->name('.delete');
        Route::post('/deleteall', [ArticleController::class, 'deleteall'])->name('.deleteall');
    });


    //this group on Laravel 8
    Route::prefix('/u/users')->name('users')->middleware('admin')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('');
        Route::get('/show/{id}', [UserController::class, 'showUser'])->name('showUser');
        Route::get('/show/blocked/{id}', [UserController::class, 'showblockedUser'])->name('showUser');
        Route::get('/blocked', [UserController::class, 'blocked'])->name('.blocked');
        Route::put('/upgrade/{id}', [UserController::class, 'upgrade'])->name('.upgrade');
        Route::put('/blocked/restore/{id}', [UserController::class, 'restore'])->name('.restore');
        Route::delete('/blocked/delete/{id}', [UserController::class, 'forceDelete'])->name('.forceDelete');
        Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('.delete');
        Route::post('/blockall', [UserController::class, 'blockall'])->name('.blockall');
        Route::post('/unblockall', [UserController::class, 'unblockall'])->name('.unblockall');
        Route::post('/deleteall', [UserController::class, 'deleteall'])->name('.deleteall');
    });

    //this group on Laravel 8
    Route::prefix('/u/categories')->name('categories')->middleware('admin')->group(function () {
        Route::get('/', [CategoryQuizController::class, 'index'])->name('');
        Route::get('/user-quizzes/{id}', [CategoryQuizController::class, 'user_quizzes'])->name('.user_quizzes');
        Route::get('/quick-quizzes/{id}', [CategoryQuizController::class, 'quick_quizzes'])->name('.quick_quizzes');
        Route::get('/create', [CategoryQuizController::class, 'create'])->name('.create');
        Route::post('/store', [CategoryQuizController::class, 'store'])->name('.store');
        Route::get('/edit/{id}', [CategoryQuizController::class, 'edit'])->name('.edit');
        Route::put('/update/{id}', [CategoryQuizController::class, 'update'])->name('.update');
        Route::delete('/delete/{id}', [CategoryQuizController::class, 'destroy'])->name('.delete');
        Route::post('/deleteall', [CategoryQuizController::class, 'deleteall'])->name('.deleteall');
    });

    //this group on Laravel 8
    Route::prefix('/u/editors')->name('editors')->middleware('admin')->group(function () {
        Route::get('/', [EditorController::class, 'index'])->name('');
        Route::get('/his_articles/{id}', [EditorController::class, 'his_articles'])->name('.his_articles');
        Route::put('/downgrade/{id}', [EditorController::class, 'downgrade'])->name('.downgrade');
    });

    //this group on Laravel 8
    Route::prefix('/u/notifications')->name('notifications')->middleware('admin')->group(function () {
        Route::get('/', [LogController::class, 'index'])->name('');
        Route::get('/update_log/{id}', [LogController::class, 'update_log'])->name('.update_log');
    });


    //this group on Laravel 8
    Route::namespace('User')->prefix('/u/usersquizzes')->name('usersquizzes')->middleware('admin')->group(function () {
        Route::get('/', [QuizController::class, 'index_all'])->name('');
        Route::post('/featured/{id}', [QuizController::class, 'featured'])->name('.featured');
        Route::get('/show/{id}', [QuizController::class, 'showQuiz'])->name('showQuiz');
        Route::put('/update_status/{id}', [QuizController::class, 'update_status'])->name('.update_status');
        Route::put('/update_lang/{id}', [QuizController::class, 'update_lang'])->name('.update_lang');
        Route::get('/selectCategory', [QuizController::class, 'getSelectCategory'])->name('.getSelectCategory');
        Route::delete('/delete/{id}', [QuizController::class, 'destroy_admin'])->name('.delete');
        Route::post('/deleteall', [QuizController::class, 'deleteall'])->name('.delete_all');
    });

    //this group on Laravel 8
    Route::prefix('/u/quick-quizzes')->name('quickquizzes')->middleware('admin')->group(function () {
        Route::get('/', [AdminQuickQuiz::class, 'index_all'])->name('');
        Route::post('/featured/{id}', [AdminQuickQuiz::class, 'featured'])->name('.featured');
        Route::get('/show/{id}', [AdminQuickQuiz::class, 'showQuiz'])->name('showQuiz');
        Route::put('/update_status/{id}', [AdminQuickQuiz::class, 'update_status'])->name('.update_status');
        Route::put('/update_lang/{id}', [AdminQuickQuiz::class, 'update_lang'])->name('.update_lang');
        Route::get('/selectCategory', [AdminQuickQuiz::class, 'getSelectCategory'])->name('.getSelectCategory');
        Route::delete('/delete/{id}', [AdminQuickQuiz::class, 'destroy_admin'])->name('.delete');
        Route::post('/deleteall', [AdminQuickQuiz::class, 'deleteall'])->name('.delete_all');
    });

    //this group on Laravel 8
    Route::namespace('User')->prefix('/u/userarticles')->name('user_articles')->middleware('editor')->group(function () {
        Route::get('/', [myArticlesController::class, 'index'])->name('');
        Route::get('/create', [myArticlesController::class, 'create'])->name('.create');
        Route::post('/store', [myArticlesController::class, 'store'])->name('.store');
        Route::get('/edit/{id}', [myArticlesController::class, 'edit'])->name('.edit');
        Route::put('/update/{id}', [myArticlesController::class, 'update'])->name('.update');
        Route::delete('/delete/{id}', [myArticlesController::class, 'destroy'])->name('.delete');
        Route::post('/deleteall', [myArticlesController::class, 'deleteall'])->name('.deleteall');

    });

    //this group on Laravel 8
    Route::namespace('User')->prefix('/u/userquiz')->name('user_quiz')->middleware('user')->group(function () {
        Route::get('/block_result/{id}', [QuizController::class, 'block_result'])->name('.block_result');
        Route::get('/unblock_result/{id}', [QuizController::class, 'unblock_result'])->name('.unblock_result');
        Route::get('/private_quiz/{id}', [QuizController::class, 'private_quiz'])->name('.private_quiz');
        Route::get('/public_quiz/{id}',  [QuizController::class, 'public_quiz'])->name('.public_quiz');
        Route::get('/hide_result/{id}', [QuizController::class, 'hide_result'])->name('.hide_result');
        Route::get('/unhide_result/{id}', [QuizController::class, 'unhide_result'])->name('.unhide_result');
        Route::get('/hide_result_counter/{id}', [QuizController::class, 'hide_result_counter'])->name('.hide_result');
        Route::get('/unhide_result_counter/{id}', [QuizController::class, 'unhide_result_counter'])->name('.unhide_result');
        Route::get('/block_all_result', [QuizController::class, 'block_all_result'])->name('.block_all_result');
        Route::get('/unblock_all_result', [QuizController::class, 'unblock_all_result'])->name('.unblock_all_result');
        Route::get('/order_options/{id}', [QuizController::class, 'order_options'])->name('.order_options');
        Route::get('/order_options2/{id}', [QuizController::class, 'order_options2'])->name('.order_options2');
        Route::get('/do/order_option/{id}', [QuizController::class, 'do_options_order'])->name('.do_options_order');
        Route::get('/add_shown_result/{id}', [QuizController::class, 'shown_result'])->name('.shown_result');
        Route::post('/do/shown_result/{id}', [QuizController::class, 'do_shown_result'])->name('.do_shown_result');
        Route::get('/shown_result/{id}', [QuizController::class, 'editindex_shown_result'])->name('.editindex_shown_result');
        Route::get('/edit/shown_result/{id}', [QuizController::class, 'edit_shown_result'])->name('.edit_shown_result');
        Route::post('/edit/shown_result/{id}', [QuizController::class, 'update_shown_result'])->name('.update_shown_result');
        Route::get('/', [QuizController::class, 'index'])->name('');
        Route::get('/create', [QuizController::class, 'create'])->name('.create');
        Route::get('/next/question/{id}', [QuizController::class, 'create_next_question'])->name('.create_next_question');
        Route::post('/store', [QuizController::class, 'store'])->name('.store');
        Route::get('/show/{id}', [QuizController::class, 'showQuiz'])->name('showQuiz');
        Route::post('/nextquestion/{id}', [QuizController::class, 'store_next_question'])->name('.store_next_question'); //
        Route::get('/edit/{id}', [QuizController::class, 'edit'])->name('.edit');
        Route::put('/update2/{id}', [QuizController::class, 'update'])->name('.update');
        Route::put('/question/image/delete/{id}', [QuizController::class, 'delete_img_question'])->name('.delete_img_question');
        Route::put('/option/image/delete/{id}', [QuizController::class, 'delete_img_option'])->name('.delete_img_option');
        Route::delete('/delete/{id}', [QuizController::class, 'destroy'])->name('.delete');
        Route::post('/deleteall', [QuizController::class, 'deleteall'])->name('.delete_all');
        Route::delete('/delete/question/{id}', [QuizController::class, 'destroy_Question'])->name('.destroy_Question');
        Route::delete('/delete/option/{id}', [QuizController::class, 'destroy_Option'])->name('.destroy_Option');
        Route::delete('/delete/shown_result/{id}', [QuizController::class, 'destroy_shown_result'])->name('.destroy_shown_result');
        Route::post('/deleteall/shown_result', [QuizController::class, 'deleteall_shown_result'])->name('.deleteall_shown_result');

    });

    //this group on Laravel 8
    Route::namespace('User')->prefix('/u/userreults')->name('user_reults')->middleware('user')->group(function () {
        Route::get('/', [ResultsController::class, 'index'])->name('');
        Route::get('/{id}', [ResultsController::class, 'show'])->name('.show');
        Route::delete('/delete/{id}', [ResultsController::class, 'destroy'])->name('.delete');
        /* Route::delete('/delete/all/{id}', [ResultsController::class,'delete_res_all_quiz'])->name('.delete_res_all_quiz'); */
        Route::post('/deleteall', [ResultsController::class, 'deleteall'])->name('.delete_all');

    });
});
