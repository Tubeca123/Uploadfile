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
            <!-- Left Section -->
            <div class="flex items-center space-x-4">
                <a href="#" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-question-circle"></i> Giới thiệu
                </a>

                <a href="{{ route('images.index') }}" class="text-gray-600 hover:text-gray-800">Kho ảnh</a>
                
            </div>

            <!-- Center Section -->
            <a href="{{ route('upload_file') }}">
                <h1 class="text-2xl font-bold text-blue-600">imgbb</h1>
            </a>

            <!-- Right Section -->
            <div class="flex items-center space-x-4">
                <button id="uploadBtn" class="flex items-center space-x-1">
                    <i class="fas fa-cloud-upload-alt text-xl"></i>
                    <span class="text-lg">Upload</span>
                </button>

                @if(!Auth::check())
                <!-- Show Register link if user is not logged in -->
                <a class="flex items-center space-x-1" href="{{ route('register') }}">
                    <i class="fas fa-sign-in-alt"></i>
                    <span class="text-lg">Đăng nhập</span>
                </a>
                @else
                <!-- Show User Profile dropdown if user is logged in -->
                <div class="relative">
                    <span class="text-lg cursor-pointer flex items-center space-x-1" onclick="toggleDropdown()">
                        <span>{{ Auth::user()->Full_name }}</span>
                        <i class="fas fa-caret-down"></i>
                    </span>
                    <div class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg hidden" id="dropdownMenu">
                        <a class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('images.index') }}">
                            <i class="fas fa-user mr-2"></i> Kho ảnh
                        </a>
                        <a class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{route('handleLogout')}}">
                            <i class="fas fa-sign-out-alt mr-2"></i> Sign out
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </header>
    @yield('page_content')

    <footer class="text-center py-4 text-gray-600">
        <p>Bằng việc sử dụng dịch vụ này, bạn đồng ý với <a href="#" class="hover:underline text-blue-500">Chính sách bảo mật</a>.</p>
    </footer>

</body>
<script>
    function toggleDropdown() {
        const dropdown = document.getElementById("dropdownMenu");
        dropdown.classList.toggle("hidden");
    }

    // Close dropdown if clicked outside
    window.onclick = function(event) {
        if (!event.target.matches('.cursor-pointer') && !event.target.closest('#dropdownMenu')) {
            const dropdown = document.getElementById("dropdownMenu");
            if (!dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
            }
        }
    }
</script>

</html>