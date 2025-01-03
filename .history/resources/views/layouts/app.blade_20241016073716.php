<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <script src="https://kit.fontawesome.com/e7550042f0.js" crossorigin="anonymous"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
        .each {
            width: 100%; /* 幅を100%に設定 */
            margin: 0; /* 左右のマージンを0に設定 */
            padding: 0; /* パディングを0に設定 */
        }

        .each ul {
            list-style-type: none; /* リストスタイルを消去 */
            padding: 0; /* パディングを0に設定 */
            margin: 0; /* マージンを0に設定 */
        }

        .each li {
            border: 1px solid #ccc; /* 各スレッドにボーダーを追加 */
            padding: 10px; /* 内側のパディングを設定 */
            margin-bottom: 10px; /* 各リスト項目の下にマージンを追加 */
            width: 100%; /* 各リスト項目も幅を100%に設定 */
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
