<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserAnswers;
use App\Models\UserQuiz;
use App\Models\UserQuestions;
use Illuminate\Support\Facades\Auth;


class ResultsController extends Controller
{
    public function index()
    {
        if (request()->expectsJson()) {
            $func = 'arraySearchResults';
            $quizzes = UserQuiz::where('user_id', auth()->user()->id)->pluck('id');
            $results = UserAnswers::whereIn('quiz_id', $quizzes)->with('quiz');
            $answers = UserAnswers::scopeMetronicPaginate($results, $func);
            return response()->json($answers);
        }
        return view('pages.user.result.index');
    }

    public function show($id)
    {

        $quiz = UserQuiz::where('id', '=', $id)->first();
        if (request()->expectsJson()) {
            $func = 'arraySearchResults';
            $results = UserAnswers::where('quiz_id', $quiz->id)->with('quiz');
            $answers = UserAnswers::scopeMetronicPaginate($results, $func);
            return response()->json($answers);
        }
        return view('pages.user.result.show')->with('quiz', $quiz);
    }


    public function deleteall(Request $request)
    {
        $ids = $_POST['id'];
        if (!empty($ids)) {
            foreach ($ids as $item) {
                $useranswer = UserAnswers::find($item);
                $useranswer->delete();
            }
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }
        return response()->json($data);
    }

    public function destroy($id)
    {

        $UserAnswers = UserAnswers::findOrFail($id);
        if (!empty($UserAnswers)) {
            UserAnswers::destroy($id);
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }
        return response()->json($data);
    }
}
