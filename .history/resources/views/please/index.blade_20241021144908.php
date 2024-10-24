<!DOCTYPE html> <html lang="en"> 
<head> 
<meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<title>トップ</title>
 <style> 
 </style> 
</head> 
<body> <div class="logo"> 
@include('please.logo') 
</div> 
<div class="catchcopy">キャッチーなフレーズ（仮）
</div> 
<!-- ログインボタン実装 -->
 <div class="login-button"> <a href="{{ route('login') }}"> <button>ログイン</button> </a> 
</div>
 <!-- 新規ユーザー登録ボタン実装 --> 
<div class="registerbutton"> <a href="{{route('register')}}"> <button>新規登録</button> </a> 
</div> 
</body>
 </html>
