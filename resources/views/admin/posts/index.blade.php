@extends('layouts.app')

@section('content')
    <div class="container p-5">

        <header class="py-3">
            <h1>Published posts</h1>
            <a href="{{route("admin.posts.create")}}">Create a new post</a>
        </header>

        {{-- message sent on delete --}}
        @if (session("alert-message"))
            <div class="alert alert-warning">
                {{session('alert-message')}}
            </div>
        @endif

        <table class="table table-bordered">

            <thead>
                <th class="col">Title</th>
                <th class="col">Category</th>
                <th class="col">Tags</th>
                <th class="col">Author</th>
                <th class="col">Date</th>
            </thead>

            <tbody>

                @forelse ($posts as $post)
                    <tr>
                        {{-- tile column with route when clicked --}}
                        <td><a href="{{ route('admin.posts.show', $post->id ) }}">{{ $post->title }}</a></td>
                        
                        {{-- category column --}}
                        <td>@if ($post->category) {{ ucfirst($post->category->name) }} @else none @endif</td>
                        
                        {{-- tags column (more than one tag is choosable) --}}
                        <td>
                            @forelse ($post->tags as $tag)
                                <span class="bagde badge-pill" style="background-color: {{ $tag->color}}; color: white">{{ ucfirst($tag->name) }}</span>
                            @empty
                                No Tags
                            @endforelse
                        </td>

                        {{-- user name column with link to user --}}
                        <td>{{ ucfirst($post->user->name) }}</td>

                        {{-- date column --}}
                        <td>{{ $post->date }}</td>

                        {{-- edit button with route to edit blade --}}
                        <td><a href="{{ route('admin.posts.edit', $post ) }}" class="btn btn-primary">Edit</a></td>
                        
                        {{-- delete form with button --}}
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
                        <td colspan="3">There are no posts.</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        

    </div>
@endsection

@section('script-section')
<script>
    // function to ask confirmation before deleting selected item
    let deleteItems = document.querySelectorAll('.delete-item');
    
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