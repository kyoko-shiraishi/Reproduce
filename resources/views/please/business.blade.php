<x-app-layout>
    <x-slot name="header">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <p>検索してね</p>
            <form action="{{ route('search.results') }}" method="GET">
                @csrf
                <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}" placeholder="会社名">



                <button class="bg-gray-500 hover:bg-gray-400 text-white rounded px-4 py-2 button" type="submit">検索</button>

            </form>
        </h2>
    </x-slot>
    <a href="{{ route('excell') }}">エクセルデータを表示</a>
    <h1>企業一覧</h1>
    <ul>
        @foreach ($companies as $company)
        <li>
            <a href="{{ route('dataShow', ['id' => $company->id]) }}">{{ $company->name }}</a>
        </li>
        @endforeach
    </ul>


</x-app-layout>