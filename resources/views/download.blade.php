<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload & URL Shortener</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
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
        <a href="{{route('images.index')}}">Ảnh</a>
    </a>
</header>
<body class="bg-white text-gray-800">
    <main class="flex flex-col items-center justify-center min-h-screen py-12">
        <h1 class="text-3xl font-bold mb-4">Đăng và chia sẻ dữ liệu trực tuyến</h1>
        <p class="text-gray-600 mb-6 text-center">Kéo thả dữ liệu hoặc hình ảnh của bạn vào bất kỳ đâu để bắt đầu tải lên ngay. Giới hạn 10 MB. Liên kết trực tiếp đến dữ liệu, mã BBCode và hình thu nhỏ HTML.</p>
        
        <form action="{{ route('upload.image') }}" method="POST" enctype="multipart/form-data">
            @csrf 
            <label for="fui-input-upload" id="upload-section" class="border-2 border-gray-300 border-dashed rounded-lg w-36 h-36 flex flex-col items-center justify-center bg-white transition duration-300 ease-in-out cursor-pointer hover:border-blue-500">
                <div id="upload-icon" class="upload-icon">
                    <img src="https://i.ibb.co/5cQkzZN/img-upload.png" alt="" class="h-12">
                </div>
                <!-- Allow multiple files -->
                <input type="file" name="fui-input-upload[]" hidden accept="image/*" id="fui-input-upload" multiple onchange="previewImages(event)">
                <span class="mt-2 font-medium text-gray-700">Tải ảnh lên 111</span>
            </label>
            
            <!-- Preview section for multiple images -->
            <div id="preview-section" class="hidden flex flex-wrap items-center mt-4">
                <!-- Image previews will be displayed here -->
            </div>

            <button type="submit" class="bg-green-500 text-white px-6 py-2 mt-4 rounded">UPLOAD</button>
        </form>
    </main>

    <script>
        function previewImages(event) {
            var files = event.target.files;
            var previewSection = document.getElementById('preview-section');
            previewSection.innerHTML = ''; // Clear previous previews
            
            for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    var imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.className = 'w-24 h-24 object-cover mb-4 mr-4';
                    imgElement.width = 100;
                    imgElement.height = 100;

                    previewSection.appendChild(imgElement);
                };

                reader.readAsDataURL(files[i]);
            }

            previewSection.classList.remove('hidden');
            document.getElementById('upload-icon').style.display = 'none';
        }
    </script>
</body>
</html>
