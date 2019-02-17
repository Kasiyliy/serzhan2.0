<?php

namespace App\Http\Controllers;

use App\ReturnItem;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class ReturnController extends Controller
{
    public function index()
    {
        $returns = ReturnItem::all();
        //return view('admin.categories.index' , compact("categories"));
    }

    public function create()
    {
        return view('admin.returns.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{
            $returnItem =  new ReturnItem();
            $returnItem->name = $request->name;
            $returnItem->quantity = $request->quantity;
            $returnItem->save();
            Session::flash('success' , 'Возврат добавлен!');
            return redirect()->back();
        }
    }

    public function delete($id){
        $returnItem = ReturnItem::find($id);
        if($returnItem){
            $returnItem->delete();
            Session::flash('success' , 'Возврат успешно удалена!');
        }else{
            Session::flash('error' , 'Возврат не существует!');
        }
        return redirect()->back();
    }

    public function edit($id){
        $returnItem = ReturnItem::find($id);
        if(!$returnItem){
            Session::flash('error' , 'Возврат не существует!');
            return redirect()->back();
        }

        return view('admin.returns.edit', compact('returnItem'));
    }

    public function update(Request $request, $id){
        $returnItem = ReturnItem::find($id);
        if(!$returnItem){
            Session::flash('error' , 'Возврат не существует!');
            return redirect()->back();
        }

        $validator = Validator::make($request->all(), [
            'name' =>'required',
            'quantity' =>'required'
        ]);

        if ($validator->fails()) {
            Session::flash('error' , 'Ошибка!');
            return redirect()->back()->withErrors($validator);
        }else{
            $returnItem->name = $request->name;
            $returnItem->quantity = $request->quantity;
            $returnItem->save();
            Session::flash('success' , 'Возврат успешно обновлен!');
            return redirect()->back();
        }
    }

}
