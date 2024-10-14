<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1>新規コメント作成ページ</h1>  
<form action="{{ route('post_store', $thread->id) }}" method="POST">
    @csrf
    <input type="hidden" name="thread_id" value="{{ $thread->id }}">
    
    <p>ユーザー： {{ auth()->user()->name }}</p>
    <input type="hidden" name="user" value="{{ auth()->user()->name }}">
    
    <div>
        <label for="content">コメント内容:</label>
        <textarea name="content" id="content" rows="4" required></textarea>
    </div>
    <button type="submit">コメントを投稿</button><br>
    
</form>
</body> 
</html>