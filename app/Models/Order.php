<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Validator;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function getAllOrder()
    {
        return Order::all();
    }

    public function addOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment' => ['required'],
            "address" => ['required', 'string'],
            'phone' => ['required', 'string', 'max:15', 'regex:/^(\+84|0)[1-9]\d{8}$/'],
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $order = new Order();
            $order->date = Carbon::now()->toDateTimeString();
            $order->phone = $request->phone;
            $order->address = $request->address;
            $order->total_price = $request->total;
            $order->note = $request->note;
            $order->pay_method = $request->payment;
            $order->user_id = Auth::user()->id;
            $order->save();

            $cart = session()->get('cart');
            foreach ($cart as $key => $value) {
                $orderDetail = new OrderDetail();
                $orderDetail->price = $value['price'];
                $orderDetail->quantity = $value['quantity'];
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $key;
                $orderDetail->save();
            }

            $request->session()->forget('cart');
            return response()->json(['status' => 1]);
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getOrderByOrderId($id)
    {
        $user = Auth::user();
        if (isset($user)) {
            return OrderDetail::where('order_id', $id)->get();
        }
    }

}
