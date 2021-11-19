@extends('layouts.app')

@section('content')

    <div class="container">
        <header>
            <h1>Create a new post</h1>
        </header>

        <section id="post-form">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>        
            @endif
            <form action="{{route('admin.posts.store')}}" method="POST" >
                @csrf

                <div class="form-group">
                    <label for="title">Title:</label>
                    <input class="form-control form-control-lg" type="text" 
                    placeholder="Insert the title of the post" id="title" name="title" value="{{ old('title', $post->title) }}">
                </div>

                <div class="form-group">
                    <label for="category_id">Categories:</label>
                    <br>
                    <select name="category_id" id="category_id">
                        <option value="">None</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ old('category_id', $category->name) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="author">Author:</label>
                    <input class="form-control" type="text" placeholder="Insert the author of the post" id="author" name="author" value="{{ $post->author }}" >
                </div>

                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea  class="form-control" type="textarea" placeholder="Insert the content of your post" id="content" name="content" >{{ old('content', $post->content) }} </textarea>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
                <button type="reset" class="btn btn-secondary">Cancel progress</button>

            </form>
        </section>
    </div>
    
@endsection