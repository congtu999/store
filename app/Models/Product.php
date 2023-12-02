<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function carts()
    {
        return $this->belongsTo(Cart::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function order_details()
    {
        return $this->belongsTo(OrderDetail::class);
    }

    public function getProduct()
    {

        return Product::paginate(8);
    }


    public function getProductByIdCategory($id)
    {
        return Product::where('category_id', $id)->paginate(4);
    }

    public
    function getLatestProduct()
    {
        return Product::orderBy('created_at', 'desc')->take(8)->get();
    }

    public
    function getProductDetails($idProduct)
    {
        return Product::find($idProduct);
    }

    public function searchProduct(Request $request)
    {
        $product = Product::where('name', 'Like', '%' . $request->search . '%')
            ->orWhere('price', 'Like', '%' . $request->search . '%')
            ->paginate(8);
        return $product;


    }

    public function getProductByfilter(Request $request)
    {
        $filterField = $request->get('filterField');
        $filterDirection = $request->get('filterDirection');
        $start = $request->get('start') ?? 0;
        $end = $request->get('end') ?? 10000;
        $colors = $request->get('colors');
        $id = $request->get('id');
        $query = Product::where('price', '>=', $start)
            ->where('price', '<=', $end);
        if ($id) {
            $query = $query->where('category_id', $id);
        }
        if ($filterField) {
            $query = $query->orderBy($filterField, $filterDirection ?? 'asc');
        }
        if (!empty($colors)) {
            $query = $query->where('color', $colors);
        }
        return $query->paginate(8);
    }

    public function addProduct($data)
    {

        return DB::table('products')
            ->insert($data);
    }


    public function updateProduct(Request $request, $id)
    {
        $file = $request->file('hinhanh'); // Lấy file
        $file1 = $request->file('hinhanh1');
        $file2 = $request->file('hinhanh2');
        $file3 = $request->file('hinhanh3');
        if ($file != null || $file1 != null || $file2 != null || $file3 != null) {
            return DB::table('products')
                ->where('id', '=', $id)
                ->update([
                    'name' => $request->input('name'),
                    'description' => (string)$request->input('description'),
                    'price' => $request->input('price'),
                    'quantity' => $request->input('quantity'),
                    'color' => $request->input('color'),
                    'category_id' => $request->input('category_id'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        } else {
            return DB::table('products')
                ->where('id', '=', $id)
                ->update([
                    'name' => $request->input('name'),
                    'image' => $request->input('hinhanh'),
                    'image_detail_1' => $request->input('hinhanh1'),
                    'image_detail_2' => $request->input('hinhanh2'),
                    'image_detail_3' => $request->input('hinhanh3'),
                    'description' => (string)$request->input('description'),
                    'price' => $request->input('price'),
                    'quantity' => $request->input('quantity'),
                    'color' => $request->input('color'),
                    'category_id' => $request->input('category_id'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        }
    }

    public function deleteProduct($id)
    {

        return DB::table('products')
            ->where('id', '=', $id)
            ->delete();
    }

    public function getAllProduct()
    {
        return DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select("products.id", "products.name", "image", "image_detail_1", "image_detail_2", "image_detail_3", "description", "price", "quantity", "color", "category_id",)
            ->paginate(8);
    }

    public function getAllCategory()
    {
        return DB::table('categories')
            ->select('id', 'name')
            ->get();
    }

}
