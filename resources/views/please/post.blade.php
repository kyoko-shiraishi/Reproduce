<!-- スレッドクリック→遷移先のビュー -->
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
<p>ここにそのスレッドに関するポストを表示</p>
<div class="grid grid-cols-1 gap-4">
            @foreach($eachpost as $post)
                <div class="border-4 border-black rounded-lg p-4 shadow-md">
                    <p>ユーザー: {{ $post->user->name ?? '不明' }}</p>
                    <p>コメント: {{ $post->content ?? '不明' }}</p>
                    <p>いいね数: {{ $post->post_likes->count() ?? '不明' }}</p>
                </div>    
            @endforeach
        </div>
</x-app-layout>
