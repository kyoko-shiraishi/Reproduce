<!-- 遷移先ページ -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <h1>新規スレッド作成ページ</h1>  
  <form action="{{route('thread_store')}}" method="post">
    <p>タイトル：</p>
    <input type="text" name="title" placeholder="タイトル"/><br>
    <p>メッセージ：</p>
    <textarea name="message" placeholder="お気に入りの商品。ぜひ再販してほしい！"></textarea><br>
    <input type="submit" value="実行"/>
</form>
</body>
</html>  