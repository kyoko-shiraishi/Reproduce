<x-app-layout>
@vite(['resources/css/app.css', 'resources/js/app.js'])
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- ヘッダーに検索バー -->
            <p>検索してね</p>
            <form action="{{ route('search.results') }}" method="GET"> <!-- アクションを指定 -->
    <input type="text" id="company_name" name="company_name" placeholder="会社名">
    <input type="text" name="product_name" placeholder="製品名">
    <input type="hidden" id="Kanacompany_name" name="Kanacompany_name">
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
                <div class="border-4 border-blue-400 rounded-lg p-4 shadow-md flex flex-col items-start shadow-md">
                    
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





<script>
        document.getElementById('company_name').addEventListener('input', function() {
            const companyName = this.value;
            const KanaCompanyName = wanakana.toKatakana(companyName);
            document.getElementById('Kanacompany_name').value = KanaCompanyName; // 隠しフィールドに設定
            console.log(KanaCompanyName); // デバッグ用
            
        });
    </script>