@extends('master_layout')
@section('page_content')
<main class="flex justify-center items-center h-screen">
    <div class="w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6">Đăng nhập</h2>
        <form  action="{{route("handregister")}}"  method="post">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium">Địa chỉ email</label>
                <input type="email" name="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Địa chỉ email">
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div>
                <label for="password" class="block text-sm font-medium">Mật khẩu</label>
                <input type="password" name="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Mật khẩu">
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-500 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Đăng nhập</button>
            </div>
        </form>
        <div class="mt-6 text-center">
            <span class="text-sm text-gray-600">HOẶC</span>
        </div>
        <div class="mt-4 flex justify-center space-x-2">
            <button class="flex items-center space-x-2 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fab fa-facebook-f text-blue-600"></i>
                <span>Facebook</span>
            </button>
            <button class="flex items-center space-x-2 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fab fa-google text-red-600"></i>
                <span>Google</span>
            </button>
            <button class="flex items-center space-x-2 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fab fa-vk text-blue-600"></i>
                <span>VK</span>
            </button>
        </div>
    </div>
</main>
@endsection