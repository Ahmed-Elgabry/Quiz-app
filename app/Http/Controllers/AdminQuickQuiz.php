<?php

namespace App\Http\Controllers;

use App\Models\CategoryQuiz;
use App\Models\QuickQuiz;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AdminQuickQuiz extends Controller
{
    //
    public function index_all()
    {
        if (request()->expectsJson()) {
            $func = 'arraySearchAdminQuickQuiz';
            $quizzes_ = QuickQuiz::with('Category');
            $quizzes = QuickQuiz::scopeMetronicPaginate($quizzes_, $func);
            return response()->json($quizzes);
        }
        return view('pages.admin.quick-quizzes.index');
    }

    public function showQuiz($id)
    {
        $quiz  =  QuickQuiz::find($id);
        return response()->json($quiz);
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

    public function update_status(Request $request, $id)
    {
        $quiz = QuickQuiz::findorFail($id);
        $quiz->category = $request->input('category');
        $quiz->save();
        return response()->json($quiz);
    }

    public function update_lang(Request $request, $id)
    {
        $quiz = QuickQuiz::findorFail($id);
        $quiz->lang = $request->input('lang');
        $quiz->save();
        return response()->json($quiz);
    }

    public function featured(Request $request, $id)
    {
        $quiz = QuickQuiz::findorFail($id);
        if (!empty($quiz)) {
            if ($quiz->is_featured == true) {
                $quiz->is_featured = false;
                $quiz->featured_at =  null;
                $data['msg'] =  'success2';
            } else {
                $quiz->is_featured = true;
                $quiz->featured_at = Carbon::now();
                if($quiz->lang == ''){
                    $quiz->lang = App::currentLocale();
                }
                $data['msg'] =  'success1';
            }
            $quiz->save();
        } else {
            $data['msg'] = 'error';
        }
        return response()->json($data);
    }

    public function destroy_admin($id)
    {
        $quiz = QuickQuiz::findorFail($id);
        if (!empty($quiz)) {
            QuickQuiz::destroy($id);
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
                QuickQuiz::destroy($item);
            }
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }
        return response()->json($data);
    }

}
