<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserAnswers;
use App\Models\UserOptions;
use App\Models\UserQuestions;
use App\Models\UserQuiz;
use App\Models\userQuiz_optios_order;
use App\Models\User;
use App\Models\Settings;
use App\Models\ResultOrder;
use App\Models\CategoryQuiz;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class QuizController extends Controller
{
    public function makeSlugforQuizzess(){
        $quizzes = UserQuiz::where('slug',null)->take(10)->get();
        if($quizzes->count() > 0){
            foreach($quizzes as $item){
                $item->slug = $this->createSlug($item->quiz_name);
                $item->save();
            }
            return 'Done';

        }else{
            return 'Stop';
        }
    }

    public function makeSlugforAnswers(){
        $answers = UserAnswers::where('slug',null)->take(10)->get();
        if($answers->count() > 0){
            foreach($answers as $item){
                $item->slug = $this->createAnswerSlug($item->name);
                $item->save();
            }
            return 'Done';

        }else{
            return 'Stop';
        }
    }

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
        return UserQuiz::select('slug')->where('slug', 'like', $slug . '%')
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
        return UserAnswers::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }




    public function index()
    {
        // return $quizzes_ = UserQuiz::where('user_id',auth()->user()->id)->with('ResultOrder')->get();
        if (request()->expectsJson()) {
            $func = 'arraySearchUserQuiz';
            $quizzes_ = UserQuiz::where('user_id', auth()->user()->id)->with('ResultOrder');
            $quizzes = UserQuiz::scopeMetronicPaginate($quizzes_, $func);
            return response()->json($quizzes);
        }
        return view('pages.user.quiz.index');
    }

    public function showQuiz($id)
    {
        $quiz  =  UserQuiz::find($id);
        return response()->json($quiz);
    }

    public function index_all()
    {
        //return $quizzes_ = UserQuiz::with('ResultOrder')->with('user')->with('Category')->get();
        if (request()->expectsJson()) {
            $func = 'arraySearchAdminUserQuiz';
            $quizzes_ = UserQuiz::with('ResultOrder')->with('user')->with('Category');
            $quizzes = UserQuiz::scopeMetronicPaginate($quizzes_, $func);
            return response()->json($quizzes);
        }
        return view('pages.admin.usersquizzes');
    }

    public function featured(Request $request, $id)
    {
        $quiz = UserQuiz::findorFail($id);
        if (!empty($quiz)) {
            if ($quiz->is_featured == true) {
                $quiz->is_featured = false;
                $quiz->featured_at =  null;
                $data['msg'] =  'success2';
            } else {
                $quiz->is_featured = true;
                $quiz->featured_at = Carbon::now();
                $data['msg'] =  'success1';
                if($quiz->lang == ''){
                    $quiz->lang = App::currentLocale();
                }
            }
            $quiz->save();
        } else {
            $data['msg'] = 'error';
        }
        return response()->json($data);
    }


    public function destroy_admin($id)
    {
        $quiz = UserQuiz::findorFail($id);
        if (!empty($quiz)) {
            UserQuiz::destroy($id);
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }
        return response()->json($data);
    }

    public function getSelectCategory(Request $request)
    {

        if ($request->ajax()) {
            $term = trim($request->term);
            $cates = CategoryQuiz::select('id', 'name as text')
                                                            ->where('name', 'LIKE',  '%' . $term . '%')
                                                            ->orderBy('name', 'asc')->simplePaginate(5);

            $morePages = true;
            // $pagination_obj= json_encode($countries);
            if (empty($cates->nextPageUrl())) {
                $morePages = false;
            }
            $results = array(
                "results" => $cates->items(),
                "pagination" => array("more" => $morePages)
            );
            return response()->json($results);
        }
    }

    public function create()
    {
        return view('pages.user.quiz.create');
    }

    public function store(Request $request)
    {
        //validation
        $rules = array(
            "quiz_name" => 'required',
            "quiz_img" => 'image',
            "question_text_1" => 'required|max:255',
            "question_img_1" => 'image',
            "option1_text_1" => 'max:255',
            "option2_text_1" => 'max:255',
            "option3_text_1" => 'max:255',
            "option4_text_1" => 'max:255',
            "option1_img_1" => 'image',
            "option2_img_1" => 'image',
            "option3_img_1" => 'image',
            "option4_img_1" => 'image',
            "option1_weight" => 'nullable|numeric|min:0',
            "option2_weight" => 'nullable|numeric|min:0',
            "option3_weight" => 'nullable|numeric|min:0',
            "option4_weight" => 'nullable|numeric|min:0'
        );

        $validator = Validator::make($request->all(), $rules);
        $validator2 = Validator::make($request->all(), ["option1_text_1" => 'required|max:255']);
        $validator3 = Validator::make($request->all(), ["option2_text_1" => 'required|max:255']);
        $validator4 = Validator::make($request->all(), ["option3_text_1" => 'required|max:255']);
        $validator5 = Validator::make($request->all(), ["option4_text_1" => 'required|max:255']);

        if ($validator->fails()) {
            return response()->json(array('error' => $validator->getMessageBag()->toArray()));
        } else {

            if ((is_null($request->input('option1_text_1')) && !($request->hasFile('option1_img_1')))
                || ($request->input('option1_weight') && is_null($request->input('option1_text_1')) && !($request->hasFile('option1_img_1')))
            ) {

                return response()->json(array('error' => $validator2->getMessageBag()->toArray()));
            }

            if ((is_null($request->input('option2_text_1')) && !($request->hasFile('option2_img_1')))
                || ($request->input('option2_weight') && is_null($request->input('option2_text_1')) && !($request->hasFile('option2_img_1')))
            ) {
                return response()->json(array('error' => $validator3->getMessageBag()->toArray()));
            }

            if ($request->input('option3_weight') && is_null($request->input('option3_text_1')) && !($request->hasFile('option3_img_1'))) {
                return response()->json(array('error' => $validator4->getMessageBag()->toArray()));
            }

            if ($request->input('option4_weight') && is_null($request->input('option4_text_1')) && !($request->hasFile('option4_img_1'))) {
                return response()->json(array('error' => $validator5->getMessageBag()->toArray()));
            }

            $g_q = new UserQuiz();
            if ($request->hasFile('quiz_img')) {
                $path = $request->file('quiz_img')->store('images', 'public');
                Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
                $g_q->quiz_img =  $path;
            }
            $g_q->quiz_name = $request->input('quiz_name');
            $g_q->slug = $this->createSlug($request->input('quiz_name'));
            $g_q->grade = 0;
            $g_q->user_id = auth()->user()->id;
            $g_q->save();

            if (!is_null($request->input('question_text_1'))) {
                $question = new UserQuestions();
                //question Image
                if ($request->hasFile('question_img_1')) {
                    $path = $request->file('question_img_1')->store('questions', 'public');
                    Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
                    $question->question_img =  $path;
                } else {
                    $question->question_img =  null;
                }
                $question->question_text = $request->input('question_text_1');
                $question->quiz_id = $g_q->id;
                $question->save();

                //option 1
                if (!is_null($request->input('option1_text_1')) || $request->hasFile('option1_img_1')) {
                    $option1 = new UserOptions();
                    $option1->option_text = $request->input('option1_text_1');
                    //option 1 Image
                    if ($request->hasFile('option1_img_1')) {
                        $path = $request->file('option1_img_1')->store('questions', 'public');
                        Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
                        $option1->option_img =  $path;
                    } else {
                        $option1->option_img =  null;
                    }
                    $option1->question_id =  $question->id;
                    $option1->is_right =  true;
                    if (!is_null($request->input('option1_weight'))) {
                        $option1->weight =  $request->input('option1_weight');
                    } else {
                        $option1->weight = 0;
                    }
                    $option1->save();
                }
                //option 2
                if (!is_null($request->input('option2_text_1')) || $request->hasFile('option2_img_1')) {
                    $option2 = new UserOptions();
                    $option2->option_text = $request->input('option2_text_1');
                    //option 2 Image
                    if ($request->hasFile('option2_img_1')) {
                        $path = $request->file('option2_img_1')->store('questions', 'public');
                        Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
                        $option2->option_img =  $path;
                    } else {
                        $option2->option_img =  null;
                    }
                    $option2->question_id =  $question->id;
                    $option2->is_right =  false;
                    if (!is_null($request->input('option2_weight'))) {
                        $option2->weight =  $request->input('option2_weight');
                    } else {
                        $option2->weight = 0;
                    }
                    $option2->save();
                }
                //option3
                if (!is_null($request->input('option3_text_1')) || $request->hasFile('option3_img_1')) {
                    $option3 = new UserOptions();
                    $option3->option_text = $request->input('option3_text_1');
                    //option 3 Image
                    if ($request->hasFile('option3_img_1')) {
                        $path = $request->file('option3_img_1')->store('questions', 'public');
                        Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
                        $option3->option_img = $path;
                    } else {
                        $option3->option_img =  null;
                    }
                    $option3->question_id =  $question->id;
                    $option3->is_right =  false;
                    if (!is_null($request->input('option3_weight'))) {
                        $option3->weight =  $request->input('option3_weight');
                    } else {
                        $option3->weight = 0;
                    }
                    $option3->save();
                }
                //option4
                if (!is_null($request->input('option4_text_1')) || $request->hasFile('option4_img_1')) {
                    $option4 = new UserOptions();
                    $option4->option_text = $request->input('option4_text_1');
                    //option 4 Image
                    if ($request->hasFile('option4_img_1')) {
                        $path = $request->file('option4_img_1')->store('questions', 'public');
                        Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
                        $option4->option_img = $path;
                    } else {
                        $option4->option_img =  null;
                    }
                    $option4->question_id =  $question->id;
                    $option4->is_right =  false;
                    if (!is_null($request->input('option4_weight'))) {
                        $option4->weight =  $request->input('option4_weight');
                    } else {
                        $option4->weight = 0;
                    }
                    $option4->save();
                }

                $quiz_edit_grade =  UserQuiz::find($g_q->id);
                $qu = $quiz_edit_grade->questions;
                $a = [];
                $b = [];
                $counter = 0;

                foreach ($qu as $item) {
                    $op = $item->options;
                    for ($i = 0; $i < $item->options->count(); $i++) {
                        $a[$i] = $op[$i]->weight;
                    }
                    if ($counter < $quiz_edit_grade->questions->count()) {
                        $b[$counter] = max($a);
                        $counter++;
                    }
                    $a[0] = 0;
                    $a[1] = 0;
                    $a[2] = 0;
                    $a[3] = 0;
                }

                $quiz_edit_grade->grade = array_sum($b);
                $quiz_edit_grade->save();
            }

            return response()->json($quiz_edit_grade->id);
        }
    }

    public function create_next_question($id)
    {
        $quiz = UserQuiz::findorFail($id);
        if (Auth::id() == $quiz->user_id) {
            // valid user
            $counter = UserQuestions::where('quiz_id', $id)->count();
            return view('pages.user.quiz.next_question')->with('quiz', $quiz)->with('counter', $counter);
        } else {
            abort(404);
        }
    }

    public function store_next_question(Request $request, $id)
    {
        //validation
        $rules = array(
            "question_text" => 'required|max:255',
            "question_img" => 'image',
            "option1_text" => 'max:255',
            "option2_text" => 'max:255',
            "option3_text" => 'max:255',
            "option4_text" => 'max:255',
            "option1_img" => 'image',
            "option2_img" => 'image',
            "option3_img" => 'image',
            "option4_img" => 'image',
            "option1_weight" => 'nullable|numeric|min:0',
            "option2_weight" => 'nullable|numeric|min:0',
            "option3_weight" => 'nullable|numeric|min:0',
            "option4_weight" => 'nullable|numeric|min:0'
        );

        $validator = Validator::make($request->all(), $rules);
        $validator2 = Validator::make($request->all(), ["option1_text" => 'required|max:255']);
        $validator3 = Validator::make($request->all(), ["option2_text" => 'required|max:255']);
        $validator4 = Validator::make($request->all(), ["option3_text" => 'required|max:255']);
        $validator5 = Validator::make($request->all(), ["option4_text" => 'required|max:255']);

        if ($validator->fails()) {
            return response()->json(array('error' => $validator->getMessageBag()->toArray()));
        } else {

            if ((is_null($request->input('option1_text')) && !($request->hasFile('option1_img')))
                || ($request->input('option1_weight') && is_null($request->input('option1_text')) && !($request->hasFile('option1_img')))
            ) {

                return response()->json(array('error' => $validator2->getMessageBag()->toArray()));
            }

            if ((is_null($request->input('option2_text')) && !($request->hasFile('option2_img')))
                || ($request->input('option2_weight') && is_null($request->input('option2_text')) && !($request->hasFile('option2_img')))
            ) {
                return response()->json(array('error' => $validator3->getMessageBag()->toArray()));
            }

            if ($request->input('option3_weight') && is_null($request->input('option3_text')) && !($request->hasFile('option3_img'))) {
                return response()->json(array('error' => $validator4->getMessageBag()->toArray()));
            }

            if ($request->input('option4_weight') && is_null($request->input('option4_text')) && !($request->hasFile('option4_img'))) {
                return response()->json(array('error' => $validator5->getMessageBag()->toArray()));
            }



            $quiz = UserQuiz::findorFail($id);
            if (Auth::id() == $quiz->user_id) {

                if (!is_null($request->input('question_text'))) {
                    $question = new UserQuestions();
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
                    $question->save();

                    //option 1
                    if (!is_null($request->input('option1_text')) || $request->hasFile('option1_img')) {
                        $option1 = new UserOptions();
                        $option1->option_text = $request->input('option1_text');
                        //option 1 Image
                        if ($request->hasFile('option1_img')) {
                            $path = $request->file('option1_img')->store('questions', 'public');
                            Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
                            $option1->option_img =  $path;
                        } else {
                            $option1->option_img =  null;
                        }
                        $option1->question_id =  $question->id;
                        $option1->is_right =  true;
                        if (!is_null($request->input('option1_weight'))) {
                            $option1->weight =  $request->input('option1_weight');
                        } else {
                            $option1->weight = 0;
                        }
                        $option1->save();
                    }
                    //option 2
                    if (!is_null($request->input('option2_text')) || $request->hasFile('option2_img')) {
                        $option2 = new UserOptions();
                        $option2->option_text = $request->input('option2_text');
                        //option 2 Image
                        if ($request->hasFile('option2_img')) {
                            $path = $request->file('option2_img')->store('questions', 'public');
                            Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
                            $option2->option_img =  $path;
                        } else {
                            $option2->option_img =  null;
                        }
                        $option2->question_id =  $question->id;
                        $option2->is_right =  false;
                        if (!is_null($request->input('option2_weight'))) {
                            $option2->weight =  $request->input('option2_weight');
                        } else {
                            $option2->weight = 0;
                        }
                        $option2->save();
                    }
                    //option3
                    if (!is_null($request->input('option3_text')) || $request->hasFile('option3_img')) {
                        $option3 = new UserOptions();
                        $option3->option_text = $request->input('option3_text');
                        //option 3 Image
                        if ($request->hasFile('option3_img')) {
                            $path = $request->file('option3_img')->store('questions', 'public');
                            Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
                            $option3->option_img =  $path;
                        } else {
                            $option3->option_img =  null;
                        }
                        $option3->question_id =  $question->id;
                        $option3->is_right =  false;
                        if (!is_null($request->input('option3_weight'))) {
                            $option3->weight =  $request->input('option3_weight');
                        } else {
                            $option3->weight = 0;
                        }
                        $option3->save();
                    }
                    //option4
                    if (!is_null($request->input('option4_text')) || $request->hasFile('option4_img')) {
                        $option4 = new UserOptions();
                        $option4->option_text = $request->input('option4_text');
                        //option 4 Image
                        if ($request->hasFile('option4_img')) {
                            $path = $request->file('option4_img')->store('questions', 'public');
                            Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
                            $option4->option_img =  $path;
                        } else {
                            $option4->option_img =  null;
                        }
                        $option4->question_id =  $question->id;
                        $option4->is_right =  false;
                        if (!is_null($request->input('option4_weight'))) {
                            $option4->weight =  $request->input('option4_weight');
                        } else {
                            $option4->weight = 0;
                        }
                        $option4->save();
                    }

                    $quiz_edit_grade =  UserQuiz::find($quiz->id);
                    $qu = $quiz_edit_grade->questions;
                    $a = [];
                    $b = [];
                    $counter = 0;

                    foreach ($qu as $item) {
                        $op = $item->options;
                        for ($i = 0; $i < $item->options->count(); $i++) {
                            $a[$i] = $op[$i]->weight;
                        }
                        if ($counter < $quiz_edit_grade->questions->count()) {
                            $b[$counter] = max($a);
                            $counter++;
                        }
                        $a[0] = 0;
                        $a[1] = 0;
                        $a[2] = 0;
                        $a[3] = 0;
                    }

                    $quiz_edit_grade->grade = array_sum($b);
                    $quiz_edit_grade->save();
                }
            }

            return response()->json($quiz_edit_grade->id);
        }
    }

    public function edit($id)
    {
        $quiz = UserQuiz::findorFail($id);
        if (Auth::id() == $quiz->user_id) {
            // valid user
            $questions = UserQuestions::where('quiz_id', $id)->get();
            $counter = UserQuestions::where('quiz_id', $id)->count();
            return view('pages.user.quiz.edit')->with('quiz', $quiz)
                ->with('questions', $questions)
                ->with('counter', $counter);
        } else {
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {

        $quiz = UserQuiz::findorFail($id);
        $questions = UserQuestions::where('quiz_id', $id)->get();
        //validation
        $rules = array(
            "quiz_name" => 'required',
            "quiz_img" => 'image',
            "option1_text_1" => 'max:255',
            "option2_text_1" => 'max:255',
            "question_text_1" => 'required|max:255',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('error' => $validator->getMessageBag()->toArray()));
        } else {

            if (Auth::id() == $quiz->user_id) {
                //Questions
                $questions = UserQuestions::where('quiz_id', $id)->get();
                $counter = UserQuestions::where('quiz_id', $id)->count();

                //for validation
                $i = 1;
                foreach ($questions as $question) {
                    $q = "question_text_" . $i;
                    $q_img = "question_img_" . $i;
                    $o1 = "option1_text_" . $i;
                    $o2 = "option2_text_" . $i;
                    $o3 = "option3_text_" . $i;
                    $o4 = "option4_text_" . $i;
                    $o1_img = "option1_img_" . $i;
                    $o2_img = "option2_img_" . $i;
                    $o3_img = "option3_img_" . $i;
                    $o4_img = "option4_img_" . $i;
                    $option1_i = "option1_" . $i;
                    $option2_i = "option2_" . $i;
                    $option3_i = "option3_" . $i;
                    $option4_i = "option4_" . $i;
                    $w1 = "option1_weight_" . $i;
                    $w2 = "option2_weight_" . $i;
                    $w3 = "option3_weight_" . $i;
                    $w4 = "option4_weight_" . $i;

                    $option1 = UserOptions::where('question_id', $question->id)->where('id', $request->input($option1_i))->first();
                    $option2 = UserOptions::where('question_id', $question->id)->where('id', $request->input($option2_i))->first();
                    $option3 = UserOptions::where('question_id', $question->id)->where('id', $request->input($option3_i))->first();
                    $option4 = UserOptions::where('question_id', $question->id)->where('id', $request->input($option4_i))->first();

                    $validator1 = Validator::make($request->all(), [$q => 'required|max:255']);
                    $validator2 = Validator::make($request->all(), [$o1 => 'required|max:255']);
                    $validator3 = Validator::make($request->all(), [$o2 => 'required|max:255']);
                    $validator4 = Validator::make($request->all(), [$o3 => 'required|max:255']);
                    $validator5 = Validator::make($request->all(), [$o4 => 'required|max:255']);

                    $test = Validator::make($request->all(), ["option4_weight_7" => 'nullable|numeric|min:0']);


                    if (is_null($request->input($q))) {
                        return response()->json(array('error' => $validator1->getMessageBag()->toArray()));
                    }

                    if (is_null($request->input($o1)) && is_null($option1->option_img)) {
                        if (!($request->hasFile($o1_img))) {
                            return response()->json(array('error' => $validator2->getMessageBag()->toArray()));
                        }
                    }

                    if (is_null($request->input($o2)) && is_null($option2->option_img)) {
                        if (!($request->hasFile($o2_img))) {
                            return response()->json(array('error' => $validator3->getMessageBag()->toArray()));
                        }
                    }

                    if ($option3) {
                        if (is_null($request->input($o3)) && is_null($option3->option_img)) {
                            if (!($request->hasFile($o3_img))) {
                                return response()->json(array('error' => $validator4->getMessageBag()->toArray()));
                            }
                        }
                    }

                    if ($option4) {
                        if (is_null($request->input($o4)) && is_null($option4->option_img)) {
                            if (!($request->hasFile($o4_img))) {
                                return response()->json(array('error' => $validator5->getMessageBag()->toArray()));
                            }
                        }
                    }
                    // add 1
                    $i++;
                }

                //quiz image
                if ($request->hasFile('quiz_img')) {
                    $path = $request->file('quiz_img')->store('images', 'public');
                    Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
                    $quiz->quiz_img =  $path;
                }
                $quiz->quiz_name = $request->input('quiz_name');
                $quiz->save();


                $i = 1;
                foreach ($questions as $question) {
                    $q = "question_text_" . $i;
                    $q_img = "question_img_" . $i;
                    $o1 = "option1_text_" . $i;
                    $o2 = "option2_text_" . $i;
                    $o3 = "option3_text_" . $i;
                    $o4 = "option4_text_" . $i;
                    $o1_img = "option1_img_" . $i;
                    $o2_img = "option2_img_" . $i;
                    $o3_img = "option3_img_" . $i;
                    $o4_img = "option4_img_" . $i;
                    $option1_i = "option1_" . $i;
                    $option2_i = "option2_" . $i;
                    $option3_i = "option3_" . $i;
                    $option4_i = "option4_" . $i;
                    $w1 = "option1_weight_" . $i;
                    $w2 = "option2_weight_" . $i;
                    $w3 = "option3_weight_" . $i;
                    $w4 = "option4_weight_" . $i;

                    $option1 = UserOptions::where('question_id', $question->id)->where('id', $request->input($option1_i))->first();
                    $option2 = UserOptions::where('question_id', $question->id)->where('id', $request->input($option2_i))->first();
                    $option3 = UserOptions::where('question_id', $question->id)->where('id', $request->input($option3_i))->first();
                    $option4 = UserOptions::where('question_id', $question->id)->where('id', $request->input($option4_i))->first();


                    //question Image
                    if ($request->hasFile($q_img)) {
                        $image = $request->file($q_img);
                        if (is_null($question->question_img)) {
                            $path = $image->store('images', 'public');
                            Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
                        } else {
                            $path = $image->storeAs('images', basename($question->question_img), 'public');
                            Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
                        }
                        $question->question_img =  $path;
                    }
                    $question->question_text = $request->input($q);
                    $question->save();

                    if ($option1) {
                        $option1->option_text = $request->input($o1);
                        $option1->is_right = true;
                        //option 1
                        if ($request->hasFile($o1_img)) {
                            $image = $request->file($o1_img);
                            if (is_null($option1->option_img)) {
                                $path = $image->store('images', 'public');
                                Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
                            } else {
                                $path = $image->storeAs('images', basename($question->question_img), 'public');
                                Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
                            }
                            $option1->option_img =  $path;
                        }

                        if (!is_null($request->input($w1))) {
                            $option1->weight =  $request->input($w1);
                        } else {
                            $option1->weight = 0;
                        }
                        $option1->save();
                    }


                    if ($option2) {
                        $option2->option_text = $request->input($o2);
                        $option2->is_right = false;
                        //option 2
                        if ($request->hasFile($o2_img)) {
                            $image = $request->file($o2_img);
                            if (is_null($option2->option_img)) {
                                $path = $image->store('images', 'public');
                                Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
                            } else {
                                $path = $image->storeAs('images', basename($option2->option_img), 'public');
                                Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
                            }
                            $option2->option_img =  $path;
                        }

                        if (!is_null($request->input($w2))) {
                            $option2->weight =  $request->input($w2);
                        } else {
                            $option2->weight = 0;
                        }
                        $option2->save();
                    }

                    if ($option3) {
                        $option3->option_text = $request->input($o3);
                        $option3->is_right = false;
                        //option 3
                        if ($request->hasFile($o3_img)) {
                            $image = $request->file($o3_img);
                            if (is_null($option3->option_img)) {
                                $path = $image->store('images', 'public');
                                Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
                            } else {
                                $path = $image->storeAs('images', basename($option3->option_img), 'public');
                                Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
                            }
                            $option3->option_img =  $path;
                        }

                        if (!is_null($request->input($w3))) {
                            $option3->weight =  $request->input($w3);
                        } else {
                            $option3->weight = 0;
                        }
                        $option3->save();
                    }

                    if ($option4) {
                        $option4->option_text = $request->input($o4);
                        $option4->is_right = false;
                        //option 4
                        if ($request->hasFile($o4_img)) {
                            $image = $request->file($o4_img);
                            if (is_null($option4->option_img)) {
                                $path = $image->store('images', 'public');
                                Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
                            } else {
                                $path = $image->storeAs('images', basename($option4->option_img), 'public');
                                Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
                            }
                            $option4->option_img =  $path;
                        }

                        if (!is_null($request->input($w4))) {
                            $option4->weight =  $request->input($w4);
                        } else {
                            $option4->weight = 0;
                        }
                        $option4->save();
                    }

                    // add 1
                    $i++;
                }

                $quiz_edit_grade =  UserQuiz::find($quiz->id);
                $qu = $quiz_edit_grade->questions;
                $a = [];
                $b = [];
                $counter = 0;
                foreach ($qu as $item) {
                    $op = $item->options;
                    for ($i = 0; $i < $item->options->count(); $i++) {
                        $a[$i] = $op[$i]->weight;
                    }
                    if ($counter < $quiz_edit_grade->questions->count()) {
                        $b[$counter] = max($a);
                        $counter++;
                    }
                    $a[0] = 0;
                    $a[1] = 0;
                    $a[2] = 0;
                    $a[3] = 0;
                }
                $quiz_edit_grade->grade = array_sum($b);
                $quiz_edit_grade->save();

                return response()->json($quiz_edit_grade->id);
            } else {
                abort(404);
            }
        }
    }

    public function destroy($id)
    {
        $quiz = UserQuiz::findorFail($id);
        if (!empty($quiz) && Auth::id() == $quiz->user_id) {
            UserQuiz::destroy($id);
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }
        return response()->json($data);
    }

    public function deleteall(Request $request)
    {
        $ids = $_POST['id'];
        if (!empty($ids)) {
            foreach ($ids as $item) {
                UserQuiz::destroy($item);
                // Article::destroy($item);
            }
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }
        return response()->json($data);
    }

    public function deleteall_shown_result(Request $request)
    {
        $ids = $_POST['id'];
        if (!empty($ids)) {
            foreach ($ids as $item) {
                ResultOrder::destroy($item);
            }
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }
        return response()->json($data);
    }


    public function delete_img_question($id)
    {
        $question = UserQuestions::findorFail($id);
        $quiz = UserQuiz::findorFail($question->quiz_id);
        if (Auth::id() == $quiz->user_id) {
            $question->question_img = null;
            $question->save();
            return redirect()->back()->with('success', __("Question Image deleted successfully !"));
        } else {
            abort(404);
        }
    }

    public function delete_img_option($id)
    {
        $option = UserOptions::findorFail($id);
        $question = UserQuestions::findorFail($option->question_id);
        $quiz = UserQuiz::findorFail($question->quiz_id);
        if (Auth::id() == $quiz->user_id) {

            if (!is_null($option->option_text)) {
                $option->option_img = null;
                $option->save();
                return redirect()->back()->with('success', __("Option Image deleted successfully !"));
            } else {
                if ($option->is_right) {
                    return redirect()->back()->with('error', __("The Option image cannot be deleted, because there is no text for option!"));
                } else {
                    return redirect()->back()->with('error', __("The Option image cannot be deleted, because there is no text for option! You can delete the option instead of that."));
                }
            }
        } else {
            abort(404);
        }
    }

    public function destroy_Question($id)
    {
        $question = UserQuestions::find($id);
        UserQuestions::destroy($id);
        $quiz_edit_grade =  UserQuiz::find($question->quiz_id);

        $qu = $quiz_edit_grade->questions;
        $a = [];
        $b = [];
        $counter = 0;

        foreach ($qu as $item) {
            $op = $item->options;
            for ($i = 0; $i < $item->options->count(); $i++) {
                $a[$i] = $op[$i]->weight;
            }
            if ($counter < $quiz_edit_grade->questions->count()) {
                $b[$counter] = max($a);
                $counter++;
            }
            $a[0] = 0;
            $a[1] = 0;
            $a[2] = 0;
            $a[3] = 0;
        }

        $quiz_edit_grade->grade = array_sum($b);
        $quiz_edit_grade->save();

        return redirect()->back()->with('success', __("Question deleted successfully !"));
    }

    public function destroy_Option($id)
    {
        $option = UserOptions::find($id);
        $question = UserQuestions::find($option->question_id);
        UserOptions::destroy($id);
        $quiz_edit_grade =  UserQuiz::find($question->quiz_id);

        $qu = $quiz_edit_grade->questions;
        $a = [];
        $b = [];
        $counter = 0;

        foreach ($qu as $item) {
            $op = $item->options;
            for ($i = 0; $i < $item->options->count(); $i++) {
                $a[$i] = $op[$i]->weight;
            }
            if ($counter < $quiz_edit_grade->questions->count()) {
                $b[$counter] = max($a);
                $counter++;
            }
            $a[0] = 0;
            $a[1] = 0;
            $a[2] = 0;
            $a[3] = 0;
        }

        $quiz_edit_grade->grade = array_sum($b);
        $quiz_edit_grade->save();

        return redirect()->back()->with('success', __("Option deleted successfully !"));
    }

    public function start_test(Request $request, $slug, $lang = 'ar')
    {
        App::setLocale($lang);
        Session::forget('lang');
        Session::put('lang', $lang);

        if ($lang == 'ar' || $lang == 'en') {
            $quiz = UserQuiz::where('slug', '=', $slug)->first();
            if ($quiz) {
                $order = userQuiz_optios_order::where('quiz_id', $quiz->id)->first();
                $questions = UserQuestions::where('quiz_id', $quiz->id)->simplePaginate(1);
                $questions_ = UserQuestions::where('quiz_id', $quiz->id)->get();
                $counter = UserQuestions::where('quiz_id', $quiz->id)->count();
                if ($request->ajax()) {
                    return view('pages.userQuizzess.start.start-test-ajax')
                        ->with('quiz', $quiz)
                        ->with('order', $order)
                        ->with('questions', $questions)
                        ->with('questions_', $questions_)
                        ->with('counter', $counter);
                }

                return view('pages.userQuizzess.start.start-test')
                    ->with('quiz', $quiz)
                    ->with('questions', $questions)
                    ->with('order', $order)
                    ->with('questions_', $questions_)
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
            $quiz = UserQuiz::where('slug', '=', $slug)->first();
            if ($quiz) {
                $user_grade = 0;
                $ans_arr = explode(",", $ans);
                for ($i = 0; $i < count($ans_arr); $i++) {
                    if ($ans_arr[$i] != null) {
                        $UserOption = UserOptions::where('id', $ans_arr[$i])->first();
                            $user_grade = $user_grade + $UserOption->weight;
                    }
                }

                // return $user_grade;
                $answer = new UserAnswers();
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
            $answer = UserAnswers::where('slug', $answer_slug)->first();
            $quiz = UserQuiz::where('id', '=', $answer->quiz_id)->first();
            if ($answer) {
                $quiz->ResultOrder->count();
                $ResultOrders = $quiz->ResultOrder;
                $text = "";
                foreach ($ResultOrders as $item) {
                    if ($item->from <= $answer->results && $answer->results <= $item->to) {
                        $text = $item->text;
                    }
                }

                return view('pages.userQuizzess.results.user_result')->with('quiz', $quiz)
                    ->with('text', $text)
                    ->with('answer', $answer)
                    ->with('lang', $lang);
            } else {
                abort(404);
            }
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
            $quiz = UserQuiz::where('slug', '=', $slug)->first();
            if (!is_null($quiz)) {
                $name = User::where('id', $quiz->user_id)->first();

                if ($name) {
                    $name = $name->name;
                    $name;
                } else {
                    if ($lang == 'ar') {
                        $name = "غير معروف";
                    } else {
                        $name = "unknow";
                    }
                }
                return view('pages.userQuizzess.share')
                    ->with('name', $name)
                    ->with('quiz', $quiz);
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
            $quiz = UserQuiz::where('slug', '=', $slug)->first();
            if ($quiz) {
                $name = request()->query('name', ''); //input()
                $status = request()->query('status', ''); //input()
                if ($status == "lower") {
                    $results = UserAnswers::orderBy('results', 'ASC')
                        ->where('quiz_id', $quiz->id)
                        ->where('name', 'like',  '%' . request('name') . '%')
                        ->oldest()->paginate(20);
                } elseif ($status == "higher") {
                    $results = UserAnswers::orderBy('results', 'DESC')
                        ->where('quiz_id', $quiz->id)
                        ->where('name', 'like',  '%' . request('name') . '%')
                        ->oldest()->paginate(20);
                } elseif ($status == "newest") {
                    $results = UserAnswers::where('quiz_id', $quiz->id)
                        ->where('name', 'like',  '%' . request('name') . '%')
                        ->latest()->paginate(20);
                } else {
                    $results = UserAnswers::where('quiz_id', $quiz->id)
                        ->where('name', 'like',  '%' . request('name') . '%')
                        ->oldest()->paginate(20);
                }

                $name1 = User::where('id', $quiz->user_id)->first();
                if ($name1) {
                    $name1 = $name1->name;
                    $name1;
                } else {
                    if ($lang == 'ar') {
                        $name1 = "غير معروف";
                    } else {
                        $name1 = "unknow";
                    }
                }

                return view('pages.userQuizzess.results.all_result')->with('quiz', $quiz)
                    ->with('lang', $lang)
                    ->with('name', $name)
                    ->with('name1', $name1)
                    ->with('status', $status)
                    ->with('results', $results);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }


    public function block_result($id)
    {
        $quiz = UserQuiz::findorFail($id);
        if (!empty($quiz)) {
            if (Auth::id() == $quiz->user_id) {
                $quiz->results_share = false;
                $quiz->save();
            } else {
                abort(404);
            }
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }

        //Sharing results of this Quiz has been blocked !
        return response()->json($data);
    }

    public function unblock_result($id)
    {

        $quiz = UserQuiz::findorFail($id);
        if (!empty($quiz)) {
            if (Auth::id() == $quiz->user_id) {
                $quiz->results_share = true;
                $quiz->save();
            } else {
                abort(404);
            }
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }

        //Sharing results of this Quiz has been unblocked !
        return response()->json($data);
    }

    public function block_all_result()
    {
        $quizzes = auth()->user()->user_quizzes;
        if (!empty($quizzes)) {
            foreach ($quizzes as $quiz) {
                if (auth()->id() == $quiz->user_id) {
                    $quiz->results_share = false;
                    $quiz->save();
                } else {
                    abort(404);
                }
            }
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }

        //Sharing results of all Quizzes has been blocked !
        return response()->json($data);
    }

    public function unblock_all_result()
    {
        $quizzes = auth()->user()->user_quizzes;
        if (!empty($quizzes)) {
            foreach ($quizzes as $quiz) {
                if (auth()->id() == $quiz->user_id) {
                    $quiz->results_share = true;
                    $quiz->save();
                } else {
                    abort(404);
                }
            }
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }

        //Sharing results of all Quizzes has been unblocked !
        return response()->json($data);
    }

    public function private_quiz($id)
    {
        $quiz = UserQuiz::findorFail($id);
        if (!empty($quiz)) {
            if (auth()->id() == $quiz->user_id) {
                $quiz->is_private = true;
                $quiz->save();
            } else {
                abort(404);
            }
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }

        //The Quiz became private!
        return response()->json($data);
    }

    public function public_quiz($id)
    {
        $quiz = UserQuiz::findorFail($id);
        if (!empty($quiz)) {
            if (auth()->id() == $quiz->user_id) {
                $quiz->is_private = false;
                $quiz->save();
            } else {
                abort(404);
            }
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }

        //The Quiz became public!
        return response()->json($data);
    }

    public function hide_result($id)
    {
        $quiz = UserQuiz::findorFail($id);
        if (!empty($quiz)) {
            if (auth()->id() == $quiz->user_id) {
                $quiz->hide_result = true;
                $quiz->save();
            } else {
                abort(404);
            }
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }

        //The Result of the Quiz became hidden !
        return response()->json($data);
    }

    public function unhide_result($id)
    {
        $quiz = UserQuiz::findorFail($id);
        if (!empty($quiz)) {
            if (auth()->id() == $quiz->user_id) {
                $quiz->hide_result = false;
                $quiz->save();
            } else {
                abort(404);
            }
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }

        //The Result of the Quiz became unhidden !
        return response()->json($data);
    }

    public function hide_result_counter($id)
    {
        $quiz = UserQuiz::findorFail($id);
        if (!empty($quiz)) {
            if (auth()->id() == $quiz->user_id) {
                $quiz->hide_result_counter = true;
                $quiz->save();
            } else {
                abort(404);
            }
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }

        //The Result of the Quiz became hidden !
        return response()->json($data);
    }

    public function unhide_result_counter($id)
    {
        $quiz = UserQuiz::findorFail($id);
        if (!empty($quiz)) {
            if (auth()->id() == $quiz->user_id) {
                $quiz->hide_result_counter = false;
                $quiz->save();
            } else {
                abort(404);
            }
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }

        //The Result of the Quiz became unhidden !
        return response()->json($data);
    }

    public function do_options_order($id, Request $request)
    {
        $this->validate($request, [ //this request comes from the form
            "answer1" => 'required',
            "answer2" => 'required',
            "answer3" => 'required',
            "answer4" => 'required'
        ]);
        if ($request->input('answer1') == $request->input('answer2') || $request->input('answer1') == $request->input('answer3') || $request->input('answer1') == $request->input('answer4')) {
            return redirect()->back()->with(['error' => __("Variables ​​carry similar values, should be different!")]);
        }

        if ($request->input('answer2') == $request->input('answer3') || $request->input('answer2') == $request->input('answer4')) {
            return redirect()->back()->with(['error' => __("Variables ​​carry similar values, should be different!")]);
        }

        if ($request->input('answer3') == $request->input('answer4')) {
            return redirect()->back()->with(['error' => __("Variables ​​carry similar values, should be different!")]);
        }

        $quiz = UserQuiz::findorFail($request->input('quiz_id'));
        $order = userQuiz_optios_order::findorFail($id);
        if (Auth::id() == $quiz->user_id) {
            $order->op1 =  $request->input('answer1');
            $order->op2 =  $request->input('answer2');
            $order->op3 =  $request->input('answer3');
            $order->op4 =  $request->input('answer4');
            $order->save();
            /* return view('pages.user.quiz.order_option')->with('order', $order)
                                                        ->with('quiz', $quiz)
                                                        ->with('success', __("The answers of the quiz became shown in a particular order")); */

            return redirect()->route('user_quiz')->with('success', __("The answers of the quiz became shown in a particular order"))
                ->with('order', $order)
                ->with('quiz', $quiz);
        } else {
            abort(404);
        }
    }


    public function order_options2($id)
    {
        $quiz = UserQuiz::findorFail($id);
        if (Auth::id() == $quiz->user_id) {
            $order = userQuiz_optios_order::where('quiz_id', $quiz->id)->first();
            // return $order->op1;
            return view('pages.user.quiz.order_option')->with('order', $order)
                ->with('quiz', $quiz)
                ->with('success', __("The answers of the quiz became shown in a particular order"));
        } else {
            abort(404);
        }
    }

    public function order_options($id)
    {
        $quiz = UserQuiz::findorFail($id);
        if (Auth::id() == $quiz->user_id) {
            if ($quiz->order_options == true) {
                $quiz->order_options = false;
                $quiz->save();
                userQuiz_optios_order::where('quiz_id', $quiz->id)->delete();
                $data['msg'] =  'success1';
                // return redirect()->route('user_quiz')->with('success', __("The Answers became shown in a random order!"))
            } else {
                $quiz->order_options = true;
                $quiz->save();
                $userQuiz_optios_order = new userQuiz_optios_order();
                $userQuiz_optios_order->quiz_id = $quiz->id;
                $userQuiz_optios_order->op1 = 1/* $request->input('answer1') */;
                $userQuiz_optios_order->op2 = 2;
                $userQuiz_optios_order->op3 = 3;
                $userQuiz_optios_order->op4 = 4;
                $userQuiz_optios_order->save();

                //return view('user.quiz.order_option')->with('success', __("The Answers became shown in a particular order!"))
                $data['msg'] =  'success2';
            }

            return response()->json($data);
        } else {
            $data['msg'] = 'error';
        }
    }

    public function shown_result($id)
    {
        $quiz = UserQuiz::findorFail($id);
        return view('pages.user.quiz.shown_result.create')->with('quiz', $quiz);
    }
    public function do_shown_result($id, Request $request)
    {
        $this->validate($request, [
            "from" => 'required',
            "to" => 'required',
            "text" => 'required',
            'from' => 'unique:result_orders,from,NULL,to,quiz_user_id,' . $id,
            'to' => 'unique:result_orders,to,NULL,from,quiz_user_id,' . $id
        ]);

        /* $counter = UserQuestions::where('quiz_id', $id)->count();// the highest result */
        $quiz = UserQuiz::findorFail($id);
        $counter = $quiz->grade;

        if ($counter == 0) {
            return redirect()->back()->with('error', __("Sorry, you cannot add because quiz grade = 0"));
            /*  return redirect()->back()->withInput()->withErrors(['error' => __("Sorry, you cannot add because quiz grade = 0")]); */
        }

        if ($request->input('from') ==  $request->input('to')) {
            return redirect()->back()->with('error', __("Variables ​​carry similar values, should be different!"));
        }
        if ($request->input('from') >=  $request->input('to')) {
            return redirect()->back()->with('error', __("end value must be bigger than start value!"));
        }
        if ($request->input('from') < 0) {
            return redirect()->back()->with('error', __("start value must be bigger than 0"));
        }
        if ($request->input('to') < 0) {
            return redirect()->back()->with('error', __("end value must be bigger than 0"));
        }
        if ($request->input('to') > $counter) {
            return redirect()->back()->with('error', __("end value must be less than or equal the highest result which is ") . $counter);
        }
        if ($request->input('from') >= $counter) {
            return redirect()->back()->with('error', __("start value must be less than the highest result which is ") . $counter);
        }
        $ResultOrders = ResultOrder::where('quiz_user_id', $id)->orderBy('from')->get();
        $ResultOrders_couter = ResultOrder::where('quiz_user_id', $id)->orderBy('from')->count();
        if ($ResultOrders_couter > 0) {
            foreach ($ResultOrders as $item) {
                if ($item->from <= $request->input('from') && $request->input('from') <= $item->to) {
                    return redirect()->back()->with('error', __("There is conflict, try with different values!"));
                }

                if ($item->from <= $request->input('to') && $request->input('to') <= $item->to) {
                    return redirect()->back()->with('error', __("There is conflict, try with different values!"));
                }

                if (
                    $request->input('from') <= $item->from && $request->input('from') <= $item->to &&
                    $request->input('to') >= $item->from && $request->input('to') >= $item->to
                ) {
                    return redirect()->back()->with('error', __("There is conflict, try with different values!"));
                }
            }
            $ResultOrder = new ResultOrder();
            $ResultOrder->from =  $request->input('from');
            $ResultOrder->to =  $request->input('to');
            $ResultOrder->text =  $request->input('text');
            $ResultOrder->quiz_Gen_id =  null;
            $ResultOrder->quiz_user_id =  $id;
            $ResultOrder->save();
            if ($request->input('btn_1') == 'stop') {
                return redirect(route('user_quiz.editindex_shown_result', ['id' => $id]))->with('counter', $counter)->with('success', __('Record added successfully !'));
            }
            if ($request->input('btn_1') == 'next') {
                return redirect(route('user_quiz.shown_result', ['id' => $id]))->with('success', __('Record added successfully !'));
            }
        } else {
            $ResultOrder = new ResultOrder();
            $ResultOrder->from =  $request->input('from');
            $ResultOrder->to =  $request->input('to');
            $ResultOrder->text =  $request->input('text');
            $ResultOrder->quiz_Gen_id =  null;
            $ResultOrder->quiz_user_id =  $id;
            $ResultOrder->save();
            if ($request->input('btn_1') == 'stop') {
                return redirect(route('user_quiz.editindex_shown_result', ['id' => $id]))->with('counter', $counter)->with('success', __('Record added successfully !'));
            }
            if ($request->input('btn_1') == 'next') {
                return redirect(route('user_quiz.shown_result', ['id' => $id]))->with('success', __('Record added successfully !'));
            }
        }
    }

    public function editindex_shown_result($id)
    {
        $quiz = UserQuiz::findorFail($id);
        if (request()->expectsJson()) {
            $func = 'arraySearchUserQuizShownResults';
            $ResultOrders = ResultOrder::where('quiz_user_id', $id)->orderBy('from');
            $results = ResultOrder::scopeMetronicPaginate($ResultOrders, $func);
            return response()->json($results);
        }
        return view('pages.user.quiz.shown_result.editindex')->with('quiz', $quiz);


        /* $quiz = UserQuiz::findorFail($id);
        $ResultOrders = ResultOrder::where('quiz_user_id', $id)->orderBy('from')->paginate(20);
        return view('pages.user.quiz.shown_result.editindex')->with('quiz', $quiz)
                                                             ->with('ResultOrders', $ResultOrders); */
    }

    public function destroy_shown_result($id)
    {
        $result = ResultOrder::findorFail($id);
        if (!empty($result)) {
            ResultOrder::destroy($id);
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }
        return response()->json($data);
    }

    public function edit_shown_result($id)
    {
        $ResultOrder = ResultOrder::findorFail($id);
        return view('pages.user.quiz.shown_result.edit')->with('ResultOrder', $ResultOrder);
    }

    public function update_shown_result($id, Request $request)
    {
        $ResultOrder = ResultOrder::findorFail($id);
        $this->validate($request, [
            "from" => 'required',
            "to" => 'required',
            "text" => 'required'
        ]);

        /* $counter = UserQuestions::where('quiz_id', $ResultOrder->quiz_user_id)->count();// the highest result */
        $quiz = UserQuiz::where('id', $ResultOrder->quiz_user_id)->first();
        $counter = $quiz->grade;

        if ($counter == 0) {
            return redirect()->back()->with('error', __("Sorry, you cannot add because quiz grade = 0"));
            /*  return redirect()->back()->withInput()->withErrors(['error' => __("Sorry, you cannot add because quiz grade = 0")]); */
        }


        if ($request->input('from') ==  $request->input('to')) {
            return redirect()->back()->with(['error' => __("Variables ​​carry similar values, should be different!")]);
        }
        if ($request->input('from') >=  $request->input('to')) {
            return redirect()->back()->with(['error' => __("end value must be bigger than start value!")]);
        }
        if ($request->input('from') < 0) {
            return redirect()->back()->with(['error' => __("start value must be bigger than 0")]);
        }
        if ($request->input('to') < 0) {
            return redirect()->back()->with(['error' => __("end value must be bigger than 0")]);
        }
        if ($request->input('to') > $counter) {
            return redirect()->back()->with(['error' => __("end value must be less than or equal the highest result which is ") . $counter]);
        }
        if ($request->input('from') >= $counter) {
            return redirect()->back()->with(['error' => __("start value must be less than the highest result which is ") . $counter]);
        }

        $ResultOrders = ResultOrder::where('id', '!=', $ResultOrder->id)->where('quiz_user_id', $ResultOrder->quiz_user_id)->orderBy('from')->get();
        $ResultOrders_couter = ResultOrder::where('id', '!=', $ResultOrder->id)->where('quiz_user_id', $ResultOrder->quiz_user_id)->orderBy('from')->count();
        if ($ResultOrders_couter > 0) {
            foreach ($ResultOrders as $item) {
                if ($item->from <= $request->input('from') && $request->input('from') <= $item->to) {
                    return redirect()->back()->with(['error' => __("There is conflict, try with different values!")]);
                }

                if ($item->from <= $request->input('to') && $request->input('to') <= $item->to) {
                    return redirect()->back()->with(['error' => __("There is conflict, try with different values!")]);
                }

                if (
                    $request->input('from') <= $item->from && $request->input('from') <= $item->to &&
                    $request->input('to') >= $item->from && $request->input('to') >= $item->to
                ) {
                    return redirect()->back()->with(['error' => __("There is conflict, try with different values!")]);
                }
            }

            $ResultOrder->from =  $request->input('from');
            $ResultOrder->to =  $request->input('to');
            $ResultOrder->text =  $request->input('text');
            $ResultOrder->save();
            return redirect(route('user_quiz.editindex_shown_result', ['id' => $ResultOrder->quiz_user_id]))->with('counter', $counter)->with('success', __('Record updated successfully !'));
        } else {
            $ResultOrder->from =  $request->input('from');
            $ResultOrder->to =  $request->input('to');
            $ResultOrder->text =  $request->input('text');
            $ResultOrder->save();
            return redirect(route('user_quiz.editindex_shown_result', ['id' => $ResultOrder->quiz_user_id]))->with('counter', $counter)->with('success', __('Record updated successfully !'));
        }
    }

    public function update_status(Request $request, $id)
    {
        $quiz = UserQuiz::findorFail($id);
        $quiz->category = $request->input('category');
        $quiz->save();
        return response()->json($quiz);
        /* return redirect()->back()->with('success', __('Quiz Category Updated successfully !')); */
    }

    public function update_lang(Request $request, $id)
    {
        $quiz = UserQuiz::findorFail($id);
        $quiz->lang = $request->input('lang');
        $quiz->save();
        return response()->json($quiz);
    }
}
