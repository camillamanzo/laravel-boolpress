
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card border-light mt-5">
            <div class="card-header bg-transparent">
                <h1> {{$post->title}} </h1>
            </div>
            <div class="card-body">
                <div class="pb-3">
                    @forelse ($post->tags as $tag)
                                
                        <span class="bagde badge-pill" style="background-color: {{ $tag->color}}; color: white ">{{$tag->name}}</span>
                    @empty
                        No Tags
                    @endforelse
                </div>
                <div>
                    @if ($post->category)
                        <span> Category: {{ Str::upper($post->category->name) }}</span>
                    @else
                        No category chosen
                    @endif
                </div>
                <blockquote class="blockquote mb-0">
                    <p class="card-body"> {{$post->content}}</p>
                    <footer class="blockquote-footer">
                         <cite title="Source Title">{{ ucfirst($post->user->name) }}, {{ $post->date }}.</cite>
                    </footer>
                </blockquote>
            </div>
        </div>

        <div class="py-5">
            <a href="{{route('admin.posts.index')}}"><h4>Back to the full list</h4></a>
        </div>
        
    </div>
@endsection