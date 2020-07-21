@extends('layouts.master')
@section('title','Товары всех категорий')
@section('content')


        @foreach($categories as $category)
            <div class="panel">
                <a href="{{ route('category',$category->code) }}">
                    <img src="http://internet-shop.tmweb.ru/storage/categories/mobile.jpg">
                    <h2>{{$category->name}}</h2>
                </a>
                <p>
                    {{$category->description}}
                </p>
            </div>
        @endforeach




@endsection
