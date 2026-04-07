<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">

<div class="max-w-4xl mx-auto p-6">

    <!-- Back -->
    <a href="/posts" class="text-blue-600 hover:underline mb-6 inline-block">
        ← Back to all posts
    </a>

    <!-- Post Card -->
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
        <img src="{{ $post->image }}" class="w-full h-[400px] object-cover" alt="">
        
        <div class="p-10">
            <h1 class="text-4xl font-black text-gray-900 mb-6">
                {{ $post->title }}
            </h1>
            
            <div class="prose prose-lg text-gray-700 leading-relaxed">
                <p class="mb-4">
                    {{ $post->desc }}
                </p>
            </div>

            <div class="mt-10 pt-10 border-t border-gray-100 flex items-center justify-between">
                <span class="text-gray-500 text-sm">
                    Published at: {{ $post->created_at->format('Y-m-d') }}
                </span>
                <button class="bg-gray-900 text-white px-6 py-2 rounded-full text-sm">
                    Share Post
                </button>
            </div>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="mt-10 bg-white rounded-2xl shadow p-6">

        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            Comments
        </h2>

        <!-- Comments list -->
        @forelse ($post->comments as $comment)
            <div class="mb-4 p-3 bg-gray-100 rounded-lg">
                {{ $comment->body }}
            </div>
        @empty
            <p class="text-gray-500">No comments yet.</p>
        @endforelse

        <!-- Add comment form -->
        <form action="/posts/{{ $post->id }}/comments" method="POST" class="mt-6">
            @csrf

            <textarea 
                name="body"
                placeholder="Write your comment..."
                class="w-full border p-3 rounded-lg mb-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
            ></textarea>

            <button class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                Add Comment
            </button>
        </form>

    </div>

</div>

</body>
</html>