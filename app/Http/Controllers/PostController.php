<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        // include deleted posts
        $posts = Post::withTrashed()->with('user')->paginate(6);

        return view('posts.posts', compact('posts'));
    }

    public function create()
    {
        $this->ensureAuthenticated();
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        $this->ensureAuthenticated();

        $data['user_id'] = Auth::id();
        $data['image'] = $request->hasFile('image')
            ? $request->file('image')->store('posts', 'public')
            : null;

        Post::create($data);

        return redirect('/posts');
    }

    public function show($id)
    {
        $post = Post::withTrashed()->with('user')->findOrFail($id);

        return view('posts.post', ['post' => $post]);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->authorizePostAction($post);

        return view('posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $this->authorizePostAction($post);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($post->image && !Str::startsWith($post->image, ['http://', 'https://'])) {
                Storage::disk('public')->delete($post->image);
            }

            $data['image'] = $request->file('image')->store('posts', 'public');
        } else {
            unset($data['image']);
        }

        $post->update($data);
        return redirect('/posts');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $this->authorizePostAction($post);

        // soft delete
        if ($post->image && !Str::startsWith($post->image, ['http://', 'https://'])) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect('/posts');
    }

    // restore function
    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $this->authorizePostAction($post);

        $post->restore();

        return redirect('/posts');
    }

    private function authorizePostAction(Post $post): void
    {
        $this->ensureAuthenticated();

        if ($post->user_id && $post->user_id !== Auth::id()) {
            abort(403);
        }
    }

    private function ensureAuthenticated(): void
    {
        if (!Auth::check()) {
            abort(403);
        }
    }
}