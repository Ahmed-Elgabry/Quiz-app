<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\Validator;

class AdsController extends Controller
{
    //
    public function ads()
    {
        return view('pages.admin.ads')->with('Ads', Ads::first());
    }

    public function do_ads(Request $request)
    {
        $rules = array(
            "Home1" => "nullable",
            "Home2" => "nullable",
            "quizzes1" => "nullable",
            "quizzes2" => "nullable",
            "articles1" => "nullable",
            "articles2" => "nullable",
            "view_article1" => "nullable",
            "view_article2" => "nullable",
            "view_article3" => "nullable",
            "do_quiz1" => "nullable",
            "do_quiz2" => "nullable",
            "quick_access1" => "nullable",
            "quick_access2" => "nullable",
            "results1" => "nullable",
            "results2" => "nullable",
            "share_quiz1" => "nullable",
            "share_quiz2" => "nullable",
            "guest_result1" => "nullable",
            "guest_result2" => "nullable",
            "about1" => "nullable",
            "contact1" => "nullable"
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array(
                'error' => $validator->getMessageBag()->toArray()
            ));
        }

        $Ads = Ads::first();

        $Ads->Home1 = $request->input('Home1');
        $Ads->Home2 = $request->input('Home2');

        $Ads->quizzes1 = $request->input('quizzes1');
        $Ads->quizzes2 = $request->input('quizzes2');

        $Ads->articles1 = $request->input('articles1');
        $Ads->articles2 = $request->input('articles2');

        $Ads->view_article1 = $request->input('view_article1');
        $Ads->view_article2 = $request->input('view_article2');
        $Ads->view_article3 = $request->input('view_article3');

        $Ads->do_quiz1 = $request->input('do_quiz1');
        $Ads->do_quiz2 = $request->input('do_quiz2');

        $Ads->quick_access1 = $request->input('quick_access1');
        $Ads->quick_access2 = $request->input('quick_access2');

        $Ads->results1 = $request->input('results1');
        $Ads->results2 = $request->input('results2');

        $Ads->share_quiz1 = $request->input('share_quiz1');
        $Ads->share_quiz2 = $request->input('share_quiz2');

        $Ads->guest_result1 = $request->input('guest_result1');
        $Ads->guest_result2 = $request->input('guest_result2');

        $Ads->about1 = $request->input('about1');
        $Ads->contact1 = $request->input('contact1');



        $Ads->save();
        return response()->json($Ads);

        /* return redirect()->back()->with('message_flash', sprintf(__('Ads Uppdated!'))); */
    }
}
