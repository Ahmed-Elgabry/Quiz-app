<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryQuiz;
use App\Models\QuickQuiz;
use App\Models\UserQuiz;
use App\Models\Quiz;
use Illuminate\Support\Facades\Validator;

class CategoryQuizController extends Controller
{

    public function makeSlugforCategories(){
        $categories = CategoryQuiz::where('slug',null)->take(10)->get();
        if($categories->count() > 0){
            foreach($categories as $item){
                $item->slug = $this->createSlug($item->name);
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
        return CategoryQuiz::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }


    public function index()
    {
        // return $quizzes_ = UserQuiz::where('user_id',auth()->user()->id)->with('ResultOrder')->get();
        if (request()->expectsJson()) {
            $func = 'arraySearchCategory';
            $categories_ = CategoryQuiz::where('id', '!=', 0);
            $categories = CategoryQuiz::scopeMetronicPaginate($categories_, $func);
            return response()->json($categories);
        }
        return view('pages.categories.index');
    }

    public function deleteall(Request $request)
    {
        $ids = $_POST['id'];
        if (!empty($ids)) {
            foreach ($ids as $item) {
                $category = CategoryQuiz::findOrFail($item);
                $category->delete();
            }
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }
        return response()->json($data);
    }

    public function user_quizzes($id)
    {
        $category = CategoryQuiz::findOrFail($id);
        // return $data_ = UserQuiz::where('category', $category->id)->get();
        if (request()->expectsJson()) {
            $func = 'arraySearchAdminUserQuiz';
            $data_ = UserQuiz::where('category', $category->id)->with('ResultOrder')->with('user')->with('Category');
            $data = UserQuiz::scopeMetronicPaginate($data_, $func);
            return response()->json($data);
        }
        return view('pages.categories.user-quizzes')->with('category', $category);
    }

    public function quick_quizzes($id)
    {
        $category = CategoryQuiz::findOrFail($id);
        if (request()->expectsJson()) {
            $func = 'arraySearchAdminQuickQuiz';
            $data_ = QuickQuiz::where('category', $category->id)->with('Category');
            $data = QuickQuiz::scopeMetronicPaginate($data_, $func);
            return response()->json($data);
        }
        return view('pages.categories.quick-quizzes')->with('category', $category);
    }

    public function create()
    {
        //
        return view('pages.categories.create');
    }

    public function store(Request $request)
    {
        //

        $rules = array(
            "name" => 'required|unique:category_quizzes',
            "lang" => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array(
                'error' => $validator->getMessageBag()->toArray()
            ));
        }

        $category  = new CategoryQuiz();
        $category->name = $request->input('name');
        $category->slug = $this->createSlug($request->input('name'));
        $category->lang = $request->input('lang');
        $category->description = $request->input('description');
        $category->save();
        return response()->json($category);
    }

    public function edit($id)
    {
        //
        $category = CategoryQuiz::findOrFail($id);
        return view('pages.categories.edit')->with('category', $category);
    }

    public function update(Request $request, $id)
    {
        //

        $category = CategoryQuiz::findOrFail($id);

        $rules = array(
            'name' => 'required|unique:category_quizzes,name,' . $category->id,
            "lang" => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array(
                'error' => $validator->getMessageBag()->toArray()
            ));
        }

        $categories = CategoryQuiz::where('id', '!=', $category->id)->get();
        $category->name = $request->input('name');
        $category->lang = $request->input('lang');
        $category->description = $request->input('description');
        $category->save();
        return response()->json($category);
    }

    public function destroy($id)
    {
        $category = CategoryQuiz::findOrFail($id);
        if (!empty($category)) {
            $category->delete();
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }
        return response()->json($data);
    }
}
