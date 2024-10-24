<x-app-layout>
<h1 class="font-bold">新規スレッドコメント作成ページ</h1>  
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
</x-app-layout>

