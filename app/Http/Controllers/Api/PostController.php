<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        $posts = Post::with('user')->paginate(10);

        return PostResource::collection($posts)->response();
    }

    public function show(int $id): JsonResponse
    {
        $post = Post::with('user')->find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return (new PostResource($post))->response();
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        $data = $request->validated();

        $data['user_id'] = Auth::id();
        $data['image'] = $request->hasFile('image')
            ? $request->file('image')->store('posts', 'public')
            : null;

        $post = Post::create($data);
        $post->load('user');

        return (new PostResource($post))
            ->response()
            ->setStatusCode(201);
    }
}
