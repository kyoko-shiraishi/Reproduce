<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Thread;

class PostController extends Controller
{
   public function post($id)

    {
        // スレッド情報を取得（User, Company, Product, Categoryも一緒に取得）
        $thread = Thread::with(['user', 'company', 'product.category'])
                        ->findOrFail($id);
        
        // スレッドに関連するポストを取得
        $eachpost = Post::where('thread_id', $id)
                        ->with(['user', 'post_likes'])
                        ->get();
    
        // スレッド情報とポストをビューに渡す
        return view('please.post', compact('eachpost', 'thread'));
    }
    


}

