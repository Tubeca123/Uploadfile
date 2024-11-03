<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Images</title>
    @vite('resources/css/app.css') <!-- If using Tailwind or custom CSS -->
</head>
<header class="flex justify-between items-center p-4 border-b border-gray-200">
        <div class="flex items-center space-x-4">
            <a href="#" class="text-gray-600 hover:text-gray-800">Giới thiệu</a>
            <div class="relative">
                <button class="flex items-center space-x-1 text-gray-600 hover:text-gray-800">
                    <i class="fas fa-globe"></i>
                    <span>VI</span>
                    <i class="fas fa-caret-down"></i>
                </button>
                
            </div>
        </div>
        <a href="#" class="text-gray-600 hover:text-gray-800 flex items-center space-x-1">
            <i class="fas fa-upload"></i>
            <a href="{{route('upload_file')}}" >Upload</a>
        </a>
</header>
<body class="bg-gray-100 text-gray-800">
    <main class="flex flex-col items-center justify-center min-h-screen py-12">
        <h1 class="text-3xl font-bold mb-4">Download image</h1>
        
        <!-- Grid with 4 columns on large screens -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse($image as $image)
                <div class="flex flex-col items-center bg-white p-4 rounded-lg shadow">
                    <!-- Download link -->
                    <a href="{{ route('images.download', ['id' => $image->Id]) }}" class="text-blue-500 mb-2">Tải ảnh</a> 
                    <!-- Image preview -->
                    <img src="{{asset('img/' .$image->file_name) }}" alt="Image" class="w-32 h-32 object-cover rounded-lg mb-2">
                    <!-- Image name or description -->
                </div>
            @empty
                <p class="text-center text-gray-500">No images found.</p>
            @endforelse
        </div>
    </main>
</body>

</html>
