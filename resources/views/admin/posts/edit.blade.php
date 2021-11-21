@extends('layouts.app')

@section('content')

    <div class="container">
        <header>
            <h1>Edit "{{ $post->title }}"</h1>
        </header>

        <section id="post-form">
            <form action="{{route('admin.posts.update', $post)}}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg" id="title" name="title" value="{{ $post->title }}" required>
                </div>

                <div class="form-group">
                    <label for="category_id">Categories:</label>
                    <br>
                    <select name="category_id" id="category_id">
                        <option value="">None</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <legend class="h5">Tags</legend>
                    <div class="form-check form-check-inline">    

                        @foreach ($tags as $tag)
                            <input type="checkbox" class="form-check-input mx-2" id="tag-{{ $tag->id }}" value="{{$tag->id}}" name="tags[]" @if (in_array($tag->id, old("tags", $tagIds ? $tagIds : [] ))) checked @endif >

                            <label class="form-check-label me-2" for="tag-{{$tag->id}}">{{$tag->name}}</label>    
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label for="post_content">Content</label>
                    <textarea  class="form-control" type="textarea" placeholder="" id="post_content" name="post_content" required>{{ $post->content }}</textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Delete</button>
            </form>
        </section>
    </div>
    
@endsection