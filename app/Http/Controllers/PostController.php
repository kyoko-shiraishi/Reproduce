<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function post($id)
    {
        // スレッドに関連するポストを取得
        $eachpost = Post::where('thread_id', $id)->get();
        return view('please.post', compact('eachpost'));
    }
}
