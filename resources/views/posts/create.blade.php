<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Post</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 font-sans antialiased">

    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="relative flex w-full max-w-[32rem] flex-col rounded-xl bg-white shadow-2xl">

            <!-- Header -->
            <div class="mx-4 -mt-6 mb-4 grid h-28 place-items-center rounded-xl bg-blue-600 text-white">
                <h3 class="text-3xl font-bold">Create Post</h3>
            </div>

            <!-- Show validation errors -->
            @if ($errors->any())
                <div class="mx-8 mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('posts.store') }}" method="POST" class="p-8 space-y-6" enctype="multipart/form-data">
                @csrf

                <!-- Author -->
                <div class="text-sm text-gray-600">
                    Author: <span class="font-semibold">{{ auth()->user()->name ?? 'Unknown' }}</span>
                </div>

                <!-- Title input -->
                <input 
                    name="title"
                    type="text"
                    value="{{ old('title') }}"
                    placeholder="Post Title"
                    class="w-full border p-3 rounded"
                />

                <!-- Image input -->
                <input 
                    name="image"
                    type="file"
                    accept="image/png,image/jpeg"
                    class="w-full border p-3 rounded"
                />

                <!-- Description textarea -->
                <textarea 
                    name="desc"
                    rows="4"
                    placeholder="Post Description"
                    class="w-full border p-3 rounded"
                >{{ old('desc') }}</textarea>

                <!-- Submit button -->
                <button class="w-full bg-blue-600 text-white py-3 rounded hover:bg-blue-700 transition">
                    Publish
                </button>

                <!-- Back link -->
                <a href="/posts" class="block text-center text-gray-500">
                    Cancel
                </a>
            </form>
        </div>
    </div>

</body>
</html>