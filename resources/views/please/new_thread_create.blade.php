<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 新規スレッド作成ページ -->
</head>
<body>
    <h1>新規スレッド作成ページ</h1>  
    <form action="{{ route('thread_store') }}" method="post">
        @csrf
        <p>ユーザー：</p>
        <input type="text" name="user" placeholder="ユーザー名"><br>
        
        <p>会社名：</p>
        <input type="text" name="company" placeholder="会社名"><br>
        
        <p>商品名：</p>
        <input type="text" name="product" placeholder="商品名"><br>
        
        <p>カテゴリー：</p>
        <select name="category_id">
            <option value="">選択してください</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select><br>
        
        <p>メッセージ：</p>
        <textarea name="message" placeholder="お気に入りの商品。ぜひ再販してほしい！"></textarea><br>
        
        <input type="submit" value="実行"/>
    </form>
</body>
</html>
