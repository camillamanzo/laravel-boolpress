<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
        $posts = Post::all();
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
        $request->validate([

            'title' => 'required|string|unique:posts|max:120',
            'content' => 'required|string|min:40',
            'category_id' => 'nullable|exists:category_id, id',
        ],
        [
            "required" => 'You have to correctly file all the parameters.',
            "title.required" => 'Please insert a title.',
            'content.min' => 'The content of the post has to be at least 40 letters long.'
        ]);

        $data = $request->all();
        $data['date'] = Carbon::now();
        $data['user_id'] = Auth::user()->id;

        $post = new Post();
        $post->fill($data);
        $post->save();

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

        return redirect()->route('admin.posts.index', $post)
            ->with('alert-message', "' $post->title ' has been deleted");
    }
}
