<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use Illuminate\Http\Request;
use Validator;
use Session;

class ItemController extends Controller
{
    public function index()
    {
        $allPrice = 0;
        $items = Item::has('category')->with('category')->get();
        foreach ($items as $item){
            $allPrice += ($item->price * $item->quantity);
        }
        return view('admin.items.index' , compact("items", "allPrice"));
    }

    public function create()
    {
        $categories = Category::all();
        if(count($categories) == 0){
            Session::flash('error' , 'Категории не существуют!');
            return redirect()->back();
        }
        return view('admin.items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>'required',
            'category_id' =>'required|numeric',
            'quantity' =>'required|numeric|min:0',
            'price' =>'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{
            $item =  new Item();
            $item->fill($request->all());
            $item->save();
            Session::flash('success' , 'Продукт успешно добавлен!');
            return redirect()->back();
        }
    }


    public function delete($id){
        $item = Item::find($id);
        if($item){
            $item->delete();
            Session::flash('success' , 'Продукт успешно удален!');
        }else{
            Session::flash('error' , 'Продукт не существует!');
        }
        return redirect()->back();
    }


    public function edit($id){
        $item = Item::find($id);
        if(!$item){
            Session::flash('error' , ' Продукт не существует!');
            return redirect()->back();
        }
        $categories = Category::all();
        if(count($categories) == 0){
            Session::flash('error' , 'Категорий не существует!');
            return redirect()->back();
        }
        return view('admin.items.edit', compact('item' , 'categories'));
    }

    public function update(Request $request, $id){
        $item = Item::find($id);

        if(!$item){
            Session::flash('error' , 'Продукт не существует!');
            return redirect()->back();
        }

        $validator = Validator::make($request->all(), [
            'name' =>'required',
            'category_id' =>'required|numeric',
            'quantity' =>'required|numeric|min:0',
            'price' =>'required|numeric|min:0',
        ]);

        $category = Category::find($request->category_id);
        if(!$category){
            Session::flash('error' , 'Категория не существует!');
            return redirect()->back();
        }

        if ($validator->fails()) {
            Session::flash('error' , 'Ошибка!');
            return redirect()->back()->withErrors($validator);
        }else{
            $item->fill($request->all());
            $item->save();
            Session::flash('success' , 'Продукт успешно обновлен!');
            return redirect()->back();
        }
    }
}
