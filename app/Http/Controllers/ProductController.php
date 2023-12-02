<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FeedBack;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $product, $category, $menu, $feedback;

    public function __construct()
    {
        $this->product = new Product();
        $this->category = new Category();
        $this->menu = new Menu();
        $this->feedback = new FeedBack();
    }


    public function showProductDetail(Request $request)
    {
        $id = $request->get('id');
        $product = $this->product->getProductDetails($id);
        $relatedProducts = $this->product->getLatestProduct();
        $menus = $this->menu->getAllMenu();
        return view('frontend.product-details', compact('menus', 'product', 'relatedProducts'));

    }

    public function searchProduct(Request $request)
    {
        if ($request->ajax()) {
            $products = $this->product->searchProduct($request);
            $output = view('frontend.products.list', compact('products'))->render();
            return response()->json(['html' => $output, 'pagination' => $products->appends(request()->all())->links('frontend.pagination')->toHtml()]);
        }
    }

    public function getProductByFilter(Request $request)
    {
        $products = $this->product->getProductByfilter($request);
        $menus = $this->menu->getAllMenu();
        $categories = $this->category->getAllCategory();
        return view('frontend.shop', compact('products', 'menus', 'categories'));
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->product->getAllCategory();
        return view('backend.product.addproduct')->with('categories', $categories);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|min:3',
            'price' => 'required',
            'quantity' => 'required',
            'color' => 'required',
            'category_id' => 'required',
        ], [
            'name.required' => 'Tên sản phẩm không được để trống',
            'name.min' => 'Tên sản phẩm phải có ít nhất 3 kí tự',
            'price.required' => 'Giá sản phẩm không được để trống',
            'quantity.required' => 'Số lượng sản phẩm không được để trống',
            'color.required' => 'Màu sắc sản phẩm không được để trống',
            'category_id.required' => 'Danh mục sản phẩm không được để trống',
        ]);

        $data = [
            'name' => $request->input('name'),
            'image' => $request->input('hinhanh'),
            'image_detail_1' => $request->input('hinhanh1'),
            'image_detail_2' => $request->input('hinhanh2'),
            'image_detail_3' => $request->input('hinhanh3'),
            'description' => (string)$request->input('description'),
            'price' => (float)$request->input('price'),
            'quantity' => (int)$request->input('quantity'),
            'color' => $request->input('color'),
            'category_id' => $request->input('category_id'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->product->addProduct($data);
        return redirect()->route('listproduct')->with('success', 'Thêm sản phẩm thành công');
    }


    public function show()
    {
        $product = $this->product->getAllProduct();
        return view('backend.product.listproduct', compact('product'));
    }


    public function edit(Request $request, $id = 0)
    {
        if (!empty($id)) {
            $productDetail = $this->product->getDetail($id);
            if (!empty($productDetail[0])) {
                $request->session()->put('id', $id);
                $category = $this->product->getAllCategory();
                return view('backend.product.editproduct', [
                    'productDetail' => $productDetail,
                    'category' => $category
                ]);
            }
        }
    }

    public function update(Request $request)
    {
        $id = session('id');
        $request->validate([
            'name' => 'required|min:3',
            'price' => 'required',
            'quantity' => 'required',
            'color' => 'required',
            'created_at' => date('Y-m-d H:i:s')


        ], [
            'name.required' => 'Tên sản phẩm không được để trống',
            'name.min' => ' Tên sản phẩm phải có từ 3 kí tự',
            'price.required' => 'Giá sản phẩm không được để trống',
            'quantity.required' => 'Số lượng sản phẩm không được để trống',
            'color.required' => 'Màu sắc sản phẩm không được để trống',

        ]);
        $this->product->updateProduct($request, $id);
        return redirect()->route('listproduct')->with('success', 'Cập nhật sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete = $this->product->deleteProduct($id);
        if ($delete) {
            $success = "Xóa sản phẩm thành công ";
        } else {
            $error = "Xóa sản phẩm thất bại";
        }
        return redirect()->route('listproduct')->with('success', 'Xóa sản phẩm thành công ');
    }

    public function getSearchProduct(Request $request)
    {
        $keyword = $request->input('search');
        if (empty($keyword)) {
            return redirect()->route('listproduct')->with('error', 'Bạn cần nhập sản phẩm cần tìm  !');
        } else {
            $search = Product::where('name', 'like', '%' . $keyword . '%')
                ->orWhere('price', 'like', '%' . $keyword . '%')
                ->orWhere('description', 'like', '%' . $keyword . '%')
                ->orWhere('color', 'like', '%' . $keyword . '%')
                ->orWhere('quantity', 'like', '%' . $keyword . '%');
            if ($search->count() == 0) {
                return redirect()->route('listproduct')->with('error', 'Sản phẩm bạn cần tìm không tồn tại !');
            } else {
                $products = $search->paginate(5);
                return view('backend.product.listproduct', ['product' => $products]);
            }
        }
    }
}
