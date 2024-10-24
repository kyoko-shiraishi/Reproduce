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
    display       : inline-block;
  border-radius : 5%;          /* 角丸       */
  font-size     : 18pt;        /* 文字サイズ */
  text-align    : center;      /* 文字位置   */
  cursor        : pointer;     /* カーソル   */
  padding       : 12px 12px;   /* 余白       */
  background    : #007fff;     /* 背景色     */
  color         : #ffffff;     /* 文字色     */
  line-height   : 1em;         /* 1行の高さ  */
  transition    : .3s;         /* なめらか変化 */
  box-shadow    : 1px 1px 3px #666666;  /* 影の設定 */
  border        : 2px solid #007fff;    /* 枠の指定 */ 
  text-decoration: none;       /* リンクの下線を消す */
}
.login-button:hover {
  box-shadow    : none;        /* カーソル時の影消去 */
  color         : #007fff;     /* 背景色     */
  background    : #ffffff;     /* 文字色     */
}

 </style> 
</head> 
<body> 
    <div class="yoko">
        
        <div class="catchcopy">廃盤商品を<br>知って<br>語って<br>リクエストしよう！</div> 
        <div class="logo"> 
            @include('please.logo') 
        </div>
    <div class="yoko">
        <!-- ログインボタン実装 -->
        <a href="{{ route('login') }}" class="login-button"> ログイン </a> 
        <!-- 新規ユーザー登録ボタン実装 --> 
         <a href="{{route('register')}}" class="register-button"> <button>新規登録</button> </a> 
    </div>   
    
</body>
 </html>
