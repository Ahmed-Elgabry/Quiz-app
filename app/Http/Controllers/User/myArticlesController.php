<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\log;
use Illuminate\Support\Facades\Validator;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;

class myArticlesController extends Controller
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
        //
        if (request()->expectsJson()) {
            $func = 'arraySearchArticles';
            $articles_ = Article::where('writer_id', auth()->user()->id)->with('user');
            $articles = Article::scopeMetronicPaginate($articles_, $func);
            return response()->json($articles);
        }
        return view('pages.user.articles.index');
    }


    public function create()
    {
        //
        return view('pages.user.articles.create');
    }


    public function store(Request $request)
    {
        //
        $rules = array(
            "title" => 'required',
            "image" => 'image|required',
            "language" => 'required',
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
        $article->is_arabic = $request->input('language');

        if (auth()->user()->is_admin) {
            $article->status = 'A';
        } else {
            $article->status = 'P';
        }

        if ($request->input('featured')) {
            $article->is_featured = true;
        } else {
            $article->is_featured = false;
        }
        $article->writer_id  = auth()->user()->id;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
            $article->image =  $path;
        }

        $article->save();

        $log  = new log();
        $log->event = 'A';
        $log->user_id  = $article->writer_id;
        $log->article_id  = $article->id;
        $log->save();
        return response()->json($article);
    }


    public function edit($id)
    {
        //
        $article = Article::findOrFail($id);
        if ($article->writer_id == auth()->user()->id) {
            return view('pages.user.articles.edit')->with('article', $article);
        } else {
            abort(404);
        }
    }


    public function update(Request $request, $id)
    {
        //
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
        $article = Article::findOrFail($id);

        if ($article->writer_id == auth()->user()->id) {

            if ($request->hasFile('image')) {

                $image = $request->file('image');
                $path = $image->storeAs('images', basename($article->image), 'public');
                Image::make(public_path('storage/' . $path))->resize(368, 250)->save();
                $article->image =  $path;
            }
            $article->title = $request->input('title');
            $article->content = $request->input('content');
            $article->is_arabic = $request->input('language');

            if (auth()->user()->is_admin) {
                $article->status = 'A';
            } else {
                $article->status = 'P';
            }

            if ($request->input('featured')) {
                $article->is_featured = true;
            } else {
                $article->is_featured = false;
            }
            $article->save();

            $log  = new log();
            $log->event = 'E';
            $log->user_id  = $article->writer_id;
            $log->article_id  = $article->id;
            $log->save();
            return response()->json($article);
        } else {
            abort(404);
        }
    }

    public function destroy($id)
    {
        //
        $article = Article::findOrFail($id);
        if (!empty($article) && $article->writer_id == auth()->user()->id /* && $article->status != 'A' */) {
            $article->delete();
            $log  = new log();
            $log->event = 'D';
            $log->user_id  = $article->writer_id;
            $log->article_id  = $article->id;
            $log->save();
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
}
