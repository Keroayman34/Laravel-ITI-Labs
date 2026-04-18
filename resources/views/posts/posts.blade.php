<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased py-10">

<div class="max-w-7xl mx-auto px-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800">Posts</h1>

        @auth
            <a href="/posts/create"
               class="bg-blue-600 text-white px-6 py-2 rounded-xl shadow-lg hover:bg-blue-700 transition">
                Create Post
            </a>
        @endauth
    </div>

    <!-- Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach ($posts as $post)
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition transform hover:-translate-y-1">

                <!-- Image -->
                 <img src="{{ $post->image_url }}"
                     class="w-full h-56 object-cover" alt="{{ $post->title }}">

                <!-- Content -->
                <div class="p-6">

                    <h2 class="text-xl font-bold text-gray-900 mb-2">
                        {{ $post->title }}
                    </h2>

                    <p class="text-gray-600 text-sm mb-3">
                        {{ Str::limit($post->desc, 80) }}
                    </p>

                    <p class="text-gray-500 text-xs mb-1">
                        Slug: {{ $post->slug ?? '—' }}
                    </p>

                    <p class="text-gray-500 text-xs mb-1">
                        By {{ $post->user->name ?? 'Unknown' }}
                    </p>

                    <p class="text-gray-400 text-xs">
                        {{ $post->created_at->format('M d, Y') }}
                    </p>

                </div>

                <!-- Actions -->
              <div class="flex gap-3 px-5 pb-5">

    <!-- View -->
    <a href="/posts/{{ $post->id }}"
       class="flex-1 text-center bg-gray-800 text-white py-2 rounded-lg hover:bg-gray-900 transition">
        View
    </a>

    @php
        $canManage = auth()->check() && (!$post->user_id || $post->user_id === auth()->id());
    @endphp

    @if ($canManage)
        <!-- Edit -->
        <a href="/posts/{{ $post->id }}/edit"
           class="flex-1 text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
            Edit
        </a>

        @if(!$post->trashed())
            <!-- Delete -->
            <form action="/posts/{{ $post->id }}" method="POST" class="flex-1">
                @csrf
                @method('DELETE')

                <button class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition">
                    Delete
                </button>
            </form>
        @else
            <!-- Restore -->
            <form action="/posts/{{ $post->id }}/restore" method="POST" class="flex-1">
                @csrf

                <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                    Restore
                </button>
            </form>
        @endif
    @endif

</div>

            </div>
        @endforeach

    </div>

    <!-- Pagination -->
    <div class="mt-16">
        {{ $posts->links() }}
    </div>

</div>

</body>
</html>