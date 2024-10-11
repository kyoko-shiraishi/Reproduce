<!-- ヘッダー（検索バー）ビュー -->
<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- ヘッダーに検索バー -->
            <p>検索してね</p>
            <form action="{{ route('search.results') }}" method="GET"> <!-- アクションを指定 -->
    <input type="text" name="company_name" value="{{ old('company_name') }}" placeholder="会社名">
    <input type="text" name="product_name" value="{{ old('product_name') }}" placeholder="製品名">
    <select name="category_id">
        <option value="">すべてのカテゴリ</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <input type="submit" value="検索">
</form>


        </h2>
    </x-slot>
<p>ここにスレッドを表示</p>
<div class="each">
<ul>
    @foreach ($all_threads as $thread)
    <li>
        <a href="{{ route('post', ['id' => $thread->id]) }}">
                <strong>ユーザー:</strong> {{ $thread->user->name }}<br>
                <strong>会社名:</strong> {{ $thread->company->name }}<br>
                <strong>製品名:</strong> {{ $thread->product->name }}<br>
                <strong>内容:</strong> {{ $thread->content }}<br>
                <strong>作成日:</strong> {{ $thread->created_at }}<br>
                <strong>いいね数: {{ $thread->thread_likes->count() }}</strong>
        </a>
    </li>
    <hr>
    @endforeach
</ul>
</div>

</x-app-layout>
 