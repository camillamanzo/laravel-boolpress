@extends('layouts.app')

@section('content')
    <div class="container p-5">

        @if (session("deleted_title"))
            <div class="alert alert-warning">
                {{session('alert-message')}}
            </div>
        @endif

        <header class="py-3">
            <h1>Published posts</h1>
            <a href="{{route("admin.posts.create")}}">Create a new post</a>
        </header>

        <table class="table table-bordered">
            <thead>
                <th class="col">Title</th>
                <th class="col">Author</th>
                <th class="col">Date</th>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td><a href="{{ route('admin.posts.show', $post->id ) }}">{{ $post->title }}</a></td>
                        <td>{{ $post->author}}</td>
                        <td>{{ $post->date}}</td>
                        <td><a href="{{ route('admin.posts.edit', $post ) }}" class="btn btn-primary">Edit</a></td>
                        <td>
                            <form action="{{route('admin.posts.destroy', $post->id )}}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-primary" type="submit">Delete</a>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">There are no posts</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        

    </div>
@endsection