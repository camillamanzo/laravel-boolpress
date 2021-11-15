
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card p-5">
            <h1 class="card-title"> {{$post->title}} </h1>
            <address class="card-subtitle"> Written by {{ $post->author }} </address>
            <address class="card-subtitle date"> {{ $post->date }} </address>

            <p class="card-body"> {{$post->content}}</p>
            <div class="card-footer back-to-list">
                <a href="{{route('admin.posts.index')}}" class="btn btn-toolbar">Back to the full list.</a>
            </div>
            
        </div>
    </div>
@endsection