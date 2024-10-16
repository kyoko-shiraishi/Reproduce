<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread; 
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Events\ThreadLiked;

use App\Models\Category;


class PleaseController extends Controller
{
    public function index()
    {
        return view('please.index');
    }

    public function post(Request $request)
    {
        $validate_rule = [
            'mail' => 'email',
            'password' => 'required', 
        ];
        $this->validate($request, $validate_rule);
        return view('home.index', ['msg' => 'ログインしました']);
    }

  
    public function home()
    {
        // 1ページあたり10件のスレッドを表示
        // paginate→全件総計算 
        // simplePaginate→総計算なし。前へと次へのみ。
        // どちらもget()みたいなもん
        $sort = $request->sort;
        $all_threads = Thread::orderBy($sort,'asc')->paginate(5);
        $param = ['sort'=>$sort,'all_threads'=>$all_threads];
        return view('please.home',$param);
    
    }


    public function business(){
        return view('please.business');
    }
    public function infomation(){
        return view('please.infomation');
    }

    public function new_thread_create(){
        $categories = Category::all();
        return view('please.new_thread_create', compact('categories'));
    }

    public function new_post_create(){
        return view('please.new_post_create');
    }
   
    public function delete_show(){
        $threads_you_created=Thread::where('user_id', Auth::id())->get();
        $posts_you_created = Post::where('user_id', Auth::id())->get();
        return view('please.delete',compact('threads_you_created','posts_you_created'));
    }
    public function delete_selected(Request $request)
{
    // スレッドを削除
    if ($request->has('threads')) {
        Thread::destroy($request->input('threads'));
    }

    // ポストを削除
    if ($request->has('posts')) {
        Post::destroy($request->input('posts'));
    }

    return redirect()->back()->with('status', '選択したスレッドとポストが削除されました。');

}


}