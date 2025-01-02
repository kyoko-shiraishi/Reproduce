<x-app-layout>
    <ul>
        @foreach($threads as $thread)
        <li>
            {{$thread->product->name}}
        </li>
        @endforeach
    </ul>
</x-app-layout>