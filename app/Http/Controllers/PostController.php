<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard', [
            'posts' => Post::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        return view('posts.create', [
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $request->validate($request->rules());

        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens', 'public');

        $post = new Post([
            'title' => $request->title,
            'content' => $request->content,
            'imagem' => $imagem_urn,
            'type' => $request->type,
        ]);

        $post->user()->associate(auth()->user());
        $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return 'show';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $request->validate($request->rules());

        $post->title = $request->title;
        $post->content = $request->content;
        $post->type = $request->type;

        if($request->hasFile('imagem')) {
            Storage::delete($post->imagem);
            $imagem = $request->file('imagem');
            $imagem_urn = $imagem->store('imagens', 'public');
            $post->imagem = $imagem_urn;
        }

        $post->save();
        return redirect()->route('dashboard', [
            'posts' => Post::all(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Storage::delete($post->imagem);
        $post->delete();
        return redirect()->route('dashboard', [
            'posts' => Post::all(),
        ]);
    }
}
