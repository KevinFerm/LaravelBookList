<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\MyList;
use App\User;
use Illuminate\Http\Request;
use Input;
use Redirect;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function movies() {
      return view('movies');
    }

    public function mylist($user_id) {
      $list = DB::table('mylists')->where('user_id', $user_id)->get();
      return view('mylist', ['user_id' => $user_id, 'list' => $list]);
    }

    public function add(Request $request) {
      if($request->isMethod('post')) {
        $status = $request->input('status');
        $title = $request->input('title');
        $userid = $request->input('user_id');
        $thumbnail = $request->input('thumbnail');
        $rating = $request->input('rating');
        $bookid = $request->input('book_id');
        if(MyList::addToList($title, $bookid, $userid, $rating, $status, $thumbnail))
          return redirect()->route('mylist', ['user_id' => $userid]);
      }
    }

    public function search(Request $request) {
      if($request->isMethod('post')) {
        $book = $request->input('book');
        $author = $request->input('author');
        if($author) {
          $result = MyList::searchBook(str_slug($book), $author);
        } else {
          $result = MyList::searchBook(str_slug($book));
        }

        if($result) {
          return redirect()->action('HomeController@movies')->with('result', json_decode($result, true));
        }
      }

    }

}
