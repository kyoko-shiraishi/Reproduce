<!DOCTYPE html> <html lang="en"> 
<head> 
<meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<title>トップ</title>
 <style> 
 
.catchcopy{
    font-weight:900;
    font-size:60px;
}
.login-button{

}
 </style> 
</head> 
<body> 
    <div class="yoko">
        
        <div class="catchcopy">廃盤商品を<br>知って<br>語って<br>リクエストしよう！</div> 
        <div class="logo"> 
        @include('please.logo') 
        </div> 
        <!-- ログインボタン実装 -->
        <div > <a href="{{ route('login') }}" class="btn btn--orange"> ログイン </a> 
        </div>
        <!-- 新規ユーザー登録ボタン実装 --> 
        <div class="registerbutton"> <a href="{{route('register')}}"> <button>新規登録</button> </a> 
        </div> 
    </div>
</body>
 </html>
