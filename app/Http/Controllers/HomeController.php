<?php

namespace App\Http\Controllers;

use App\Comment;
use App\News;
use Illuminate\Http\Request;


class HomeController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function news()
    {
        $records = News::all();
        return view('news', compact('records'));
    }
    public function newsbyid($id)
    {
        $record = News::find($id);
        $comments = Comment::where('post_id', '=', $id)->get();
        return view('details', compact('record'), compact('comments'));
    }

    public function addcomment(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|max:255',
        ]);

        Comment::add_record($request->news_id, $request->body);
        return redirect('/news/' . $request->news_id);
    }

    public function post()
    {
        return view('post');
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:news|max:255',
            'body' => 'required|min:10',
        ]);

//        if ($validator->fails()) {
//            return redirect('/post')
//                ->withErrors($validator)
//                ->withInput();
//        }

        $newrec = News::add_record($request->title, $request->body);


        return redirect('/news/' . $newrec->id);
    }
}
