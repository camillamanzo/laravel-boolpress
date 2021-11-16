@extends('layouts.app')

@section('content')
    <div class="container p-5">

        <header class="py-3">
            <h1>Published posts</h1>
            <a href="{{route("admin.posts.create")}}">Create a new post</a>
        </header>

        @if (session("alert-message"))
            <div class="alert alert-warning">
                {{session('alert-message')}}
            </div>
        @endif

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
                        <td>{{ $post->author }}</td>
                        <td>{{ $post->date }}</td>
                        <td><a href="{{ route('admin.posts.edit', $post ) }}" class="btn btn-primary">Edit</a></td>
                        <td>
                            <form class="delete-item" action="{{route('admin.posts.destroy', $post->id )}}" method="POST" data-post-title="{{ $post->title }}">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-primary" type="submit">Delete</button>
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

@section('script-section')
<script>
    // function to ask confirmation before deleting selected item
    const deleteItems = document.querySelectorAll('.delete-item');
    
    // adding event listener to each button in form
    deleteItems.forEach(element => {
       
        // when submit=true the event is blocked by prevent default
        element.addEventListener('submit', function(event){
            event.preventDefault(); //blocks standard function (delete)
            const title = element.getAttribute("data-post-title");

            // sends a pop up to the window to ask for confirmation
            const confirm = window.confirm(`Are you sure you want to delete ${title}?`);
            
            // if confirm = true, item is deleted
            if (confirm) element.submit();
        })
    });

</script>
@endsection