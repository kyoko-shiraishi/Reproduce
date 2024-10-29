<x-app-layout>
    <x-slot name="header">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <p>検索してね</p>
            <form action="{{ route('search.results') }}" method="GET"> 
                @csrf
                <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}" placeholder="会社名">
                <input type="text" name="product_name" value="{{ old('product_name') }}" placeholder="製品名">
               

                <select name="category_id">
                    <option value="">すべてのカテゴリ</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <button class="bg-gray-500 hover:bg-gray-400 text-white rounded px-4 py-2 button" type="submit">検索</button>

                <div class="sorting-dropdown">
                    <label for="sort">並び替え:</label>
                    <select id="sort" name="sort" onchange="location = this.value;">
                        <option value="{{ route('home', ['sort' => 'new']) }}" {{ $sort === 'new' ? 'selected' : '' }}>新しい順</option>
                        <option value="{{ route('home', ['sort' => 'old']) }}" {{ $sort === 'old' ? 'selected' : '' }}>古い順</option>
                        <option value="{{ route('home', ['sort' => 'popular']) }}" {{ $sort === 'popular' ? 'selected' : '' }}>人気順</option>
                    </select>
                </div>
            </form>
        </h2>
    </x-slot>

    <h2 class="threadList">スレッド一覧</h2>
    <div class="each">
        <!-- <ul> -->
            @foreach ($all_threads as $thread)
            <div class=" thread border-4 border-blue-400 rounded-lg p-4 shadow-md flex flex-col items-start">
                <!-- <li> -->
                    <a href="{{ route('post', ['id' => $thread->id]) }}">
                        <h3 class="user">ユーザー:{{ $thread->user->name }}</h3>
                    
                            <img src="{{ $thread->image }}" class="responsive-img">
                        
                        <h3 class="content">内容: {{ $thread->content }}</h3>
                        <h3 class="company">会社名: {{ $thread->company->name }}</h3>
                        <h3 class="product">製品名: {{ $thread->product->name }}</h3>
                        
                        </a>
                     <div class="yoko">
                        <!-- いいね -->
                        @if($thread->isLikedByAuthUser())
                        <div class="flexbox">
                            <i class="fa-regular fa-heart like-btn liked" id="{{ $thread->id }}"></i>
                            <p class="count-num">{{ $thread->thread_likes->count() }}</p>
                        </div>
                        @else
                        <div class="flexbox">
                            <i class="fa-regular fa-heart like-btn" id="{{ $thread->id }}"></i>
                            <p class="count-num">{{ $thread->thread_likes->count() }}</p>
                        </div>
                        @endif
                        <h3 class="comment">コメント数: {{ $thread->posts->count() }}</h3>
                        <h3 class="category">カテゴリ: {{ $thread->product->category->name ?? '不明' }}</h3>
                        <h3>作成日:{{ $thread->created_at }}</h3>
                        </div>   
                    

                   
                <!-- </li> -->
            </div>
           
            @endforeach
        <!-- </ul> -->
    </div>

   
<script>
        // いいねボタンのhtml要素を取得
        const likeBtns = document.querySelectorAll('.like-btn');
        likeBtns.forEach(likeBtn => {
            likeBtn.addEventListener('click', async (e) => {
                const clickedEl = e.target;
                clickedEl.classList.toggle('liked');
                const threadId = clickedEl.id;
                console.log({{Auth::user()->id}},"あいうえお")
                // if({{Auth::user()->id}}){
                    const res = await fetch('/thread/like', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ thread_id: threadId })
                    })
                    .then(res => {
                    console.log(res)
                         if (res.status ==419) {
                            console.log("せんい");

                         window.location.reload();
                            
                        }
                        return res.json();
                    })
                    .then(data => {
                        console.log(data)
                        clickedEl.nextElementSibling.innerHTML = data.likesCount;
                     
                    })
                    .catch(() => alert('処理が失敗しました。画面を再読み込みし、通信環境の良い場所で再度お試しください。'));
                    if(1){
                        console.log(res)   
                    }
                // }else{
                //     console.log('セッション切れ')
                // }
        });
    });
        document.addEventListener("DOMContentLoaded", function() {
    // URLパラメータを取得                 現在のURLの「クエリパラメータ」（URLの?以降の部分）を取得
    const urlParams = new URLSearchParams(window.location.search);
    // sort というクエリパラメータの値を取得
    const sortParam = urlParams.get('sort');

    // "sort" パラメータが "popular" の場合のみトップ3を強調表示
    if (sortParam === 'popular') {

        const threads = document.querySelectorAll(".thread");

        // 最初の3つのスレッドに特定のクラスを追加
        threads.forEach((thread, index) => {
            if (index < 3) {
                thread.classList.add(`top-thread-${index + 1}`); // top-thread-1, top-thread-2, top-thread-3 のクラスを付与
            }
        });
    }
});
   
</script>

@include('please.new_thread')
    <div class="flex justify-center">
        {{ $all_threads->links() }}
    </div>
</x-app-layout>
