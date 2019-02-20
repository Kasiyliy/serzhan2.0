<?php

namespace App\Http\Controllers;

use App\Client;
use App\Item;
use App\Order;
use App\OrderItem;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('admin.orders.index',compact('orders'));
    }

    public function accept($id){
        $order = Order::findOrFail($id);
        $order->accepted = !$order->accepted;
        $order->save();
        Session::flash('success' , $order->accepted ? 'Заказ принят!' : 'Заказ отклонен!');
        return redirect()->back();
    }

    public function create(){

        $clients = Client::all();
        $users = User::all();
        return view('admin.orders.create',compact('clients', 'users'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'price' =>'required|numeric',
            'client_id' =>'required|numeric',
            'productId.*' =>'required|numeric|min:0',
            'productPrice.*' =>'required|numeric|min:0',
            'productQuantity.*' =>'required|numeric|min:0',
        ]);

        if($validator->fails()){
            Session::flash('error' , 'Произошла ошибка!');
            return redirect()->back()->withErrors($validator);
        }


        $order = new Order();
        $order->fill($request->all());
        $order->user_id = Auth::id();;

        $productIds = $request->productId;
        $productPrice = $request->productPrice;
        $productQuantity = $request->productQuantity;

        if(!(count($productIds) == count($productPrice) && count($productPrice)  == count($productQuantity))){
            Session::flash('error' , 'Произошла ошибка ввода данных!');
            return redirect()->back();
        }else{

            for($i = 0 ; $i < count($productIds);$i++) {
                if (!Item::where('id', '=', $productIds[$i])->exists()) {
                    Session::flash('error' , 'Произошла ошибка ввода данных!');
                    return redirect()->back();
                }
            }

            $order->save();

            for($i = 0 ; $i < count($productIds);$i++){
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->item_id = $productIds[$i];
                $orderItem->quantity = $productQuantity[$i];
                $orderItem->price = $productPrice[$i];
                $orderItem->save();
            }
            Session::flash('success' , 'Заказ успешно осуществлен!');
            return redirect()->route('order.index');
        }
    }
}
