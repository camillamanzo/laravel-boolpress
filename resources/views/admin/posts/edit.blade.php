@extends('layouts.app')

@section('content')

    <div class="container mt-3">
        <header class="pb-3">
            <h1>Edit "{{ $post->title }}"</h1>
        </header>

        <section id="post-form">
            <form action="{{route('admin.posts.update', $post)}}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- adding PATCH method to add to POST and update data --}}
                @method('PATCH')

                {{-- categories section --}}
                <div class="form-group">
                    <label for="category_id">Categories:</label>
                    <br>
                    <select class="border-top-0 border-left-0 border-right-0 bg-white px-3 py-1" name="category_id" id="category_id">

                        <option value="">None</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach

                    </select>
                </div>

                {{-- tags section --}}
                <div class="form-group">
                    <legend class="h5">Tags</legend>
                    <div class="form-check form-check-inline">    

                        @foreach ($tags as $tag)
                            <input type="checkbox" class="form-check-input mx-2" id="tag-{{ $tag->id }}" value="{{$tag->id}}" name="tags[]" @if (in_array($tag->id, old("tags", $tagIds ? $tagIds : [] ))) checked @endif >
                            <label class="form-check-label me-2" for="tag-{{$tag->id}}">{{$tag->name}}</label>    
                        @endforeach

                    </div>
                </div>

                {{-- image section --}}
                <div class="form-group">

                    <label for="image">Image:</label>
                    <div class="custom-file">
                        <input type="file" class="form-control" id="image" name="image" for="image" value="{{ old('image', $post->image) }}">
                        <label class="custom-file-label" for="image" name="image">Choose file...</label>
                    </div>

                </div>

                {{-- title section --}}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control form-control-lg" type="text" id="title" name="title" value="{{ $post->title }}" required>
                </div>

                {{-- content section --}}
                <div class="form-group">
                    <label for="post_content">Content</label>
                    <textarea  class="form-control" type="textarea" placeholder="" id="post_content" name="post_content" required>{{ $post->content }}</textarea>
                </div>
                
                <div class="pt-5 d-flex justify-content-between">
                    <button type="reset" class="btn btn-danger px-5">Delete</button>
                    <button type="submit" class="btn btn-primary px-5">Submit</button>
                </div>
                
            </form>
        </section>
    </div>
    
@endsection