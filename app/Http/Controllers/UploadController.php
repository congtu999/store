<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function cUpload(Request $request)
    {
        $url = $this->upload($request);
        if ($url !== false) { // Đoaạn này là nó sẽ chạy cái file js
            return response()->json([
                'error' => false,
                'url' => $url,
            ]);
        } else { // Đây là nó sẽ báo lỗi
            return response()->json([
                'error' => true,
            ]);
        }
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            try {
                $name = $request->file('file')->getClientOriginalName(); // Sử dụng `file`, không phải `files`
                $pathFile = 'uploads/' . date("Y/m/d");
                $path = $request->file('file')->storeAs('public/' . $pathFile, $name); // Sửa đường dẫn lưu trữ và sử dụng 'public/'
                return '/storage/' . $pathFile . '/' . $name;
            } catch (Exception $error) {
                return false;
            }
        }
    }
}
