
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card p-5">
            <h1 class="card-title"> {{$post->title}} </h1>
            <address class="card-subtitle"> di {{ $post->user->name }} </address>
            <address class="card-subtitle date"> {{ $post->date }} </address>
            <div>
                @if ($post->category)
                    <span class="badge badge-primary px-2">{{ $post->category->name }}</span>
                @else
                    No category chosen
                @endif
            </div>
            <p class="card-body"> {{$post->content}}</p>
            {{-- <div class="card-footer back-to-list"> --}}
                <a href="{{route('admin.posts.index')}}">Back to the full list.</a>
            {{-- </div> --}}
            
        </div>
    </div>
@endsection