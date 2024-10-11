@extends('please.home')

@section('content')  
    <a href="{{ route('home') }}">
        @include('please.logo')
    </a>
    
    @include('please.navi')
    @include('please.search')
@endsection   


