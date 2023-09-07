<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return inertia()->render('Posts/Index', [
            'posts' => Post::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia()->render('Posts/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        Post::create(array_merge($request->validate([
            'title' => 'required|string',
            'content' => 'required|string'
        ]), ['user_id' => auth()->id()]));

        return redirect()->route('posts');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): Response
    {
        $post->load('comments.author');

        return inertia()->render('Posts/Show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return inertia()->render('Posts/Edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $post->update($request->validate([
            'title' => 'sometimes|string',
            'content' => 'sometimes|string'
        ]));

        return redirect()->route('posts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->comments()->delete();
        $post->delete();

        return redirect()->route('posts');
    }
}
