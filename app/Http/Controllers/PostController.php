<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        // include deleted posts
        $posts = Post::withTrashed()->paginate(6);

        return view('posts.posts', compact('posts'));
    }

    public function create()
    {
        $users = User::all();
        return view('posts.create', compact('users'));
    }

    public function store(StorePostRequest $request)
    {
        // create post with user_id
        Post::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'image' => $request->image ?: 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=800',
            'user_id' => $request->user_id // 🔥 مهم
        ]);

        return redirect('/posts');
    }

    public function show($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        return view('posts.post', ['post' => $post]);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $users = User::all(); // 🔥 علشان dropdown في edit

        return view('posts.edit', compact('post', 'users'));
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        $post->update([
    'title' => $request->title,
    'desc' => $request->desc,
    'image' => $request->image ?: $post->image,
    'user_id' => $request->user_id ?? $post->user_id //  مهم
]);
        return redirect('/posts');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // soft delete
        $post->delete();

        return redirect('/posts');
    }

    // restore function
    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        $post->restore();

        return redirect('/posts');
    }
}