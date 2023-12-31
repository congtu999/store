<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller

{
    protected $banner;

    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
    }

    public function create()
    {
        return view('backend.banner.addbanner');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'event' => 'required',
        ], [
            'name.required' => 'Tên banner không được để trống',
            'name.min' => 'Tên banner phải có ít nhất 3 kí tự',
            'event.required' => 'Tên event không được để trống',

        ]);


        $data = [
            'name' => $request->input('name'),
            'event' => $request->input('event'),
            'image' => $request->input('hinhanh4'),
            'created_at' => date('Y-m-d H:i:s')

        ];

        $this->banner->addBanner($data);
        return redirect()->route('listbanner')->with('success', 'Thêm thông tin banner thành công');
    }

    public function edit(Request $request, $id = 0)
    {
        if (!empty($id)) {
            $bannerDetail = $this->banner->getDetail($id);
            if (!empty($bannerDetail[0])) {
                $request->session()->put('id', $id);
                return view('backend.banner.editbanner', [
                    'bannerDetail' => $bannerDetail,
                ]);
            }
        }
    }

    public function show()
    {
        $banner = $this->banner->getAllBanner();
        return view('backend.banner.listbanner', ['banner' => $banner]);
    }

    public function update(Request $request)
    {
        $id = session('id');
        $request->validate([
            'name' => 'required|min:3',
            'event' => 'required',
        ], [
            'name.required' => 'Tên banner không được để trống',
            'name.min' => 'Tên banner phải có ít nhất 3 kí tự',
            'event.required' => 'Tên event không được để trống',

        ]);

        $this->banner->updateBanner($request, $id);
        return redirect()->route('listbanner')->with('success', 'Cập nhật thông tin banner thành công');


    }

    public function destroy($id)
    {
        $delete = $this->banner->deleteBanner($id);
        if ($delete) {
            $success = "Xóa thông tin banner thành công ";

        } else {
            $error = "Xóa thông tin banner thất bại";
        }
        return redirect()->route('listbanner')->with('success', 'Xóa thông tin banner thành công ');
    }

    public function getSearchBanner(Request $request)
    {
        $keyword = $request->input('search');
        if ($keyword == null) {
            return redirect()->route('listbanner')->with('error', 'Vui lòng nhập từ khóa bạn tìm kiếm');
        } else {
            $search = Banner::where('name', 'like', '%' . $keyword . '%')
                ->orWhere('event', 'like', '%' . $keyword . '%');
            if ($search->count() == 0) {
                return redirect()->route('listbanner')->with('error', 'Thông tin banner bạn cần tìm không tồn tại !');
            } else {
                $banner = $search->get();
                return view('backend.banner.listbanner', ['banner' => $banner]);
            }
        }
    }

}
