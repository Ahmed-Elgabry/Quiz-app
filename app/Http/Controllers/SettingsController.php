<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Models\CommonQuestions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    //
    public function setting()
    {
        return view('pages.admin.settings')->with('Settings', Settings::first());
    }
    public function do_setting(Request $request)
    {
        $rules = array(
            "sitename_ar" => "required",
            "sitename_en" => "required",
            "description_ar" => "required",
            "aboutUs_text_ar" => "required",
            "aboutUs_text_en" => "required",
            "aboutUs_Articles_text_ar" => "required",
            "aboutUs_Articles_text_en" => "required",
            "description_en" => "required",
            "email" => "email|nullable",
            "logo" => "image",
            'mobile'       => 'numeric|nullable',
            'address'      => 'sometimes|nullable',
            'facebook'     => 'sometimes|nullable|url',
            'twitter'      => 'sometimes|nullable|url',
            'snapshat'      => 'sometimes|nullable|url',
            'instagram'      => 'sometimes|nullable|url',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array(
                'error' => $validator->getMessageBag()->toArray()
            ));
        }
        $setting = Settings::first();
        $setting->sitename_ar = $request->input('sitename_ar');
        $setting->sitename_en = $request->input('sitename_en');
        $setting->email = $request->input('email');
        $setting->mobile = $request->input('mobile');
        $setting->facebook = $request->input('facebook');
        $setting->twitter = $request->input('twitter');
        $setting->snapshat = $request->input('snapshat');
        $setting->instagram = $request->input('instagram');
        $setting->description_ar = $request->input('description_ar');
        $setting->description_en = $request->input('description_en');
        $setting->aboutUs_text_ar = $request->input('aboutUs_text_ar');
        $setting->aboutUs_text_en = $request->input('aboutUs_text_en');
        $setting->aboutUs_Articles_text_ar = $request->input('aboutUs_Articles_text_ar');
        $setting->aboutUs_Articles_text_en = $request->input('aboutUs_Articles_text_en');

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $path = $logo->storeAs('images', basename($setting->logo), 'public');
            $setting->logo =  $path;
        }

        $setting->save();
        return response()->json($setting);
    }

    public function common_questions_index()
    {
        if (request()->expectsJson()) {
            $func = 'arraySearchCommonQuestion';
            $common_questions_ = CommonQuestions::where('id', '!=', 0);
            $common_questions = CommonQuestions::scopeMetronicPaginate($common_questions_, $func);
            return response()->json($common_questions);
        }
        return view('pages.admin.commonquestions');
    }
    public function common_questions_create()
    {
        return view('pages.admin.create_commonquestions');
    }

    public function common_questions_store(Request $request)
    {
        $rules = array(
            "question" => 'required',
            "answer" => 'required',
            "language" => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array(
                'error' => $validator->getMessageBag()->toArray()
            ));
        }
        $CommonQuestion = new CommonQuestions();
        $CommonQuestion->question = $request->input('question');
        $CommonQuestion->answer    = $request->input('answer');
        $CommonQuestion->is_arabic    = $request->input('language');
        $CommonQuestion->save();
        return response()->json($CommonQuestion);
    }

    public function common_questions_edit($id)
    {
        $CommonQuestion = CommonQuestions::findorFail($id);
        return view('pages.admin.common_questions_edit')->with('CommonQuestion', $CommonQuestion);
    }

    public function common_questions_update(Request $request, $id)
    {
        $rules = array(
            "question" => 'required',
            "answer" => 'required',
            "language" => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array(
                'error' => $validator->getMessageBag()->toArray()
            ));
        }

        $this->validate($request, [ //this request comes from the form

        ]);

        $CommonQuestion = CommonQuestions::findorFail($id);
        $CommonQuestion->question = $request->input('question');
        $CommonQuestion->answer    = $request->input('answer');
        $CommonQuestion->is_arabic    = $request->input('language');
        $CommonQuestion->save();
        return response()->json($CommonQuestion);
    }

    public function destroy_common_questions($id)
    {
        $cq = CommonQuestions::findOrFail($id);
        if (!empty($cq)) {
            CommonQuestions::destroy($id);
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }
        return response()->json($data);
    }

    public function destroyall_common_questions(Request $request)
    {
        $ids = $_POST['id'];
        if (!empty($ids)) {
            foreach ($ids as $item) {
                CommonQuestions::destroy($item);
            }
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }
        return response()->json($data);
    }


    public function privacy_policy()
    {
        return view('pages.admin.privacy_policy')->with('policy_ar', Settings::first()->policy_ar)
            ->with('policy_en', Settings::first()->policy_en);
    }

    public function do_privacy_policy(Request $request)
    {
        $rules = array(
            "policy_ar" => "required",
            "policy_en" => "required"
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array(
                'error' => $validator->getMessageBag()->toArray()
            ));
        }
        $setting = Settings::first();

        $setting->policy_ar = $request->input('policy_ar');
        $setting->policy_en = $request->input('policy_en');
        $setting->save();
        return response()->json($setting);
    }

    public function terms_of_service()
    {
        return view('pages.admin.terms_of_service')->with('terms_ar', Settings::first()->terms_ar)
            ->with('terms_en', Settings::first()->terms_en);
    }

    public function do_terms_of_service(Request $request)
    {

        $rules = array(
            "terms_ar" => "required",
            "terms_en" => "required"
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array(
                'error' => $validator->getMessageBag()->toArray()
            ));
        }

        $setting = Settings::first();
        $setting->terms_ar = $request->input('terms_ar');
        $setting->terms_en = $request->input('terms_en');
        $setting->save();
        return response()->json($setting);
    }
}
