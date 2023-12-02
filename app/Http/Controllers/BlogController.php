<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $blog;

    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    public function showBlogDetail(Request $request, $id = 0)
    {
        if (!empty($id)) {
            $blogDetail = $this->blog->getDetail($id);
            if (!empty($blogDetail[0])) {
                $request->session()->put('id', $id);
                return view('frontend.blog-detail', [
                    'blogDetail' => $blogDetail,
                ]);
            }
        }
    }

    public function create()
    {
        return view('backend.blog.addblog');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',

        ], [
            'title.required' => 'Tiêu đề bài viết không được để trống',
            'description.required' => 'Chi tiết tiêu đề bài viết không được để trống',
            'content.required' => 'Chi tiết bài viết không được để trống',


        ]);


        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'content' => $request->input('content'),
            'content1' => $request->input('content1'),
            'image' => $request->input('hinhanh4'),
            'created_at' => date('Y-m-d H:i:s')

        ];

        $this->blog->addBlog($data);
        return redirect()->route('listblog')->with('success', 'Thêm thông tin bài viết thành công');
    }

    public function edit(Request $request, $id = 0)
    {
        if (!empty($id)) {
            $blogDetail = $this->blog->getDetail($id);
            if (!empty($blogDetail[0])) {
                $request->session()->put('id', $id);
                return view('backend.blog.editblog', [
                    'blogDetail' => $blogDetail,
                ]);
            }
        }
    }

    public function show()
    {
        $blog = $this->blog->getAllBlog();
        return view('backend.blog.listblog', ['blog' => $blog]);
    }

    public function update(Request $request)
    {
        $id = session('id');
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',

        ], [
            'title.required' => 'Tiêu đề bài viết không được để trống',
            'description.required' => 'Chi tiết tiêu đề bài viết không được để trống',
            'content.required' => 'Chi tiết bài viết không được để trống',


        ]);

        $this->blog->updateBlog($request, $id);
        return redirect()->route('listblog')->with('success', 'Cập nhật thông tin bài viết thành công');
    }

    public function destroy($id)
    {
        $delete = $this->blog->deleteBlog($id);
        if ($delete) {
            $success = "Xóa thông tin bài viết thành công ";
        } else {
            $error = "Xóa thông tin bài viết thất bại";
        }
        return redirect()->route('listblog')->with('success', 'Xóa thông tin bài viết thành công ');
    }

    public function getSearchBlog(Request $request)
    {
        $keyword = $request->input('search');
        if ($keyword == null) {
            return redirect()->route('listblog')->with('error', 'Vui lòng nhập từ khóa bạn tìm kiếm');
        } else {
            $search = Blog::where('title', 'like', '%' . $keyword . '%')
                ->orWhere('description', 'like', '%' . $keyword . '%');
            if ($search->count() == 0) {
                return redirect()->route('listblog')->with('error', 'Thông tin bài viết bạn cần tìm không tồn tại !');
            } else {
                $blog = $search->get();
                return view('backend.blog.listblog', ['blog' => $blog]);
            }
        }
    }
}
