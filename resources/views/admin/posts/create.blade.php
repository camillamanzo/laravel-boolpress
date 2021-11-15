@extends('layouts.app')

@section('content')

    <div class="container">
        <header>
            <h1>Create a new post</h1>
        </header>

        <section id="post-form">
            <form action="{{route('admin.posts.store')}}" method="POST" >
                @csrf

                <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control form-control-lg" type="text" 
                    placeholder="Insert the title of the post" id="title" name="title" value="{{ $post->title }}">
                </div>

                <div class="form-group">
                    <label for="author">Author</label>
                    <input class="form-control" type="text" placeholder="Insert the author of the post" id="author" name="author" value="{{ $post->author }}" >
                </div>

                <div class="form-group">
                    <label for="post_content">Content</label>
                    <textarea  class="form-control" type="textarea" placeholder="Insert the content of your post" id="content" name="content" >{{ $post->content }} </textarea>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
                <button type="reset" class="btn btn-secondary">Cancel progress</button>

            </form>
        </section>
    </div>
    
@endsection