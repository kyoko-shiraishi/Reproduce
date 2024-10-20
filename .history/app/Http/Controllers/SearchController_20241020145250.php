<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Company;
use App\Models\Product;
use App\Models\Category;
use WanaKana;

class SearchController extends Controller
{
    public function search(Request $request)
{
    
     // リクエストから正規化された会社名を取得
    $normalizedCompanyName = $request->input('normalized_company_name');
    dd($normalizedCompanyName);
    $productName = $request->input('product_name');

    // 検索クエリのベースを作成
    $query = Thread::with(['company', 'product.category']); // リレーションをロード

    // 会社名でフィルタリング
    if ($normalizedCompanyName) {
        
        // 会社名を検索
        $companies = Company::where(function ($subQuery) use ($normalizedCompanyName) {
            $subQuery->whereRaw("REPLACE(REPLACE(REPLACE(name, 'ー', ''), ' ', ''), '　', '') LIKE ?", "%$normalizedCompanyName%");
        })->get();
        
        foreach($companies as $company) {
            $query->where('company_id', $company->id);
        }
    }

    // 製品名でフィルタリング
    if ($productName) {
        // 入力をひらがなに変換
        $normalizedProductName = WanaKana::toHiragana($productName);
        
        // 製品名を検索
        $products = Product::where(function ($subQuery) use ($normalizedProductName) {
            $subQuery->whereRaw("REPLACE(REPLACE(REPLACE(name, 'ー', ''), ' ', ''), '　', '') LIKE ?", "%$normalizedProductName%");
        })->get();
        
        foreach($products as $product) {
            $query->where('product_id', $product->id);
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
