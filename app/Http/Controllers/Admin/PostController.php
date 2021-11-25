<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // getting all posts from the model and ordering them by date.
        $posts = Post::orderBy('date','desc')->get();
        return view ('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        $categories = Category::all();
        $tags = Tag::all();
        
        // compact used to create an array with the values in the brackets
        return view('admin.posts.create', compact('post', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // making validation to inform users of the error response
        $request->validate([

            'title' => 'required|string|unique:posts|max:120',
            'content' => 'required|string|min:40',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'image',
        ],
        [
            'required' => 'You have to correctly file all the parameters.',
            'title.required' => 'Please insert a title.',
            'content.min' => 'The content of the post has to be at least 40 letters long.'
        ]);

        $data = $request->all();

        // carbon::now uses places today's date in 'date'
        $data['date'] = Carbon::now();
        // auth::user makes the authentication of the user based on the id (in this case)
        $data['user_id'] = Auth::user()->id;
        // Storage facade provides a convenient way to perform actions on the storage disks.
        $data['image'] = Storage::put('posts/images', $data['image']);

        $post = new Post();
        $post->fill($data);
        $post->save();

        // if tags are already in the data, sync the tags(place the new ones only if they're not already in array)
        if(array_key_exists('tags', $data)) $post->tags()->sync($data['tags']);

        return redirect()->route('admin.posts.show', compact('post'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        // pluck method gets all of the values for -id-, toArray method makes an array with the given values
        $tagIds = $post->tags->pluck('id')->toArray();
        return view("admin.posts.edit", compact('post', 'categories', 'tags', 'tagIds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();
        $data['date'] = Carbon::now();
        $data['user_id'] = Auth::user()->id;

        $post->fill($data);
        $post->update();

        if(array_key_exists('tags', $data)) $post->tags()->sync($data['tags']);
        
        return redirect()->route('admin.posts.show', compact('post'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post)
    {
        if ($post->tags) $post->tags()->detach();
        $data = $request->all();
        $post->delete();

        // ->with echoes the message when called (first value is the name)
        return redirect()->route('admin.posts.index', $post)
            ->with('alert-message', "' $post->title ' has been deleted");
    }
}
