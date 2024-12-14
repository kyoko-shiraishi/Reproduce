<x-app-layout>
    <x-slot name="header">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <p>検索してね</p>
            <form action="{{ route('search.results') }}" method="GET">
                @csrf
                <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}" placeholder="会社名">
                <input type="text" name="product_name" value="{{ old('product_name') }}" placeholder="製品名">


                <select name="category_id">
                    <option value="">すべてのカテゴリ</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <button class="bg-gray-500 hover:bg-gray-400 text-white rounded px-4 py-2 button" type="submit">検索</button>

            </form>
        </h2>
    </x-slot>
    <p>現在ページ作成中！しばしお待ちを！</p>

</x-app-layout>