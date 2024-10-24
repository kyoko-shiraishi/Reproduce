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
    <div class="new-button">
            <button class="bg-gray-500 hover:bg-gray-400 text-white rounded px-4 py-2" type="submit">投稿</button>
     </div>
</form>
</x-app-layout>

