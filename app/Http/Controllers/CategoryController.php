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
            echo "error";
            return redirect()->back();
        }else{
            $category =  new Category();
            $category->name = $request->name;
            $category->save();
            Session::flash('success' , 'Категория успешно добавлена!');
            return redirect()->back();
        }
    }
}
