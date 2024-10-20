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
        <x-input-label for="age" :value="__('生年月日')" />
            <input type="date" name="age" value="{{old('age')}}" required>
        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
    </div>

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
            <a href="{{ route('index') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
