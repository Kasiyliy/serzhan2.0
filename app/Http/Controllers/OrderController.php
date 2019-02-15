<?php

namespace App\Http\Controllers;

use App\Client;
use App\Order;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('admin.orders.index',compact('orders'));
    }

    public function create(){

        $clients = Client::all();
        $users = User::all();
        return view('admin.orders.create',compact('clients', 'users'));
    }
}
