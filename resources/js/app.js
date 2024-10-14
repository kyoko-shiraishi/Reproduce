import './bootstrap'; // 既存のコード
import Alpine from 'alpinejs'; // 既存のコード
import Echo from 'laravel-echo'; // Laravel Echoのインポート
import Pusher from 'pusher-js'; // Pusherのインポート

window.Alpine = Alpine; // 既存のコード

// PusherとLaravel Echoの設定
window.Pusher = Pusher; // Pusherをウィンドウに追加

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
    encrypted: true,
});

// Alpineの初期化
Alpine.start(); // 既存のコード

// いいねボタンのクリックイベントを設定
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.like-button').forEach(button => {
        button.addEventListener('click', function() {
            const threadId = this.getAttribute('data-thread-id');

            // AJAXリクエストを送信していいねをサーバーに記録
            fetch(`/like/${threadId}`, { // いいねのAPIエンドポイントにリクエストを送る
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ thread_id: threadId }),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // いいね数を更新
                    const likeCountElement = document.getElementById(`like-count-${threadId}`);
                    likeCountElement.innerText = parseInt(likeCountElement.innerText) + 1; // いいね数をインクリメント

                    // Pusherでいいねイベントをブロードキャスト
                    window.Echo.private(`thread.${threadId}`)
                        .whisper('thread.liked', {
                            user_id: data.user_id,
                            thread_id: threadId,
                        });
                } else {
                    console.error('Error:', data.message);
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });
        });

        // いいねイベントをリッスンする
        const threadId = button.getAttribute('data-thread-id');
        window.Echo.private(`thread.${threadId}`)
            .listen('ThreadLiked', (event) => {
                // いいね数を更新
                const likeCountElement = document.getElementById(`like-count-${event.thread_id}`);
                likeCountElement.innerText = parseInt(likeCountElement.innerText) + 1; // いいね数をインクリメント
            });
    });
});
