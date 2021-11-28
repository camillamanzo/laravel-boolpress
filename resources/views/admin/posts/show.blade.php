
@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card border-light mt-5">

            {{-- card header with post title --}}
            <div class="card-header bg-transparent">
                <h1> {{$post->title}} </h1>
            </div>

            {{-- card body --}}
            <div class="card-body d-flex">

                {{-- image div --}}
                <div class="col-4 align-self-center">
                    {{-- using the function -getImagePrefix- and concatenating it to post image --}}
                    <img class="img-fluid" style="width:300px" src="{{ $post->getImagePrefix() . $post->image }}" alt="Post image">
                </div>

                {{-- post info div --}}
                <div class="col-8">

                    {{-- tags div --}}
                    <div class="pb-3">
                        @forelse ($post->tags as $tag)
                            <span class="bagde badge-pill" style="background-color: {{ $tag->color}}; color: white ">{{$tag->name}}</span>
                        @empty
                            No Tags
                        @endforelse
                    </div>

                    {{-- category div (if category is chosen = display name) --}}
                    <div>
                        @if ($post->category)
                            <span> Category: {{ Str::upper($post->category->name) }}</span>
                        @else
                            No category chosen
                        @endif
                    </div>

                    {{-- content div with author and date --}}
                    <blockquote class="blockquote mb-0">
                        <p class="card-body"> {{$post->content}}</p>
                        <footer class="blockquote-footer">
                            <cite title="Source Title">{{ ucfirst($post->user->name) }}, {{ $post->date }}.</cite>
                        </footer>
                    </blockquote>

                </div>
            </div>

            <div class="d-flex justify-content-between p-5">
                <form class="delete-item" action="{{route('admin.posts.destroy', $post->id )}}" method="POST" data-post-title="{{ $post->title }}">
                    @csrf
                    @method('DELETE')
        
                    <button class="btn btn-danger px-5" type="submit">Delete</button>
                </form>
                <a href="{{ route('admin.posts.edit', $post ) }}" class="btn btn-primary px-5">Edit</a>
            </div>
        </div>

        <div class="py-5">
            <a href="{{route('admin.posts.index')}}"><h4>Back to the full list</h4></a>
        </div>
        
    </div>
@endsection