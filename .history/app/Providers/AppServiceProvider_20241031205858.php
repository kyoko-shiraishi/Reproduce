<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category; // Categoryモデルをインポート

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        \URL::forceScheme('https');  
        
        // すべてのビューにカテゴリを渡す
        View::composer('*', function ($view) {
            $categories = Category::all();
        
            $view->with('categories', $categories);
        });
    }

    public function register()
    {
        //
    }
}
