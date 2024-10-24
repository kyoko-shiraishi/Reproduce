<x-app-layout>
    <x-slot name="header">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <p>検索してね</p>
            <form action="{{ route('search.results') }}" method="GET"> 
                @csrf
                <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}" placeholder="会社名">
                <input type="text" name="product_name" value="{{ old('product_name') }}" placeholder="製品名">
                <input type="hidden" id="Kanacompany_name" name="Kanacompany_name">
                <select name="category_id">
                    <option value="">すべてのカテゴリ</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <div class="sorting-dropdown">
                    <label for="sort">並び替え:</label>
                    <select id="sort" name="sort" onchange="location = this.value;">
                        <option value="{{ route('home', ['sort' => 'new']) }}" {{ $sort === 'new' ? 'selected' : '' }}>新しい順</option>
                        <option value="{{ route('home', ['sort' => 'old']) }}" {{ $sort === 'old' ? 'selected' : '' }}>古い順</option>
                        <option value="{{ route('home', ['sort' => 'popular']) }}" {{ $sort === 'popular' ? 'selected' : '' }}>人気順</option>
                    </select>
                </div>
                <input type="submit" value="検索">

               
            </form>
        </h2>
    </x-slot>

    <h2>スレッド一覧</h2>
    <div class="each">
        <ul>
            @foreach ($all_threads as $thread)
            <div class="border-4 border-blue-400 rounded-lg p-4 shadow-md flex items-start">
                <li>
                    <a href="{{ route('post', ['id' => $thread->id]) }}">
                        <strong>ユーザー:</strong> {{ $thread->user->name }}<br>
                        <strong>会社名:</strong> {{ $thread->company->name }}<br>
                        <strong>製品名:</strong> {{ $thread->product->name }}<br>
                        <strong>カテゴリ:</strong> {{ $thread->product->category->name ?? '不明' }}<br>
                        <strong>内容:</strong> {{ $thread->content }}<br>
                        <strong>作成日:</strong> {{ $thread->created_at }}<br>
                        <strong>コメント数: {{ $thread->posts->count() }}</strong>
                        <div>
                            <img src="{{ $thread->image }}" class="responsive-img">
                        </div>
                    </a>

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
                </li>
            </div>
            <hr>
            @endforeach
        </ul>
    </div>
    <script src="https://unpkg.com/wanakana"></script>
    
    <script>
        document.getElementById('company_name').addEventListener('input', function() {
            const companyName = this.value;
            const KanaCompanyName = wanakana.toKatakana(companyName);
            document.getElementById('Kanacompany_name').value = KanaCompanyName; // 隠しフィールドに設定
            console.log(KanaCompanyName); // デバッグ用
            
        });
    </script>
   
<script>
        // いいねボタンのhtml要素を取得
        const likeBtns = document.querySelectorAll('.like-btn');
        likeBtns.forEach(likeBtn => {
            likeBtn.addEventListener('click', async (e) => {
                const clickedEl = e.target;
                clickedEl.classList.toggle('liked');
                const threadId = clickedEl.id;

                const res = await fetch('/thread/like', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ thread_id: threadId })
                })
                .then(res => res.json())
                .then(data => {
                    clickedEl.nextElementSibling.innerHTML = data.likesCount;
                })
                .catch(() => alert('処理が失敗しました。画面を再読み込みし、通信環境の良い場所で再度お試しください。'));
            });
        });
</script>

@include('please.new_thread')
    <div class="flex justify-center">
        {{ $all_threads->links() }}
    </div>
</x-app-layout>
