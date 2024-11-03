@extends('master_layout')

@section('page_content')
<div class="container mx-auto px-32">
    <div class="my-4">
        <img alt="" class="w-2/3 mx-auto h-90" height="10" src="{{ asset('img/logo/image.png') }}" width="720" />
    </div>


    <div class="flex space-x-4 my-4">
        <img alt="" class="w-1/3" height="280" src="{{asset("img/logo/image1.png")}}" width="300" />
        <div class="w-2/3 space-y-4">
            @foreach ($images as $items)
                <div
                    class="flex items-center justify-between p-4 border rounded shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-file-alt text-blue-500"></i>
                        <span>{{$items->file_name}}</span>
                        <span class="text-gray-500">({{ number_format($items->file_size / 1024, 2) }} KB)</span>
                    </div>
                    <a href="{{ route('images.download', ['id' => $items->Id]) }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded transition duration-300 hover:bg-blue-600" download>
                        TẢI VỀ ({{ number_format($items->file_size / 1024, 2) }} KB)
                    </a>
                </div>
            @endforeach
            <div class="my-4 text-sm pl-2">
                <p><b>Ngày tải lên:</b> Cách đây 14 phút trước.</p>
                <p><b>Thời gian lưu trữ đến:</b> 15:45 phút, 25 tháng 9, 2024</p>
            </div>
        </div>
    </div>
    <div class="my-8">
        <div class="border-b-2 border-blue-500 mt-2 w-10"></div>
        <h2 class="text-2xl font-bold my-2">Về Nhanh.cc</h2>
        <p class="text-lg">
            <strong>Nhanh.cc</strong> là một nền tảng chia sẻ file tạm thời nhanh chóng và trực tuyến.
            Nhanh.cc chỉ lưu trữ dữ liệu do người dùng tải lên tối đa là 3 ngày, tất cả các file và định dạng đều
            được hỗ trợ.
            Chỉ những ai có đường dẫn mới có thể xem và tải về.
        </p>
    </div>


    <div class="my-4">
        <img alt="" class="w-2/3 mx-auto h-90" height="10" src="{{ asset('img/logo/image.png') }}" width="720" />
    </div>
</div>
@endsection