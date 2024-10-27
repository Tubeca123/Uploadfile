<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tải Lên Ảnh với Modal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-white text-gray-800">

<header class="sticky top-0 z-10 bg-white border-b shadow">
    <div class="flex justify-between items-center p-4">
        <div class="flex items-center space-x-4">
            <a href="#" class="text-gray-600 hover:text-gray-800"><i class="fas fa-question-circle"></i> Kho ảnh</a>
            <a href="{{route('images.index')}}" class="text-gray-600 hover:text-gray-800">Kho ảnh</a>
        </div>
        <h1 class="text-2xl font-bold text-blue-600">imgbb</h1>
        <button id="uploadBtn" class="flex items-center space-x-1">
            <i class="fas fa-cloud-upload-alt text-xl"></i>
            <span class="text-lg">Upload</span>
        </button>
    </div>
</header>

<main class="flex flex-col items-center justify-center min-h-screen">
    <div class="text-center">
        <h2 class="text-3xl font-bold mb-4">Tải Lên và Chia Sẻ Hình Ảnh</h2>
        <p class="text-gray-600 mb-6">Kéo thả hoặc chọn hình ảnh để bắt đầu tải lên. Giới hạn 10 MB cho mỗi tệp.</p>
        <input type="file" name="fui-input-upload[]" id="fui-input-upload" multiple class="hidden" onchange="previewImages(event)">
        <button onclick="document.getElementById('fui-input-upload').click()" class="bg-blue-600 text-white px-6 py-2 rounded">START UPLOADING</button>
    </div>
</main>

<div id="uploadModal" class="fixed bg-opacity-70 inset-x-0 top-[4.0rem] bg-gray-900 hidden flex items-center justify-center">
    <div class="bg-white w-full h-[70%] p-6 shadow-lg overflow-y-auto relative">
        <div class="text-left text-xs text-gray-500 leading-tight">
            Chọn hoặc kéo thả các tệp: JPG, PNG, GIF... GIỚI HẠN: 10MB mỗi tệp.
        </div>
        <button id="closeModal" class="absolute top-4 right-4 text-gray-600 hover:text-gray-800 flex items-center">
            <i class="fas fa-times"></i><span class="text-xs text-gray-500 ml-1">Đóng</span>
        </button>
        <div class="flex flex-col items-center justify-center space-y-4 mt-8 mb-20" id="dropZone">
            <i class="fas fa-cloud-upload-alt text-7xl text-blue-500"></i>
            <p class="mt-4 text-lg">Kéo thả hoặc chọn hình ảnh để tải lên</p>
            
            <div id="preview-section" class="flex flex-wrap space-x-2"></div>
            
            <form id="uploadForm" action="{{ route('upload_images') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="fui-input-upload[]" id="hiddenFileInput" multiple class="hidden">
                <button type="submit" class="bg-green-500 text-white px-6 py-2 mt-4 rounded">Tải Lên</button>
            </form>
        </div>
    </div>
</div>

<footer class="text-center py-4 text-gray-600">
    <p>Bằng việc sử dụng dịch vụ này, bạn đồng ý với <a href="#" class="hover:underline text-blue-500">Chính sách bảo mật</a>.</p>
</footer>


<script>
    let selectedFiles = []; 

    document.getElementById('uploadBtn').addEventListener('click', function() {
        document.getElementById('uploadModal').classList.remove('hidden');
    });

    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('uploadModal').classList.add('hidden');
    });

    const dropZone = document.getElementById('dropZone');
    dropZone.addEventListener('dragover', function(event) {
        event.preventDefault();
        dropZone.classList.add('border-dashed', 'border-4', 'border-blue-500');
    });

    dropZone.addEventListener('dragleave', function() {
        dropZone.classList.remove('border-dashed', 'border-4', 'border-blue-500');
    });

    dropZone.addEventListener('drop', function(event) {
        event.preventDefault();
        dropZone.classList.remove('border-dashed', 'border-4', 'border-blue-500');
        const files = event.dataTransfer.files;
        previewImages({ target: { files } });
    });

    function previewImages(event) {
        document.getElementById('uploadModal').classList.remove('hidden');
        const files = Array.from(event.target.files);
        selectedFiles = files; 
        const previewSection = document.getElementById('preview-section');
        previewSection.innerHTML = '';

        selectedFiles.forEach((file, index) => {
            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                const imgWrapper = document.createElement('div');
                imgWrapper.className = 'relative w-24 h-24 mb-4 mr-4';
                
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.className = 'w-full h-full object-cover rounded';

                const deleteButton = document.createElement('button');
                deleteButton.className = 'absolute top-0 right-0 bg-red-500 text-white p-1 rounded-full text-xs';
                deleteButton.innerHTML = '<i class="fas fa-times"></i>';
                deleteButton.addEventListener('click', () => removeImage(index, imgWrapper));

                imgWrapper.appendChild(imgElement);
                imgWrapper.appendChild(deleteButton);
                previewSection.appendChild(imgWrapper);
            };
            reader.readAsDataURL(file);
        });

        updateFileInput(); 
    }

    function removeImage(index, imgWrapper) {
        selectedFiles.splice(index, 1); 
        imgWrapper.remove(); 
        updateFileInput(); 
    }

    function updateFileInput() {
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        document.getElementById('hiddenFileInput').files = dataTransfer.files; 
    }
</script>

</body>
</html>
