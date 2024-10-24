<!DOCTYPE html> <html lang="en"> 
<head> 
<meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<title>トップ</title>
 <style> 
 
.catchcopy{
    font-weight:900;
    font-size:60px;
}
.btn--orange,
a.btn--orange {
  color: #fff;
  background-color: #eb6100;
}
.btn--orange:hover,
a.btn--orange:hover {
  color: #fff;
  background: #f56500;
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
        <div class="btn btn--orange"> <a href="{{ route('login') }}"> <button>ログイン</button> </a> 
        </div>
        <!-- 新規ユーザー登録ボタン実装 --> 
        <div class="registerbutton"> <a href="{{route('register')}}"> <button>新規登録</button> </a> 
        </div> 
    </div>
</body>
 </html>
