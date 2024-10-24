<!DOCTYPE html> <html lang="en"> 
<head> 
<meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<title>トップ</title>
 <style> 
 .yoko{
            display:flex;
            justify-content:space-around;
        }
.catchcopy{
    font-weight:900;
}
 </style> 
</head> 
<body> 
    <div class="yoko">
        <div class="logo"> 
        @include('please.logo') 
        </div> 
        <div class="catchcopy">廃盤商品を知って、語って、リクエストしよう！
        </div> 
        <!-- ログインボタン実装 -->
        <div class="login-button"> <a href="{{ route('login') }}"> <button>ログイン</button> </a> 
        </div>
        <!-- 新規ユーザー登録ボタン実装 --> 
        <div class="registerbutton"> <a href="{{route('register')}}"> <button>新規登録</button> </a> 
        </div> 
    </div>
</body>
 </html>
