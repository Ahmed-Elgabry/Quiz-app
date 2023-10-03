<?php

namespace App\Http\Controllers;

use App\Models\CommonQuestions;
use App\Models\QuickAnswers;
use App\Models\QuickOptions;
use App\Models\QuickQuestions;
use App\Models\QuickQuiz;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class QuickQuizController extends Controller
{
    public function createSlug($title, $id = 0)
    {
        //  $str = str_slug($title);
        $string = trim($title);
        $separator = '-';

        $string = mb_strtolower($string, "UTF-8");;

        $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);

        $string = preg_replace("/[\s-]+/", " ", $string);

        $string = preg_replace("/[\s_]/", $separator, $string);

        $str = $string;


        if (substr_count($str, '-') > 1) {;
            $y = 0;
            $z = 0;
            for ($i = 0; $i <= strlen($str); $i++) {
                if ($y <= 1) {
                    if ($str[$i] == '-') {
                        $y++;
                        $z = $i;
                    }
                }
            }
            $slug = substr($str, 0, $z);
        } else {
            $slug = $str;
        }
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }
        for ($i = 1; $i != 0; $i++) {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return QuickQuiz::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }

    //for answers name
    public function createAnswerSlug($title, $id = 0)
    {
        //  $str = str_slug($title);
        $string = trim($title);
        $separator = '-';

        $string = mb_strtolower($string, "UTF-8");;

        $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);

        $string = preg_replace("/[\s-]+/", " ", $string);

        $string = preg_replace("/[\s_]/", $separator, $string);

        $str = $string;


        if (substr_count($str, '-') > 1) {;
            $y = 0;
            $z = 0;
            for ($i = 0; $i <= strlen($str); $i++) {
                if ($y <= 1) {
                    if ($str[$i] == '-') {
                        $y++;
                        $z = $i;
                    }
                }
            }
            $slug = substr($str, 0, $z);
        } else {
            $slug = $str;
        }
        $allSlugs = $this->getRelatedAnswerSlugs($slug, $id);
        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }
        for ($i = 1; $i != 0; $i++) {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
    }
    protected function getRelatedAnswerSlugs($slug, $id = 0)
    {
        return QuickAnswers::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }

    public function create($name, $lang = 'ar')
    {
        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {
            return view('pages.QuickQuizzes.create')->with('name', $name);
        } else {
            abort(404);
        }
    }

    public function store(Request $request)
    {
        $question_type = $request->input('type_q');

        if ($question_type == 'm') {
            $rules = array(
                "quiz_name" => 'required',
                "question_text" => 'required|max:255',
                "question_img" => 'image',
                'option_m.*' => 'required|max:255',
                'option_weight.*' => 'nullable|numeric|min:0',
            );
        } else {
            $rules = array(
                "quiz_name" => 'required',
                "question_text" => 'required|max:255',
                "question_img" => 'image',
                'option_s.*' => 'required|max:255',
            );
        }


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array(
                'error' => $validator->getMessageBag()->toArray()
            ));
        }

        $quiz = new QuickQuiz();
        $quiz->quiz_name = $request->input('quiz_name');
        $quiz->slug = $this->createSlug($request->input('quiz_name'));
        $quiz->grade = 0;
        $quiz->owner_name = $request->input('owner_name');
        $quiz->save();

        if (!is_null($request->input('question_text'))) {
            $question = new QuickQuestions();
            //question Image
            if ($request->hasFile('question_img')) {
                $path = $request->file('question_img')->store('questions', 'public');
                Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
                $question->question_img =  $path;
            } else {
                $question->question_img =  null;
            }
            $question->question_text = $request->input('question_text');
            $question->quiz_id = $quiz->id;
            $question->type = $question_type;
            $question->save();

            if ($question_type == 'm') {
                // add options
                $counter = count($_POST["option_m"]);
                for ($i = 0; $i < $counter; $i++) {
                    if (trim($_POST["option_m"][$i] != '')) {
                        $option = new QuickOptions();
                        $option->option_text = $_POST["option_m"][$i];
                        if ($_POST["option_weight"][$i]) {
                            $option->weight = $_POST["option_weight"][$i];
                        }
                        $option->question_id  = $question->id;
                        $option->save();
                    }
                }
            } else {
                // add options
                $counter = count($_POST["option_s"]);
                for ($i = 0; $i < $counter; $i++) {
                    if (trim($_POST["option_s"][$i] != '')) {
                        $option = new QuickOptions();
                        $option->option_text = $_POST["option_s"][$i];
                        $option->weight = 0;
                        $option->question_id  = $question->id;
                        $option->save();
                    }
                }
            }

            //edit grade
            $quiz_edit_grade =  QuickQuiz::where('id', $quiz->id)->first();
            $qu = $quiz_edit_grade->questions;
            $a = [];
            $b = [];
            $counter = 0;
            foreach ($qu as $item) {
                if ($item->type = 'm') {
                    $op = $item->options;
                    for ($i = 0; $i < $item->options->count(); $i++) {
                        $a[$i] = $op[$i]->weight;
                    }
                    if ($counter < $quiz_edit_grade->questions->count()) {
                        $b[$counter] = max($a);
                        $counter++;
                    }
                    for ($z = 0; $z < count($a); $z++) {
                        $a[$z] = 0;
                    }
                }
            }

            $quiz_edit_grade->grade = array_sum($b);
            $quiz_edit_grade->save();
        }
        return response()->json($quiz->slug);
    }

    public function create_survey($name, $lang = 'ar')
    {
        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {
            return view('pages.QuickQuizzes.survey.create')->with('name', $name);
        } else {
            abort(404);
        }
    }

    public function create_survey_next_question($slug, $lang = 'ar')
    {
        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {
            $quiz = QuickQuiz::where('slug', $slug)->first();
            $counter = QuickQuestions::where('quiz_id', $quiz->id)->count();
            return view('pages.QuickQuizzes.survey.next_question')->with('quiz', $quiz)->with('counter', $counter)->with('name', $quiz->owner_name);
        } else {
            abort(404);
        }
    }

    public function create_multiple($name, $lang = 'ar')
    {
        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {
            return view('pages.QuickQuizzes.multiple.create')->with('name', $name);
        } else {
            abort(404);
        }
    }

    public function create_multiple_next_question($slug, $lang = 'ar')
    {
        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {
            $quiz = QuickQuiz::where('slug', $slug)->first();
            $counter = QuickQuestions::where('quiz_id', $quiz->id)->count();
            return view('pages.QuickQuizzes.multiple.next_question')->with('quiz', $quiz)->with('counter', $counter)->with('name', $quiz->owner_name);
        } else {
            abort(404);
        }
    }

    public function create_next_question($slug, $lang = 'ar')
    {
        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {
            $quiz = QuickQuiz::where('slug', $slug)->first();
            $counter = QuickQuestions::where('quiz_id', $quiz->id)->count();
            return view('pages.QuickQuizzes.next_question')->with('quiz', $quiz)->with('counter', $counter)->with('name', $quiz->owner_name);
        } else {
            abort(404);
        }
    }

    public function store_next_question(Request $request, $id)
    {
        $quiz = QuickQuiz::findorFail($id);
        $question_type = $request->input('type_q');

        if ($question_type == 'm') {
            $rules = array(
                "question_text" => 'required|max:255',
                "question_img" => 'image',
                'option_m.*' => 'required|max:255',
                'option_weight.*' => 'nullable|numeric|min:0',
            );
        } else {
            $rules = array(
                "question_text" => 'required|max:255',
                "question_img" => 'image',
                'option_s.*' => 'required|max:255',
            );
        }


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array(
                'error' => $validator->getMessageBag()->toArray()
            ));
        }

        if (!is_null($request->input('question_text'))) {
            $question = new QuickQuestions();
            //question Image
            if ($request->hasFile('question_img')) {
                $path = $request->file('question_img')->store('questions', 'public');
                Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
                $question->question_img =  $path;
            } else {
                $question->question_img =  null;
            }
            $question->question_text = $request->input('question_text');
            $question->quiz_id = $quiz->id;
            $question->type = $question_type;
            $question->save();

            if ($question_type == 'm') {
                // add options
                $counter = count($_POST["option_m"]);
                for ($i = 0; $i < $counter; $i++) {
                    if (trim($_POST["option_m"][$i] != '')) {
                        $option = new QuickOptions();
                        $option->option_text = $_POST["option_m"][$i];
                        if ($_POST["option_weight"][$i]) {
                            $option->weight = $_POST["option_weight"][$i];
                        }
                        $option->question_id  = $question->id;
                        $option->save();
                    }
                }
            } else {
                // add options
                $counter = count($_POST["option_s"]);
                for ($i = 0; $i < $counter; $i++) {
                    if (trim($_POST["option_s"][$i] != '')) {
                        $option = new QuickOptions();
                        $option->option_text = $_POST["option_s"][$i];
                        $option->weight = 0;
                        $option->question_id  = $question->id;
                        $option->save();
                    }
                }
            }

            //edit grade
            $quiz_edit_grade =  QuickQuiz::where('id', $quiz->id)->first();
            $qu = $quiz_edit_grade->questions;
            $a = [];
            $b = [];
            $counter = 0;
            foreach ($qu as $item) {
                if ($item->type = 'm') {
                    $op = $item->options;
                    for ($i = 0; $i < $item->options->count(); $i++) {
                        $a[$i] = $op[$i]->weight;
                    }
                    if ($counter < $quiz_edit_grade->questions->count()) {
                        $b[$counter] = max($a);
                        $counter++;
                    }
                    for ($z = 0; $z < count($a); $z++) {
                        $a[$z] = 0;
                    }
                }
            }

            $quiz_edit_grade->grade = array_sum($b);
            $quiz_edit_grade->save();
        }
        return response()->json($quiz->slug);
    }

    public function quick_access($slug, $lang = 'ar')
    {
        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {
            $quiz = QuickQuiz::where('slug', $slug)->first();
            return view('pages.QuickQuizzes.quick_access')->with('quiz', $quiz);
        } else {
            abort(404);
        }
    }

    public function share_quiz($slug, $lang = 'ar')
    {

        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {
            $quiz = QuickQuiz::where('slug', '=', $slug)->first();
            if (!is_null($quiz)) {
                $name = $quiz->owner_name;

                if ($name) {
                    $name = $name;
                } else {
                    if ($lang == 'ar') {
                        $name = "غير معروف";
                    } else {
                        $name = "unknow";
                    }
                }
                return view('pages.QuickQuizzes.share')
                    ->with('name', $name)
                    ->with('quiz', $quiz);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function settings_quiz($slug, $lang = 'ar')
    {

        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {
            $quiz = QuickQuiz::where('slug', '=', $slug)->first();
            if (!is_null($quiz)) {

                return view('pages.QuickQuizzes.settings')->with('quiz', $quiz);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function do_settings_quiz(Request $request, $slug)
    {
        $quiz = QuickQuiz::where('slug', '=', $slug)->first();
        if (!is_null($quiz)) {
            if ($request->input('hide_score_counter')) {
                $quiz->hide_result_counter = 1;
            } else {
                $quiz->hide_result_counter = 0;
            }

            $quiz->result_text = $request->input('result_text');
            $quiz->save();
            return redirect()->back()->with('success', __("Quick Quiz Settings Updated successfully !"));
        } else {
            abort(404);
        }
    }

    public function start_test(Request $request, $slug, $lang = 'ar')
    {
        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {
            $quiz = QuickQuiz::where('slug', '=', $slug)->first();
            if ($quiz) {
                $questions = QuickQuestions::where('quiz_id', $quiz->id)->simplePaginate(1);
                $questions_ = QuickQuestions::where('quiz_id', $quiz->id)->get();
                $counter = QuickQuestions::where('quiz_id', $quiz->id)->count();
                if ($request->ajax()) {
                    return view('pages.QuickQuizzes.start.start-test-ajax')
                        ->with('quiz', $quiz)
                        ->with('questions', $questions)
                        ->with('questions_', $questions_)
                        ->with('quiz_id', $quiz->id)
                        ->with('counter', $counter);
                }

                return view('pages.QuickQuizzes.start.start-test')
                    ->with('quiz', $quiz)
                    ->with('questions', $questions)
                    ->with('questions_', $questions_)
                    ->with('quiz_id', $quiz->id)
                    ->with('counter', $counter);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function store_answers(Request $request, $slug, $name, $ans, $lang)
    {

        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {


            $quiz = QuickQuiz::where('slug', '=', $slug)->first();
            if ($quiz) {
                $user_grade = 0;
                $ans_arr = explode(",", $ans);
                for ($i = 0; $i < count($ans_arr); $i++) {
                    if ($ans_arr[$i] != null) {
                        $quickOption = QuickOptions::where('id', $ans_arr[$i])->first();
                        if ($quickOption->question->type == 'm') {
                            $user_grade = $user_grade + $quickOption->weight;
                        }
                        if ($quickOption->question->type == 's') {
                            $quickOption->survey_counter = $quickOption->survey_counter + 1;
                            $quickOption->save();
                        }
                    }
                }

                // return $user_grade;
                $answer = new QuickAnswers();
                $answer->name = $name;
                $answer->slug = $this->createAnswerSlug($name);
                $answer->options = $ans;
                $answer->results = $user_grade;
                $answer->quiz_id = $quiz->id;
                $answer->save();

                return response()->json($answer);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function get_result($answer_slug, $lang = 'ar')
    {

        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {
            $answer = QuickAnswers::where('slug', $answer_slug)->first();
            $quiz = QuickQuiz::where('id', '=', $answer->quiz_id)->first();
            $survey_questions = $quiz->questions->where('type', 's');
            $survey_questions_counter = $quiz->questions->where('type', 's')->count();

            if ($answer) {
                return view('pages.QuickQuizzes.results.user_result')->with('quiz', $quiz)
                    ->with('answer', $answer)
                    ->with('survey_questions', $survey_questions)
                    ->with('survey_questions_counter', $survey_questions_counter)
                    ->with('lang', $lang);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function get_results($slug, $lang = 'ar')
    {

        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {
            $quiz = QuickQuiz::where('slug', '=', $slug)->first();
            if ($quiz) {
                $name = request()->query('name', ''); //input()
                $status = request()->query('status', ''); //input()
                if ($status == "lower") {
                    $results = QuickAnswers::orderBy('results', 'ASC')
                        ->where('quiz_id', $quiz->id)
                        ->where('name', 'like',  '%' . request('name') . '%')
                        ->oldest()->paginate(20);
                } elseif ($status == "higher") {
                    $results = QuickAnswers::orderBy('results', 'DESC')
                        ->where('quiz_id', $quiz->id)
                        ->where('name', 'like',  '%' . request('name') . '%')
                        ->oldest()->paginate(20);
                } elseif ($status == "newest") {
                    $results = QuickAnswers::where('quiz_id', $quiz->id)
                        ->where('name', 'like',  '%' . request('name') . '%')
                        ->latest()->paginate(20);
                } else {
                    $results = QuickAnswers::where('quiz_id', $quiz->id)
                        ->where('name', 'like',  '%' . request('name') . '%')
                        ->oldest()->paginate(20);
                }
                return view('pages.QuickQuizzes.results.all_result')->with('quiz', $quiz)
                    ->with('lang', $lang)
                    ->with('name', $name)
                    ->with('status', $status)
                    ->with('results', $results);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function get_option_info($id)
    {
        $options_texts = [];
        $options_survey_counter = [];
        $item = QuickQuestions::where('id', $id)->first();
        $op = $item->options;
        for ($i = 0; $i < $item->options->count(); $i++) {
            $options_texts[$i] = $op[$i]->option_text;
            $options_survey_counter[$i] = $op[$i]->survey_counter;
        }
        return response()->json(['options_texts' => $options_texts, 'options_survey_counter' => $options_survey_counter]);
    }
}
