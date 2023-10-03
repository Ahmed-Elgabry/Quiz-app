<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;

class EditorController extends Controller
{
    public function index()
    {
        //
        // return $users = User::where('is_admin',0)->where('is_editor',1)->get();
        if (request()->expectsJson()) {
            $func = 'arraySearchEditors';
            $users_ = User::where('is_admin', 0)->where('is_editor', 1);
            $users = User::scopeMetronicPaginate($users_, $func);
            return response()->json($users);
        }
        return view('pages.users.editors');
    }

    public function downgrade($id)
    {
        //
        $user = User::findorFail($id);
        $user->is_editor = 0;
        $user->save();

        return response()->json($user);
    }

    public function his_articles($id)
    {
        $user = User::findorFail($id);
        // return $articles_ = Article::where('writer_id', $id)->with('user')->get();
        if ($user->is_editor) {
            if (request()->expectsJson()) {
                $func = 'arraySearchArticles';
                $articles_ = Article::where('writer_id', $id)->with('user');
                $articles = Article::scopeMetronicPaginate($articles_, $func);
                return response()->json($articles);
            }
            $status = $user->username;
            $user_id = $user->id;
            return view('pages.articles.status')->with('status', $status)->with('user_id', $user_id);
        } else {
            abort(404);
        }
    }
}
