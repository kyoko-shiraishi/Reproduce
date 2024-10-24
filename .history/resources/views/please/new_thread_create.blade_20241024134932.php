
<!-- 遷移先ページ -->

<x-app-layout>
    <h1>新規スレッド作成ページ</h1>  
    <form action="{{ route('thread_store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <p>ユーザー：{{Auth::user()->name}}</p>

        <p>会社名：</p>
        <input type="text" name="company" placeholder="会社名"><br>
        
        <p>商品名：</p>
        <input type="text" name="product" placeholder="商品名"><br>
        
        <p>カテゴリー：</p>
        <select name="category_id">
            <option value="">選択してください</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select><br>
        
        <p>メッセージ：</p>
        <textarea name="content" placeholder="素敵な投稿をどうぞ！"></textarea><br>
        <div>
        <label for="image">画像をアップロード:</label>
        <div class="image">
                <input type="file" name="image">
            </div>
        <input type="submit" value="実行"/>
    </form>
</x-app-layout>
<!-- categories→Categoryモデルのデータ全て取得 -->

 <!-- option→categoryテーブルのidプロパティをvalue,nameにnameプロパティ -->

