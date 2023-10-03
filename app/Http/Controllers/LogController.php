<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\log;
use Auth;

class LogController extends Controller
{
    //
    public function index()
    {
        //
        $log = log::latest()->paginate(20);
        return view('pages.notifications.index')->with('log', $log);
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
}
