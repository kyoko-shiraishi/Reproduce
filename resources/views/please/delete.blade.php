<x-app-layout>
    <h2>削除したいスレッドとポストを選択してください</h2>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('delete_selected') }}" method="POST">
        @csrf

        <h3>スレッド一覧</h3>
        <div class="grid grid-cols-1 gap-4">
            <ul>
                @foreach ($threads_you_created as $thread)
                    <li class="border-4 border-black rounded-lg p-4 shadow-md flex items-start">
                        <input type="checkbox" name="threads[]" value="{{ $thread->id }}" class="mr-2">
                        <div class="flex-1">
                            <strong>ユーザー:</strong> {{ $thread->user->name }}<br>
                            <strong>会社名:</strong> {{ $thread->company->name }}<br>
                            <strong>製品名:</strong> {{ $thread->product->name }}<br>
                            <strong>カテゴリ: </strong>{{ $thread->product->category->name ?? '不明' }}<br>
                            <strong>内容:</strong> {{ $thread->content }}<br>
                            <strong>作成日:</strong> {{ $thread->created_at }}<br>
                            <strong>いいね数: {{ $thread->thread_likes->count() }}</strong><br>
                            <strong>コメント数: {{ $thread->posts->count() }}</strong>
                            <img src="{{ $thread->image }}" alt="スレッド画像">
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <h3>ポスト一覧</h3>
        <div class="grid grid-cols-1 gap-4">
            @foreach($posts_you_created as $post)
                <div class="border-4 border-black rounded-lg p-4 shadow-md">
                    <input type="checkbox" name="posts[]" value="{{ $post->id }}" class="mr-2">
                    <p>ユーザー: {{ $post->user->name ?? '不明' }}</p>
                    <p>コメント: {{ $post->content ?? '不明' }}</p>
                    <p>作成日: {{ $post->created_at ?? '不明' }}</p>
                    <p>いいね数: {{ $post->post_likes->count() ?? '不明' }}</p>
                </div>    
            @endforeach
        </div>

        <button type="submit" class="btn btn-danger">削除</button>
    </form>
</x-app-layout>
