<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $order, $menu;

    public function __construct()
    {
        $this->order = new Order();
        $this->menu = new Menu();
    }


    public function showOrder(Request $request)
    {
        $orders = $this->order->getAllOrder();
        $menus = $this->menu->getAllMenu();
        return view('frontend.order', compact('menus', 'orders'));
    }

    public function addOrder(Request $request)
    {
        $cart = session()->get('cart');
        $user = Auth::user();
        if (empty($user)) {
            return response()->json(['status' => 400, 'route' => route('login')]);
        } elseif (empty($cart)) {
            return response()->json(['status' => 404, 'msg' => "Shopping cart is empty!"]);
        } else {
            return $this->order->addOrder($request);
        }
    }

    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
