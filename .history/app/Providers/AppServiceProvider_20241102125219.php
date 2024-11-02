<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category; // Categoryモデルをインポート

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
         // 環境に応じてHTTPSを強制
         if (config('app.env') !== 'local') {
            URL::forceScheme('https');
            
            // セキュアなアセットURLの設定
            $this->app['request']->server->set('HTTPS', 'on');
            
            // セキュアなクッキーの設定
            config(['session.secure' => true]);
        }

        // HTTPSリダイレクトミドルウェアの登録
        $this->app['router']->pushMiddlewareToGroup('web', \App\Http\Middleware\HttpsProtocol::class); 
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
