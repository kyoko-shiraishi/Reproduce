<!-- 新規スレッド作成用ボタン -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>固定ボタンの例</title>
    <style>
        /* ボタンのスタイル */
.fixed-button {
    position: fixed; /* 画面に固定 */
    right: 20px; /* 画面右からの距離 */
    bottom: 20px; /* 画面下からの距離 */
    width: 60px; /* ボタンの幅 */
    height: 60px; /* ボタンの高さ */
    background-color: #1DA1F2; /* ツイッターっぽい青色 */
    color: white; /* テキストの色 */
    font-size: 36px; /* テキストの大きさ */
    text-align: center; /* テキストを中央に配置 */
    line-height: 60px; /* ボタンの高さと同じにして中央揃え */
    border-radius: 50%; /* 丸くする */
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* 影をつける */
    cursor: pointer; /* ポインターを変更 */
    transition: background-color 0.3s; /* ホバー時のエフェクト */
}

/* ホバー時の効果 */
.fixed-button:hover {
    background-color: #0077b5; /* 少し濃い色に変更 */
}

    </style>
</head>
<body>
    <!-- 他のコンテンツ -->
    
    <!-- 固定された丸いボタン -->
    <div class="fixed-button" id="postButton">
        ＋
    </div>

   
</body>
</html>
