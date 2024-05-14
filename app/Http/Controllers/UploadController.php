<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
class UploadController extends Controller
{
    public function uploadImage(Request $request)
    {   
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
    
            // Tạo đường dẫn tuyệt đối đến ảnh
            $imageUrl = asset('uploads/' . $filename);
    
            // Trả về URL của ảnh đã chỉnh sửa
            return response()->json(['location' => $imageUrl]);
        }
    
        return response()->json(['error' => 'Upload failed'], 400);
    }
    
    
}
