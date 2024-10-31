<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('名前')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('メールアドレス')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
       <!-- Prefecture -->
        <div class="mt-4">
            <x-input-label for="prefecture" :value="__('都道府県')" />
            <select id="prefecture" name="prefecture_id" class="block mt-1 w-full" required>
                <option value="">選択してください</option>
                @foreach ($prefectures as $prefecture)
            <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
        @endforeach
               
            </select>
            <x-input-error :messages="$errors->get('prefecture')" class="mt-2" />
        </div>

    <!-- Gender -->
    <div class="mt-4">
        <x-input-label for="gender" :value="__('性別')" />
            <select id="gender" name="gender" class="block mt-1 w-full" required>
                <option value="">選択してください</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>男性</option>

                <option value="female" {{ old('gender') == 'female' ? 'selected':''}}>女性</option>
                <option value="other" {{ old('gender') == 'binary' ? 'selected': ''}}>どちらでもない</option>
            </select>
        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
    </div>

     <!-- age -->
   
<div class="mt-4">
        <x-input-label for="year" :value="__('西暦')" />
        <select name="year" id="year" required onchange="updateAge()">
            <option value="" disabled selected>-- 西暦を選択 --</option>
            @for ($i = 1900; $i <= date('Y'); $i++)
                <option value="{{ $i }}" {{ old('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>
        <x-input-error :messages="$errors->get('year')" class="mt-2" />

        <x-input-label for="month" :value="__('生まれ月')" class="mt-4" />
        <input type="text" name="month" id="month" value="{{ old('month') }}" placeholder="例: 1または01" required pattern="^(0?[1-9]|1[0-2])$" onchange="updateAge()" />
        <x-input-error :messages="$errors->get('month')" class="mt-2" />

        <x-input-label for="day" :value="__('日にち')" class="mt-4" />
        <input type="text" name="day" id="day" value="{{ old('day') }}" placeholder="例: 1または01" required pattern="^(0?[1-9]|[12][0-9]|3[01])$" onchange="updateAge()" />
        <x-input-error :messages="$errors->get('day')" class="mt-2" />
    <input type="hidden" name="age" id="age" value="{{ old('age') }}">
</div>

<script>
    // 生成したageStringをサーバーに送るためのフォームであるname="age"のデータとして入れてあげる
function updateAge() {
    const year = document.getElementById('year').value;
    const month = document.getElementById('month').value.padStart(2, '0'); // padStart:2桁になるまで先頭に0追加
    const day = document.getElementById('day').value.padStart(2, '0'); 


    if (year && month && day) {// 全ての値が入っていたら
        const ageString = `${year}-${month}-${day}`; // "YYYY-MM-DD"形式に結合
        document.getElementById('age').value = ageString; // 隠しフィールド（サーバー送信用）ageの中身として設定
    } else {
        document.getElementById('age').value = ''; // どれかが未選択の場合はクリア
    }
}
</script>



        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('パスワードを設定')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('確認用')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('welcome') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('戻る') }}
            </a>

            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ms-4" href="{{ route('login') }}">
                {{ __('上記の内容でよろしいですか?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('登録') }}
            </x-primary-button>
        </div>

        </div>
    </form>
</x-guest-layout>
