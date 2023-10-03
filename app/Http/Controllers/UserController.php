<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserQuiz;
use App\Models\UserAnswers;
use App\Models\Article;
use App\Models\QuickAnswers;
use App\Models\QuickQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        /* $func = 'arraySearchUsers';
        $users_ = User::where('is_admin',0)->where('is_editor',0);
        return $users = User::scopeMetronicPaginate($users_,$func); */
        if (request()->expectsJson()) {
            /* $users = User::where('is_admin',0)->where('is_editor',0)->metronicPaginate(); */
            $func = 'arraySearchUsers';
            $users_ = User::where('is_admin', 0)->where('is_editor', 0);
            $users = User::scopeMetronicPaginate($users_, $func);
            return response()->json($users);
        }
        return view('pages.users.index');
    }

    public function blocked()
    {
        //return $users = User::onlyTrashed()->get();
        if (request()->expectsJson()) {
            $func = 'arraySearchBlockedUsers';
            $users_ = User::onlyTrashed();
            $users = User::scopeMetronicPaginate($users_, $func);
            return response()->json($users);
        }
        return view('pages.users.blocked');
    }

    public function showUser($id)
    {
        $user  =  User::find($id);
        return response()->json($user);
    }

    public function showblockedUser($id)
    {
        $user  =  User::onlyTrashed()->find($id);
        return response()->json($user);
    }

    public function upgrade($id)
    {
        //
        $user = User::findorFail($id);
        $user->is_editor = 1;
        $user->save();

        return response()->json($user);
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->where('id', '=', $id)->first();
        $user->restore();
        return response()->json($user);
    }

    public function forceDelete($id)
    {

        $user = User::onlyTrashed()->where('id', '=', $id)->first();
        $name = $user->name;
        if (!empty($user)) {
            $user->forceDelete();
            $data['msg'] =  'success';
            $data['user_name'] = $name;
        } else {
            $data['msg'] = 'error';
        }
        return response()->json($data);
    }

    public function destroy($id)
    {
        $user  =  User::findOrFail($id);
        $name = $user->name;
        if (!empty($user)) {
            User::destroy($id);
            $data['msg'] =  'success';
            $data['user_name'] = $name;
        } else {
            $data['msg'] = 'error';
        }
        return response()->json($data);
    }

    public function blockall(Request $request)
    {
        $ids = $_POST['id'];
        if (!empty($ids)) {
            foreach ($ids as $item) {
                User::destroy($item);
            }
            /* User::whereIn('id',$ids)->destroy(); */
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }
        return response()->json($data);
    }

    public function unblockall(Request $request)
    {
        $ids = $_POST['id'];
        if (!empty($ids)) {
            User::whereIn('id', $ids)->restore();
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
            User::whereIn('id', $ids)->forceDelete();
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }
        return response()->json($data);
    }

    public function home()
    {


        $quick_quizess_count = QuickQuiz::count();
        $user_quizess_count = UserQuiz::count();
        $users_num =User::where('is_editor',0)->count();
        $editors_num =User::where('is_editor',1)->count();
        $articles_num_ar = Article::where('is_arabic',true)->count();
        $articles_num_en = Article::where('is_arabic',false)->count();
        $user_quizess_num2 = auth()->user()->user_quizzes->count();
        $quizzes = UserQuiz::where('user_id',auth()->user()->id)->pluck('id');
        $answers = UserAnswers::whereIn('quiz_id',$quizzes)->count();
        $user_articles = auth()->user()->Articles->count();

        return view('pages.users.home')
        ->with('quick_quizess_count',$quick_quizess_count)
        ->with('user_quizess_count',$user_quizess_count)
        ->with('users_num',$users_num)
        ->with('editors_num',$editors_num)
        ->with('user_quizess_num2',$user_quizess_num2)
        ->with('answers',$answers)
        ->with('user_articles',$user_articles)
        ->with('articles_num_ar',$articles_num_ar)
        ->with('articles_num_en',$articles_num_en);
    }

    public function settings($id)
    {
        $user = User::findorFail($id);
        if (Auth::id() == $user->id) {
            return view('pages.settings')->with('user', $user);
        } else {
            abort(404);
        }
    }

    public function do_settings(Request $request, $id)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'alpha_dash'],
            'email' => ['required', 'string', 'email', 'max:255'],
            /* 'password' => ['required', 'string', 'min:8', 'confirmed'], */
        ]);

        $user = User::findorFail($id);
        if (Auth::id() == $user->id) {
            $All_usernames = User::where('username', '!=', $user->username)->pluck('username')->toArray();
            $All_emails = User::where('email', '!=', $user->email)->pluck('email')->toArray();

            foreach ($All_usernames as $string) {
                if (strpos($request->input('username'), $string) !== false) {
                    return redirect()->back()->with("error", __("This username already exists !"));
                    break;
                }
            }

            foreach ($All_emails as $string) {
                if (strpos($request->input('email'), $string) !== false) {
                    return redirect()->back()->with("error", __("This email already exists !"));
                    break;
                }
            }
            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->save();

            return back()->with('success', sprintf(__("Your Information Updated successfully !")));
        } else {
            abort(404);
        }
    }

    public function changePassword(Request $request)
    {

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", __("Your current password does not matches with the password you provided. Please try again."));
        }

        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", __("New Password cannot be same as your current password. Please choose a different password."));
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return back()->with("success", __("Your Password changed successfully !"));
    }
}
