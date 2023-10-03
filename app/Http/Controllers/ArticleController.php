<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\log;
//use App\Quiz;
use Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Intervention\Image\ImageManagerStatic as Image;

class ArticleController extends Controller
{

    public function createSlug($title, $id = 0)
    {
        // $str = str_slug($title);
        $string = trim($title);
        $separator = '-';

        $string = mb_strtolower($string, "UTF-8");;

        $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);

        $string = preg_replace("/[\s-]+/", " ", $string);

        $string = preg_replace("/[\s_]/", $separator, $string);

        $str = $string;
        if (substr_count($str, '-') > 3) {;
            $y = 0;
            $z = 0;
            for ($i = 0; $i <= strlen($str); $i++) {
                if ($y <= 3) {
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
        return Article::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }


    public function index()
    {

        // return $articles_ = Article::where('deleted_at',null)->with('user')->get();
        if (request()->expectsJson()) {
            $func = 'arraySearchArticles';
            $articles_ = Article::with('user');
            $articles = Article::scopeMetronicPaginate($articles_, $func);
            return response()->json($articles);
        }
        return view('pages.articles.index');
    }


    public function create()
    {
        //
        return view('pages.articles.create');
    }

    public function create_en()
    {
        //
        return view('pages.articles.create_en');
    }

    public function showArticle($id)
    {
        $article  =  Article::with('statistics')->find($id);
        return response()->json($article);
    }


    public function store(Request $request)
    {

        $rules = array(
            "title" => 'required',
            "image" => 'image|required',
            "content" => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array(
                'error' => $validator->getMessageBag()->toArray()
            ));
        }

        $article  = new Article();
        $article->title = $request->input('title');
        $article->slug = $this->createSlug($request->input('title'));
        $article->content = $request->input('content');

        if (auth()->user()->is_admin) {
            $article->status = 'A';
        } else {
            $article->status = 'P';
        }

        $article->is_arabic = true;
        $article->writer_id  = auth()->user()->id;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
            $article->image =  $path;
        }
        $article->save();
        return response()->json($article);
    }

    public function store_en(Request $request)
    {
        $rules = array(
            "title" => 'required',
            "image" => 'image|required',
            "content" => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array(
                'error' => $validator->getMessageBag()->toArray()
            ));
        }

        $article  = new Article();
        $article->title = $request->input('title');
        $article->slug = $this->createSlug($request->input('title'));
        $article->content = $request->input('content');
        if (auth()->user()->is_admin) {
            $article->status = 'A';
        } else {
            $article->status = 'P';
        }
        $article->is_arabic = false;
        $article->writer_id  = auth()->user()->id;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
            $article->image =  $path;
        }
        $article->save();
        return response()->json($article);
    }

    public function edit($id)
    {
        //
        $article = Article::findOrFail($id);
        return view('pages.articles.edit')->with('article', $article);
    }


    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $rules = array(
            'title' => 'required',
            'content' => 'required',
            "language" => 'required',
            'image' => 'image',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array(
                'error' => $validator->getMessageBag()->toArray()
            ));
        }
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
            $article->image =  $path;
        }

        $article->title = $request->input('title');
        $article->is_arabic = $request->input('language');
        $article->content = $request->input('content');
        if (auth()->user()->is_admin) {
            $article->status = 'A';
        } else {
            $article->status = 'P';
        }
        $article->save();
        return response()->json($article);
    }

    public function update_status(Request $request, $id)
    {
        //
        if (auth()->user()->is_admin) {
            $article = Article::findOrFail($id);

            if ($request->input('status') == "A") {
                $article->status = $request->input('status');
            } else {
                $article->status = $request->input('status');
                $article->is_featured = false;
            }

            $article->save();
            return response()->json($article);
        } else {
            abort(404);
        }
    }

    public function update_featured(Request $request, $id)
    {
        //
        if (auth()->user()->is_admin) {
            $article = Article::findOrFail($id);
            if ($request->input('is_featured') == false) {
                $article->is_featured = false;
                $article->featured_at =  null;
            } else {
                $article->is_featured = true;
                $article->featured_at = Carbon::now();
            }
            $article->save();
            return response()->json($article);
        } else {
            abort(404);
        }
    }

    public function update_log(Request $request, $id)
    {
        if (auth()->user()->is_admin) {
            $log = log::findOrFail($id);
            $log->is_read = '1';
            $log->save();

            if ($log->event == 'A' || $log->event == 'E') {
                return redirect(route('articles.pending'));
            } else {
                return redirect(route('articles.trashed'));
            }
        } else {
            abort(404);
        }
    }


    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        if (!empty($article)) {
            $article->delete();
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
                $article = Article::findOrFail($item);
                $article->delete();
                // Article::destroy($item);
            }
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }
        return response()->json($data);
    }

    public function trashed()
    {
        // return $articles_ = Article::onlyTrashed()->with('user')->get();
        if (request()->expectsJson()) {
            $func = 'arraySearchDeletedArticles';
            $articles_ = Article::onlyTrashed()->with('user');
            $articles = Article::scopeMetronicPaginate($articles_, $func);
            return response()->json($articles);
        }
        return view('pages.articles.deleted');
    }

    public function featured()
    {
        if (request()->expectsJson()) {
            $func = 'arraySearchArticles';
            $articles_ = Article::where('is_featured', true)->with('user');
            $articles = Article::scopeMetronicPaginate($articles_, $func);
            return response()->json($articles);
        }
        return view('pages.articles.featured');
    }

    public function restore($id)
    {
        $article = Article::onlyTrashed()->where('id', '=', $id)->first();
        $article->restore();
        return response()->json($article);
    }

    public function forceDelete($id)
    {
        $article = Article::onlyTrashed()->where('id', '=', $id)->first();
        if (!empty($article)) {
            $article->forceDelete();
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }
        return response()->json($data);
    }

    public function restoreall(Request $request)
    {
        $ids = $_POST['id'];
        if (!empty($ids)) {
            Article::whereIn('id', $ids)->restore();
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }
        return response()->json($data);
    }

    public function forcedeleteall(Request $request)
    {
        $ids = $_POST['id'];
        if (!empty($ids)) {
            Article::whereIn('id', $ids)->forceDelete();
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }
        return response()->json($data);
    }

    public function pending()
    {
        //
        if (request()->expectsJson()) {
            $func = 'arraySearchArticles';
            $articles_ = Article::where('status', 'P')->with('user');
            $articles = Article::scopeMetronicPaginate($articles_, $func);
            return response()->json($articles);
        }
        $status = "Pending";
        return view('pages.articles.status')->with('status', $status);
    }

    public function approved()
    {
        //
        if (request()->expectsJson()) {
            $func = 'arraySearchArticles';
            $articles_ = Article::where('status', 'A')->with('user');
            $articles = Article::scopeMetronicPaginate($articles_, $func);
            return response()->json($articles);
        }
        $status = "Approved";
        return view('pages.articles.status')->with('status', $status);
    }

    public function rejected()
    {
        //
        if (request()->expectsJson()) {
            $func = 'arraySearchArticles';
            $articles_ = Article::where('status', 'R')->with('user');
            $articles = Article::scopeMetronicPaginate($articles_, $func);
            return response()->json($articles);
        }
        $status = "Rejected";
        return view('pages.articles.status')->with('status', $status);
    }
}
