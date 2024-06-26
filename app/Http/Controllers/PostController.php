<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(5);
        return inertia('home', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        sleep(2);
        $posts = $request->validate([
            'body' => ['required']
        ]);

        Post::create($posts);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return inertia('show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return inertia('edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        sleep(1);

        $editPost = $request->validate([
            'body' => ['required']
        ]);

        $post->update($editPost);

        return redirect('/')->with(
            'success',
            'The post was updated successfully!'
        );;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('/')->with(
            'message',
            'The post was deleted!'
        );
    }
}
