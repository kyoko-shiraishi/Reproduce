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
        // リクエストからユーザーの指定した検索条件を取得
        $companyName = $request->input('company_name');
        $productName = $request->input('product_name');



        // 検索クエリのベースを作成
        $query = Thread::with(['company', 'product.category']); // リレーションをロード

        // 会社名でフィルタリング
        if ($companyName) {
            $companies = Company::where('name', 'LIKE', '%' . $companyName . '%')->get();

            // 取得した会社のIDを使用して、Threadモデルのクエリをフィルタリング
            foreach ($companies as $company) {
                if ($company) {
                    $query->where('company_id', $company->id);
                } else {
                    $query->whereNull('company_id');
                }
            }
        }

        // 製品名でフィルタリング
        if ($productName) {
            $products = Product::where('name', 'LIKE', '%' . $productName . '%')->get();
            foreach ($products as $product) {
                if ($product) {
                    $query->where('product_id', $product->id);
                } else {
                    $query->whereNull('product_id');
                }
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
