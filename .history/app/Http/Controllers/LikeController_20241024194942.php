<?php





namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\ThreadLike;
use Illuminate\Http\Request;
use App\Models\PostLike;

class LikeController extends Controller
{

    public function likeThread(Request $request,ThreadLike $thread_like)
    {
        $user_id = \Auth::id();
        
        //jsのfetchメソッドで記事のidを送信しているため受け取ります。
        $thread_id = $request->thread_id;
        //自身がいいね済みなのか判定します
        $alreadyLiked = ThreadLike::where('user_id', $user_id)->where('thread_id', $thread_id)->first();
        
        if (!$alreadyLiked) {
            // dd($alreadyLiked);
        //こちらはいいねをしていない場合の処理です。つまり、post_likesテーブルに自身のid（user_id）といいねをした記事のid（post_id）を保存する処理になります。
            $like = new ThreadLike();
            $like->thread_id = $thread_id;
            $like->user_id = $user_id;
            
            $like->save();
        } else {
            //すでにいいねをしていた場合は、以下のようにpost_likesテーブルからレコードを削除します。
            ThreadLike::where('thread_id', $thread_id)->where('user_id', $user_id)->delete();
        }
        //ビューにその記事のいいね数を渡すため、いいね数を計算しています。
        $thread = Thread::where('id', $thread_id)->first();
        $likesCount = $thread->thread_likes->count();


        $param = [
            'likesCount' =>  $likesCount,
        ];
        //ビューにいいね数を渡しています。名前は上記のlikesCountとなるため、フロントでlikesCountといった表記で受け取っているのがわかると思います。
        return response()->json($param);
    }
    
    public function LikePost(Request $request,PostLike $post_like){
       
        $user_id = \Auth::id();
        
        //jsのfetchメソッドで記事のidを送信しているため受け取ります。
        $post_id = $request->post_id;
        //自身がいいね済みなのか判定します
        
        $alreadyLiked = PostLike::where('user_id', $user_id)->where('post_id', $post_id)->first();
        
        if (!$alreadyLiked) {
            // dd($alreadyLiked);
        //こちらはいいねをしていない場合の処理です。つまり、post_likesテーブルに自身のid（user_id）といいねをした記事のid（post_id）を保存する処理になります。
            $like = new PostLike();
            $like->post_id = $post_id;
            $like->user_id = $user_id;
            $like->save();
            
        } else {
            //すでにいいねをしていた場合は、以下のようにpost_likesテーブルからレコードを削除します。
            PostLike::where('post_id', $post_id)->where('user_id', $user_id)->delete();
        }
        //ビューにその記事のいいね数を渡すため、いいね数を計算しています。
        $post = Post::where('id', $post_id)->first();
        $likesCount = $post->post_likes->count();


        $param = [
            'likesCount' =>  $likesCount,
        ];
        
        //ビューにいいね数を渡しています。名前は上記のlikesCountとなるため、フロントでlikesCountといった表記で受け取っているのがわかると思います。
        return response()->json($param);   
    }
}
