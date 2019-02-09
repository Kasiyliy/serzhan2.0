<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Validator;
use Session;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index' , compact("categories"));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back();
        }else{
            $category =  new Category();
            $category->name = $request->name;
            $category->save();
            Session::flash('success' , 'Категория успешно добавлена!');
            return redirect()->back();
        }
    }

    public function delete($id){
        $category = Category::find($id);
        if($category){
            $category->delete();
            Session::flash('success' , 'Категория успешно удалена!');
        }else{
            Session::flash('error' , 'Категория не существует!');
        }
        return redirect()->back();
    }

    public function edit($id){
        $category = Category::find($id);
        if(!$category){
            Session::flash('error' , 'Категория не существует!');
            return redirect()->back();
        }

        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id){
        $category = Category::find($id);
        if(!$category){
            Session::flash('error' , 'Категория не существует!');
            return redirect()->back();
        }

        $validator = Validator::make($request->all(), [
            'name' =>'required'
        ]);

        if ($validator->fails()) {
            Session::flash('error' , 'Ошибка!');
            return redirect()->back()->withErrors($validator);
        }else{
            $category->name = $request->name;
            $category->save();
            Session::flash('success' , 'Категория успешно обновлена!');
            return redirect()->back();
        }
    }



}
