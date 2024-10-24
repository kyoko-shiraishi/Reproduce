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
<!-- コメント対象のスレッド -->
<div class="thread-details border-4 border-black rounded-lg p-4 shadow-md mb-4">
    <h2>スレッド詳細</h2>
    <p>ユーザー: {{ $thread->user->name ?? '不明' }}</p>
    <p>会社名: {{ $thread->company->name ?? '不明' }}</p>
    <p>商品名: {{ $thread->product->name ?? '不明' }}</p>
    <p>カテゴリー: {{ $thread->category->name ?? '不明' }}</p>
    <p>いいね数：{{ $thread->thread_likes->count() ?? '不明'}}</p>
    <p>内容: {{ $thread->content ?? '不明' }}</p>

    <img src="{{ $thread->image }}" >

</div>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif 
<h3>コメント一覧</h3>
<div class="comment_list">
@if($eachpost->isEmpty())
        <p>コメントは0件です</p>
@else
    @foreach($eachpost as $post)
        <div class="border-4 border-black rounded-lg p-4 shadow-md">
            <p>ユーザー: {{ $post->user->name ?? '不明' }}</p>
            <p>コメント: {{ $post->content ?? '不明' }}</p>
            <p>作成日: {{ $post->created_at ?? '不明' }}</p>
            <p>いいね数: {{ $post->post_likes->count() ?? '不明' }}</p>

        </div>    
    @endforeach
    @endif
</div>

@include('please.new_post')

</x-app-layout>

