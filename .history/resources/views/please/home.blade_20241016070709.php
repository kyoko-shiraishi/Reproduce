<!-- ヘッダー（検索バー）ビュー -->
<x-app-layout>
<x-slot name="header">
@vite(['resources/css/app.css', 'resources/js/app.js'])
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
<h2>スレッド</h2>
<div class="each">
<ul>
    @foreach ($all_threads as $thread)
    <li>
        <a href="{{ route('post', ['id' => $thread->id]) }}">
                <strong>ユーザー:</strong> {{ $thread->user->name }}<br>
                <strong>会社名:</strong> {{ $thread->company->name }}<br>
                <strong>製品名:</strong> {{ $thread->product->name }}<br>
                <strong>カテゴリ: </strong>{{ $thread->product->category->name ?? '不明' }}<br>
                <strong>内容:</strong> {{ $thread->content }}<br>
                <strong>作成日:</strong> {{ $thread->created_at }}<br>
                
                
                <strong>コメント数: {{ $thread->posts->count() }}</strong> <!-- コメント数を表示 -->
                <div>
                <img src="{{ $thread->image }}" >
                </div>
                
        </a>
        @if($thread->isLikedByAuthUser())
            {{-- こちらがいいね済の際に表示される方で、likedクラスが付与してあることで星に色がつきます --}}
            <div class="flexbox">
            <i class="fa-regular fa-heart like-btn liked" id={{$thread->id}}></i>
            
            <p class="count-num">{{$thread->thread_likes->count()}}</p>
            </div>
        @else
            <div class="flexbox">
                <i class="fa-regular fa-heart like-btn liked" id={{$thread->id}}></i>
                <p class="count-num">{{$thread->thread_likes->count()}}</p>
            </div>
        @endif
    </li>
    <hr>
    @endforeach
</ul>
</div>
<script>
//     let likeBtn_list=[];
// //    console.log(`{{$all_threads}}`);
// const thread_lists=`{{$all_threads}}`;
// // console.log(thread_lists);
// thread_lists.forEach((element) => {
//     likeBtn_list[element.id]=docuemnt.getElementById(element.id);
//     console.log(likeBtn_list);
// });
   
    //いいねボタンのhtml要素を取得します。
        const likeBtns = document.querySelectorAll('.like-btn');
        // 配列になる→forEacnでまわす
        // console.log(likeBtns);
        //いいねボタンをクリックした際の処理を記述します。 
        likeBtns.forEach(likeBtn => {
        likeBtn.addEventListener('click',async(e)=>{
            console.log('いいねおされた');
            //クリックされた要素を取得しています。
            const clickedEl = e.target
            //クリックされた要素にlikedというクラスがあれば削除し、なければ付与します。これにより星の色の切り替えができます。      
            clickedEl.classList.toggle('liked')
            //記事のidを取得しています。
            const threadId = e.target.id
            //fetchメソッドを利用し、バックエンドと通信します。非同期処理のため、画面がかくついたり、真っ白になることはありません。
            const res = await fetch('/thread/like',{
                //リクエストメソッドはPOST
                method: 'POST',
                headers: {
                    //Content-Typeでサーバーに送るデータの種類を伝える。今回はapplication/json
                    'Content-Type': 'application/json',
                    //csrfトークンを付与
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                //バックエンドにいいねをした記事のidを送信します。
                body: JSON.stringify({ thread_id: threadId })
            })
            .then((res)=>res.json())
            .then((data)=>{
                console.log(data);
                //記事のいいね数がバックエンドからlikesCountという変数に格納されて送信されるため、それを受け取りビューに反映します。
                clickedEl.nextElementSibling.innerHTML = data.likesCount;
            })
            .catch(
            //処理がなんらかの理由で失敗した場合に実施したい処理を記述します。
            ()=>alert('処理が失敗しました。画面を再読み込みし、通信環境の良い場所で再度お試しください。'))
        });
        })
    </script>
@include('please.new_thread')
</x-app-layout>
 