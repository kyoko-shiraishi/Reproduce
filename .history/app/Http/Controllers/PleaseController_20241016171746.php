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

        public function index(Request $request)
        {
            $sort = $request->input('sort', 'new'); // デフォルトは「新しい順」
        
            // スレッドを取得
            $all_threads = Thread::withCount('likes') // likesリレーションのカウントを取得
                ->when($sort === 'new', function ($query) {
                    return $query->orderBy('created_at', 'desc'); // 新しい順
                })
                ->when($sort === 'old', function ($query) {
                    return $query->orderBy('created_at', 'asc'); // 古い順
                })
                ->when($sort === 'popular', function ($query) {
                    return $query->orderBy('likes_count', 'desc'); // いいねが多い順
                })
                ->paginate(5); // ページネーション
        
            return view('please.home', compact('all_threads', 'sort'));
        }
    
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