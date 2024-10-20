<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Company;
use App\Models\Product;
use App\Models\Category; // ここでCategoryモデルをインポート

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // リクエストから検索条件を取得
        $companyName = $request->input('company_name');
        $productName = $request->input('product_name');
    
        // 検索クエリのベースを作成
        $query = Thread::with(['company', 'product.category']); // リレーションをロード
    
        // 会社名でフィルタリング
        if ($companyName) {
            $company = Company::where('name', 'LIKE', '%' . $companyName . '%')->get();
            if ($company) {
                $query->where('company_id', $company->id);
            } else {
                $query->whereNull('company_id');
            }
        }
    dd("aaaaa");
        // 製品名でフィルタリング
        if ($productName) {
            $product = Product::where('name', 'LIKE', '%' . $productName . '%')->get();
            if ($product) {
                $query->where('product_id', $product->id);
            } else {
                $query->whereNull('product_id');
            }
        }
    
        // カテゴリでフィルタリング
        if ($request->filled('category_id')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }
    
        // 検索結果を取得
        $threads = $query->get();
    
        // ビューに結果を渡して表示
        return view('search.results', compact('threads'));
    }
    
}