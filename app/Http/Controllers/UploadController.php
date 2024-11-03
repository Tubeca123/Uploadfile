<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('uploadfile');
    }
    public function show()
    {
        // Kiểm tra nếu người dùng đã đăng nhập
        if (Auth::check()) {
            // Người dùng đã đăng nhập, lấy ảnh theo ID của người dùng
            $images = Image::where('upload_by', Auth::user()->Id)->get();
            return view('show', ['images' => $images]);
        } else {
            // Người dùng chưa đăng nhập, lấy ảnh có upload_by là null
            $images = Image::whereNull('upload_by')->get();
            return view('show', ['images' => $images]);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function xoaxoa()
    {
        $expiredImageIds = Image::whereDate('delete_time', '<=', now())->pluck('id'); // Lấy ID của các ảnh đã hết hạn
        dd($expiredImageIds );
        // Kiểm tra xem có ảnh nào để xóa không
        // if ($expiredImageIds->isEmpty()) {
        //     return response()->json(['message' => 'Không có ảnh nào để xóa.'], 404);
        // }

        // Xóa các ảnh theo ID
        // Image::destroy($expiredImageIds);

        // return response()->json(['message' => 'Đã xóa ' . $expiredImageIds->count() . ' ảnh.'], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request);
        $request->validate([
            'fui-input-upload.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);
        $deleteTime = (int) $request->input('delete_time', 0);
        // dd($deleteTime);
        $downloadLinks = [];

        if ($request->hasFile('fui-input-upload')) {
            $files = $request->file('fui-input-upload');

            foreach ($files as $uploadedFile) {
                // Kiểm tra xem file đã tồn tại hay chưa
                $existingFile = Image::where('file_name', $uploadedFile->getClientOriginalName())->first();

                if (!$existingFile) {
                    $fileName = time() . '_' . $uploadedFile->getClientOriginalName(); // Tạo tên file duy nhất
                    $filePath = 'img/' . $fileName;

                    // Tạo bản ghi cho ảnh trong database
                    $file = new Image();

                    // Nếu người dùng đã đăng nhập, lưu ID của họ; nếu không, đặt giá trị null
                    $file->upload_by = Auth::check() ? Auth::user()->Id : null;
                    $file->file_name = $fileName;
                    $file->file_path = $filePath;
                    $file->file_type = $uploadedFile->getClientMimeType();
                    $file->file_size = $uploadedFile->getSize();

                    if ($deleteTime > 0) {
                        $file->delete_time = now()->addSeconds($deleteTime);
                    } else {
                        $file->delete_time = null; // Nếu không xóa, có thể để null
                    }
                    $file->save();

                    // Di chuyển file vào thư mục img
                    $uploadedFile->move(public_path('img'), $fileName);

                    // Thêm link tải về vào danh sách downloadLinks
                    $downloadLinks[] = url('/download/' . $file->Id);
                }
            }

            return back()->with('success', 'Image uploaded and saved successfully.');
        }

        return back()->withErrors(['file' => 'Please upload a valid image file.']);
    }


    public function download($id)
    {
        $file = Image::find($id);
        if ($file) {
            $path = public_path('img/' . $file->file_name);
            return response()->download($path);
        }
        return redirect()->back()->with('error', 'File không tồn tại.');
    }

    public function handleUpdateImage(Request $request) {}
}
