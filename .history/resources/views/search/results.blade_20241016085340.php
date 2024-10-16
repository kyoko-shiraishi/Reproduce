<x-app-layout>
@vite(['resources/css/app.css', 'resources/js/app.js'])
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
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>検索結果</title>
        </head>
        <body>
    <h1>検索結果</h1>

    @if($threads->isEmpty())
        <p>該当するスレッドは見つかりませんでした。</p>
    @else
        <div class="grid grid-cols-1 gap-4">
            @foreach($threads as $thread)
            <a href="{{ route('post', ['id' => $thread->id]) }}">
                <div class="border-4 border-black rounded-lg p-4 shadow-md">
                    <h3 class="font-semibold text-lg">{{ $thread->title }}</h3>
                    <p>会社名: {{ $thread->company->name ?? '不明' }}</p>
                    <p>製品名: {{ $thread->product->name ?? '不明' }}</p>
                    <p>カテゴリ: {{ $thread->product->category->name ?? '不明' }}</p>
                    <p>{{ $thread->content }}</p>
                    <p>投稿：{{ $thread->created_at ? $thread->created_at->format('Y年m月d日 H:i:s') : '不明' }}</p>
                    <p>いいね数: {{ $thread->thread_likes->count() }}</p>

                    <div>
                <img src="{{ $thread->image }}" >
                </div>

                </div>
            </a>    
            @endforeach
        </div>
    @endif
</body>

    </html>
</x-app-layout>





