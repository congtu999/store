<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        return view('backend.category.addcategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',

        ], [
            'name.required' => 'Tên danh mục không được để trống',
            'name.min' => ' Tên danh mục phải có từ 2 kí tự',

        ]);

        $data = [

            'name' => $request->input('name'),
            'created_at' => date('Y-m-d H:i:s')

        ];

        $this->category->addCategory($data);
        return redirect()->route('listcategory')->with('success', 'Thêm danh mục sản phẩm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category = $this->category->getAllCategory();

        return view('backend.category.listcategory', compact('category'));
    }

    public function edit($id = 0, Request $request)
    {
        if (!empty($id)) {
            $categoryDetail = $this->category->getDetail($id);
            if (!empty($categoryDetail[0])) {
                $request->session()->put('id', $id);
                return view('backend.category.editcategory', [
                    'categoryDetail' => $categoryDetail,

                ]);
            }
        }
    }

    public function update(Request $request, Category $category)
    {
        $id = session('id');
        $request->validate([
            'name' => 'required|min:2',
        ], [
            'name.required' => 'Tên danh mục không được để trống',
            'name.min' => ' Tên danh mục phải có từ 2 kí tự',

        ]);
        $dataUpdate = [

            'name' => $request->input('name'),
            'updated_at' => date('Y-m-d H:i:s')

        ];

        $this->category->updateCategory($dataUpdate, $id);
        return redirect()->route('listcategory')->with('success', 'Cập nhật danh mục sản phẩm thành công');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete = $this->category->deleteCategory($id);
        if ($delete) {
            $success = "Xóa danh mục sản phẩm thành công ";

        } else {
            $error = "Xóa danh mục sản phẩm thất bại";
        }
        return redirect()->route('listcategory')->with('success', 'Xóa danh mục sản phẩm thành công ');
    }

    public function getSearchCategory(Request $request)
    {
        $keyword = $request->input('search');
        if (empty($keyword)) {
            return redirect()->route('listcategory')->with('error', 'Bạn cần nhập danh mục cần tìm  !');

        } else {
            $search = Category::where('name', 'like', '%' . $keyword . '%');
            if ($search->count() == 0) {
                return redirect()->route('listcategory')->with('error', 'Danh mục sản phẩm bạn cần tìm không tồn tại !');
            } else {
                $category = $search->paginate(5);
                return view('backend.category.listcategory', ['category' => $category]);
            }
        }
    }
}
