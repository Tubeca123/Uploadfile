<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
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

        $image=Image::all();
        return view('show',['image'=>$image]);
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
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
{
    $request->validate([
        'fui-input-upload.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
    ]);

    $downloadLinks = [];

    if ($request->hasFile('fui-input-upload')) {
        $files = $request->file('fui-input-upload');
        // dd( "oke");
        foreach ($files as $uploadedFile) {
 
            $existingFile = Image::where('file_name', $uploadedFile->getClientOriginalName())->first();

           if (!$existingFile) {
                
                $fileName = $uploadedFile->getClientOriginalName();
                $filePath = 'img/' . $fileName;   

                 
                $file = new Image();
                 $file->file_name = $fileName;
                 $file->file_path = $filePath;
                 $file->file_type = $uploadedFile->getClientMimeType();
                 $file->file_size = $uploadedFile->getSize();
                 $file->save();

                  $uploadedFile->move(public_path('img'), $fileName);

                  $downloadLinks[] = url('http://127.0.0.1:8000/download/' . $file->id);
             }
        }

         return back()->with('success', 'Image uploaded and saved successfully.');
     }
     return back()->withErrors(['file' => 'Please upload a valid image file.']);
}

     
    public function download( $id)
    {
        $file = Image::find($id);
        if ($file) {
            $path = public_path('img/'. $file->file_name);
            return response()->download($path);
        }
        return redirect()->back()->with('error', 'File không tồn tại.');       
        

    }

    public function handleUpdateImage(Request $request)
    {
        
    }
}
