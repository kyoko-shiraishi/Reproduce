<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Category;
use App\Models\User; // ユーザーのモデルをインポート
use App\Models\Product; // 製品のモデルをインポート
use App\Models\Company; // 会社のモデルをインポート

class NewController extends Controller
{
    public function category()
    {
        $categories = Category::all();
        return view('new_thread_create', compact('categories'));
    }

    public function thread_store(Request $request)
    {
        // フォームから受け取ったデータを取得
        $user = User::where('name', $request->user)->first();
        
        // ユーザーが見つからない場合のエラーハンドリング
        if (!$user) {
            return redirect()->back()->withErrors(['user' => '指定されたユーザーが見つかりません。']);
        }

        // 会社名を取得し、存在しない場合は新規作成
        $company = Company::firstOrCreate(
            ['name' => $request->company],
            [] // 新規作成時に追加の属性が必要な場合に使用
        );

        // 製品名を取得し、存在しない場合は新規作成
       
$product = Product::firstOrCreate(
    ['name' => $request->product],
    ['category_id' => $request->category_id] // 新規作成時にカテゴリーIDを指定
);


        // 同じ企業名と製品名の組み合わせが存在するか確認
        $existingThread = Thread::where('company_id', $company->id)
                                ->where('product_id', $product->id)
                                ->first();

        if ($existingThread) {
            return redirect()->back()->withErrors(['thread' => 'この企業名と製品名のスレッドは既に存在します。']);
        }

        // 新しいThreadのインスタンスを作成
        $new_thread = new Thread();

        // フォームデータをThreadに保存するために取得
        $input = [
            'user_id' => $user->id,
            'company_id' => $company->id, // 新しく作成したか、既存の会社のIDを取得
            'product_id' => $product->id,
            'content' => $request->message,
            'category_id' => $request->category_id,
        ];

        // データをThreadモデルに保存
        $new_thread->fill($input)->save();

        // 投稿の詳細ページにリダイレクト
        return redirect('/home');
    }
}
