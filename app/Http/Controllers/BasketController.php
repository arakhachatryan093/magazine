<?php

namespace App\Http\Controllers;

use App\models\Order;
use App\models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
//    public function __construct()
//    {
//
//        $this->middleware('basket_not_empty');
//    }

    public function basket() {
        $order_id = session('orderId');
        if(!is_null($order_id)){
            $order = Order::findOrFail($order_id);
        }
        return view('basket',compact('order'));
    }
    public function basketPlace() {
        $order_id = session('orderId');
        if(is_null($order_id)) {
            return redirect()->route('index');
        }
        $order = Order::findOrFail($order_id);
        return view('order',compact('order'));
    }
    public function basketAdd($productId) {
        $orderId = session('orderId');

        if(is_null($orderId)){
            $order= Order::create(
                ['id' => $orderId]
            );

            session(['orderId' => $order->id]);
        }else{
            $order = Order::find($orderId);
        }

        if ($order->products->contains($productId)){
             $pivotRow = $order->products()->where('product_id',$productId)->first()->pivot;
             $pivotRow->count++;
             $pivotRow->update();
        }else{
            $order->products()->attach($productId);
        }
        if (Auth::check()) {
            $order->user_id = Auth::id();
            $order->save();
        }

        $product = Product::find($productId);
        session()->flash('success','Добавлен товар' . ' '.$product->name);
        return redirect()->route('basket');


    }
    public function basketRemove($productId) {
        $order_id = session('orderId');
        if (is_null($order_id)){
            return redirect()->route('basket');
        }
        $order = Order::find($order_id);

        if ($order->products->contains($productId)){
            $pivotRow = $order->products()->where('product_id',$productId)->first()->pivot;
            if ($pivotRow->count < 2 ){
                $order->products()->detach($productId);
            }else{
                $pivotRow->count--;
                $pivotRow->update();
            }

        }
        $product = Product::find($productId);
        session()->flash('warning','Удален товар'.$product->name);
        return redirect()->route('basket');

    }

    public function basketConfirm(Request $request) {
        $order_id = session('orderId');
        if(is_null($order_id)) {
            return redirect()->route('index');
        }
        $order = Order::findOrFail($order_id);
        $success =  $order->saveOrder($request->name,$request->phone);
        if ($success){
            session()->flash('success','Ваш заказ принят в обработку');
        }else{
            session()->flash('warning','Случилось ошибка,повторите попытку');
        }
        return redirect()->route('index');

    }
}
