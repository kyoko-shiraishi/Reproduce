<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])


        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
      
        <!-- Scripts -->
        <script src="https://kit.fontawesome.com/e7550042f0.js" crossorigin="anonymous"></script>

        <style>
        .threadList{
        text-align:center;
        }
        .each {
           
            width: 100%; /* 幅を100%に設定 */
            margin: 0; /* 左右のマージンを0に設定 */
            padding: 0; /* パディングを0に設定 */
        }

        .each {
            display:flex;
            flex-wrap:wrap;/* 折り返し */
            list-style-type: none; /* リストスタイルを消去 */
            width:100%;
            margin:0px;
        }  

        a{
            width:100%;
        }

        
       .like-btn{
        z-index:10;
        
       }  
        

        .each li {
            /* border: 1px solid #ccc; 各スレッドにボーダーを追加 */
            padding: 0px; /* 内側のパディングを設定 */
            margin-bottom: 10px; /* 各リスト項目の下にマージンを追加 */
            width: 1250x; 
            margin:0 auto 50px;
        }
        @media screen and (min-width:380px){
            .border-4.border-blue-400.rounded-lg.p-4.shadow-md.flex.items-start{
                width:46%;
                margin:20px 2%;  
            }   
        }
        @media screen and (max-width:379.9px){
            .border-4.border-blue-400.rounded-lg.p-4.shadow-md.flex.items-start{
               margin:10px 0;
            }   
        }
        .liked{
            color:orangered;
            transition:.2s;
        }
        .flexbox{
            align-items: center;
            display: flex;
        }
        .count-num{
            font-size: 20px;
            margin-left: 10px;
        }
        .fa-heart{
            font-size: 30px;
        }
        .responsive-img {
            /* max-width: 100%; 画像の最大幅を親要素に合わせる */
            /* width: 500px; 画像の幅を固定 */
            /* height: 200px; 画像の高さを固定 */
            /* object-fit: cover; 縦横比を維持しつつ、指定したサイズに収まるように調整 */
            /* border-radius: 8px; 角を少し丸くしたい場合 */
            width:100%;
            
        }
        .content{
            margin-bottom:50px;
        }
        .yoko{
            display:flex;
            justify-content:space-around;
        }
        .top-thread-1 {
        
            background: linear-gradient(45deg, #c0b283 0%, #c0b283 45%, #FEE9A0 70%, #c0b283 85%, #c0b283 90% 100%);
  background-size: 800% 400%;
  animation: gradient 5s infinite cubic-bezier(.62, .28, .23, .99) both;
        }
        @keyframes gradient {
  0% {
    background-position: 0% 50%;
  }

  50% {
    background-position: 100% 50%;
  }

  100% {
    background-position: 0% 50%;
  }
}
        .top-thread-2 {
            
            background-color: blue;
        }

        .top-thread-3 {
            
            background-color: green;
        }

        .comment_list{
            margin:20px;
        }
        .font-bold{
            margin-bottom:20px;
        }
        .button{
            margin:20px;
        }

    </style>
  
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
