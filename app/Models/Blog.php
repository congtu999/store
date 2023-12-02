<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function getAllBlog()
    {
        return Blog::paginate(3);
    }

    public function getBlogById($id)
    {
        return Blog::find($id);
    }

    public function addBlog($data)
    {
        return Blog::create($data);
    }

    public function updateBlog($request, $id)
    {
        $file = $request->file('hinhanh4');
        if ($file) {//file đang tồn tại
            return DB::table('blogs')
                ->where('id', '=', $id)
                ->update([
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'content' => $request->input('content'),
                    'content1' => $request->input('content1'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        } else {
            return DB::table('blogs')
                ->where('id', '=', $id)
                ->update([
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'content' => $request->input('content'),
                    'content1' => $request->input('content1'),
                    'image' => $request->input('hinhanh4'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        }
    }

    public function deleteBlog($id)
    {
        return DB::table('blogs')
            ->where('id', '=', $id)
            ->delete();
    }


}
