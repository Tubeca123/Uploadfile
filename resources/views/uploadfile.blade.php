@extends('master_layout')
@section('page_content')
<main class=" flex flex-col items-center justify-center min-h-screen">
    <div class="text-center">
        <h2 class="text-3xl font-bold mb-4">Đăng và chia sẻ dữ liệu trực tuyến</h2>
        <p class="text-gray-600 mb-6">Kéo thả dữ liệu hoặc hình ảnh của bạn vào bất kỳ đâu để bắt đầu tải lên ngay.Giới hạn 10 MB. Liên kết trực tiếp đến dữ liệu, mã BBCode và hình thu nhỏ HTML</p>


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
                <div class="time_delete">
                    <div class="content_delete w-[310px] mx-auto">
                        <span class="font-bold flex justify-start items-end">Tự động xóa ảnh</span>
                    </div>
                    <div class="select_delete flex justify-center">
                        <select  aria-label="Chọn thời gian xóa" class="bg-[#eeeeee] w-[310px] p-[7px_10px_7px_7px] rounded-sm" name="delete_time" id="deleteTime">
                            <option value="0">Chọn thời gian xóa</option>
                            <option value="0">Không xóa</option>
                            <option value="30">30 giây</option>
                            <option value="60">1 phút</option>
                            <option value="1800">30 phút</option>
                            <option value="3600">1 giờ</option>
                            <option value="10800">3 giờ</option>
                            <option value="21600">6 giờ</option>
                            <option value="43200">12 giờ</option>
                            <option value="86400">1 ngày</option>
                            <option value="259200">3 ngày</option>
                            <option value="604800">1 tuần</option>
                            <option value="1209600">2 tuần</option>
                            <option value="2592000">1 tháng</option>
                            <option value="7776000">3 tháng</option>
                            <option value="15552000">6 tháng</option>
                            <option value="31536000">1 năm</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-center mt-6">
                    <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600 transition duration-300">
                        Tải Lên
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>




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
        previewAndUploadFiles(files);
    });

    function previewAndUploadFiles(files) {
        document.getElementById('uploadModal').classList.remove('hidden');
        const previewSection = document.getElementById('preview-section');
        let autoUpload = false;

        // Chuyển đổi files sang mảng và loại bỏ ảnh trùng lặp
        const newFiles = Array.from(files).filter(file => {
            return !selectedFiles.some(existingFile => existingFile.name === file.name);
        });

        // Thêm các tệp mới vào mảng selectedFiles
        selectedFiles = selectedFiles.concat(newFiles);

        newFiles.forEach((file, index) => {
            const fileType = file.type;

            if (fileType.startsWith('image/')) {
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
                    deleteButton.addEventListener('click', () => removeImage(selectedFiles.indexOf(file), imgWrapper));

                    imgWrapper.appendChild(imgElement);
                    imgWrapper.appendChild(deleteButton);
                    previewSection.appendChild(imgWrapper);
                };
                reader.readAsDataURL(file);
            } else {
                autoUpload = true; // Tự động tải lên nếu không phải ảnh
            }
        });

        updateFileInput();
        if (autoUpload) autoSubmitForm();
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

    function autoSubmitForm() {
        const uploadForm = document.getElementById('uploadForm');
        uploadForm.submit();
    }

    document.addEventListener('paste', function(event) {
        const items = event.clipboardData.items;

        // Kiểm tra clipboard để tìm dữ liệu dạng hình ảnh
        for (let item of items) {
            if (item.type.startsWith('image/')) {
                const file = item.getAsFile();
                if (file) {
                    document.getElementById('uploadModal').classList.remove('hidden'); // Hiển thị modal
                    previewAndUploadFiles([file]); // Gọi hàm xem trước và tải lên ảnh
                }
            }
        }
    });

    function previewImages(event) {
        const files = event.target.files;
        previewAndUploadFiles(files);
    }

    // Xử lý sự kiện thay đổi của input
    document.getElementById('fui-input-upload').addEventListener('change', previewImages);
</script>


@endsection