<?php

namespace App\Http\Controllers;

use App\Debtor;
use App\Order;
use Illuminate\Http\Request;
use Session;
use Validator;


class DebtorController extends Controller
{
    //

    public function index(){
        $debtors = Debtor::all();
        return view('admin.debtors.index', compact("debtors"));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'orders' =>'required',
            'price' =>'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{
            $debtor =  new Debtor();
            $debtor->order_id = $request->orders;
            $debtor->price = $request->price;
            $debtor->save();
            Session::flash('success' , 'Должник успешно добавлен!');
            return redirect()->back();
        }
    }

    public function update(Request $request,$id){
        $debtor = Debtor::find($id);
        if(!$debtor){
            Session::flash('error' , 'Такого должника не существует!');
            return redirect()->back();
        }

        $validator = Validator::make($request->all(), [
            'orders' =>'required',
            'price' =>'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error' , 'Ошибка!');
            return redirect()->back()->withErrors($validator);
        }else{
            $debtor->order_id = $request->orders;
            $debtor->price = $request->price;
            $debtor->save();
            Session::flash('success' , 'Данные должнике успешно обнавлены!');
            return redirect()->back();
        }
    }
    public function edit($id){
        $orders = Order::all();
        $debtor = Debtor::find($id);
        return view('admin.debtors.edit',compact("debtor","orders"));
    }

    public function create(){
        $orders = Order::all();
        return view('admin.debtors.create', compact("orders"));
    }

    public function delete($id){
        $debtor = Debtor::find($id);
        if($debtor){
            $debtor->delete();
            Session::flash('success' , 'Элемент успешно удaлен!');
        }else{
            Session::flash('error' , 'Такого элемента не существует!');
        }
        return redirect()->back();
    }
}
