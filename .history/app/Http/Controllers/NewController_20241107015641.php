<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Category;
use App\Models\User; // ユーザーのモデルをインポート
use App\Models\Product; // 製品のモデルをインポート
use App\Models\Company; // 会社のモデルをインポート
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Cloudinary;

class NewController extends Controller
{

    


    public function thread_store(Request $request)
    {
        // フォームから受け取ったデータを取得($request->フォームのname属性)
        // users テーブルの name カラムが $request->user の値と一致するレコードを検索
        $user = Auth::user();

        $company = Company::firstOrCreate(
            ['name' => $request->company],
            [] // 新規作成時に追加の属性が必要な場合に使用
        );

        // 製品名を取得し、存在しない場合は新規作成
       
        $product = Product::firstOrCreate(
            ['name' => $request->product],
            ['category_id' => $request->category_id] // 新規作成時にカテゴリーIDを指定
        );


        
        $existingThread = Thread::where('company_id', $company->id)
                                ->where('product_id', $product->id)
                                ->first();

        if ($existingThread) {
            return redirect()->back()->withErrors(['thread' => 'この企業名と製品名のスレッドは既に存在します。']);
        }

        $request->validate([
            'content' => 'required|string|max:1000',
            'company' => 'required|string|max:255',
            'product' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048' 
        ]);
       
        //cloudinaryへ画像を送信し、画像のURLを$image_urlに代入している
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
       

        // 新しいThreadのインスタンスを作成
        $new_thread = new Thread();

       
        $input = [
            'user_id' => $user->id,
            'company_id' => $company->id, // 新しく作成したか、既存の会社のIDを取得
            'product_id' => $product->id,
            'content' => $request->content,
            'category_id' => $request->category_id,
        ];
       
        $input += ['image' => $image_url];  //追加

       
        $new_thread->fill($input)->save();

        // 投稿の詳細ページにリダイレクト
        return redirect('/home');

    }
    public function new_post_create($id)
    {
        // スレッド情報を取得
        $thread = Thread::with(['user', 'company', 'product.category'])
                        ->findOrFail($id);
    
        // ビューにスレッド情報を渡す
        return view('please.new_post_create', compact('thread'));
    }


        
    public function post_store(Request $request, $threadId)
{
    
    $request->validate([
        'content' => 'required|string|max:1000',
    ]);

    // 新しいコメントを作成
    $post = new Post();
    $input=[
        'content'=>$request->content,
        'thread_id'=>$threadId,
        'user_id'=>auth()->id,
    ];
    $post->fill($input)->save();

    // スレッドの詳細ページにリダイレクト
    return redirect()->route('post', $threadId)->with('success', 'コメントが投稿されました！');

}


}