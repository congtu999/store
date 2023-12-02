<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    protected $about;

    public function __construct(About $about)
    {
        $this->about = $about;
    }

    public function create()
    {
        return view('backend.about.addabout');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'content' => 'required',
        ], [
            'title.required' => 'Tên title about không được để trống',
            'title.min' => 'Tên title about phải có ít nhất 3 kí tự',
            'content.required' => 'Tên content không được để trống',

        ]);


        $data = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => $request->input('hinhanh5'),
            'created_at' => date('Y-m-d H:i:s')

        ];

        $this->about->addAbout($data);
        return redirect()->route('listabout')->with('success', 'Thêm thông tin about thành công');
    }

    public function edit(Request $request, $id = 0)
    {
        if (!empty($id)) {
            $aboutDetail = $this->about->getDetail($id);
            if (!empty($aboutDetail[0])) {
                $request->session()->put('id', $id);
                return view('backend.about.editabout', [
                    'aboutDetail' => $aboutDetail,
                ]);
            }
        }
    }

    public function show()
    {
        $about = $this->about->getAllAbout();
        return view('backend.about.listabout', ['about' => $about]);
    }

    public function update(Request $request)
    {
        $id = session('id');
        $request->validate([
            'title' => 'required|min:3',
            'content' => 'required',
        ], [
            'title.required' => 'Tên title about không được để trống',
            'title.min' => 'Tên title about phải có ít nhất 3 kí tự',
            'content.required' => 'Tên content không được để trống',

        ]);

        $this->about->updateAbout($request, $id);
        return redirect()->route('listabout')->with('success', 'Cập nhật thông tin about thành công');


    }

    public function destroy($id)
    {
        $delete = $this->about->deleteAbout($id);
        if ($delete) {
            $success = "Xóa thông tin about thành công ";

        } else {
            $error = "Xóa thông tin about thất bại";
        }
        return redirect()->route('listabout')->with('success', 'Xóa thông tin about thành công ');
    }

    public function getSearchAbout(Request $request)
    {
        $keyword = $request->input('search');
        if ($keyword == null) {
            return redirect()->route('listabout')->with('error', 'Vui lòng nhập từ khóa bạn tìm kiếm');
        } else {
            $search = About::where('title', 'like', '%' . $keyword . '%')
                ->orWhere('content', 'like', '%' . $keyword . '%');
            if ($search->count() == 0) {
                return redirect()->route('listabout')->with('error', 'Thông tin about bạn cần tìm không tồn tại !');
            } else {
                $about = $search->get();
                return view('backend.about.listabout', ['about' => $about]);
            }
        }
    }

}
