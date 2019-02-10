<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Validator;
use Session;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $clients = Client::all();
        return view('admin.clients.index' , compact("clients"));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' =>'required',
            'last_name' =>'required'
        ]);

        if ($validator->fails()) {
            echo "error";
            return redirect()->back();
        }else{
            $client =  new Client();
            $client->first_name = $request->first_name;
            $client->last_name = $request->last_name;
            $client->phone_number = $request->phone_number;
            $client->save();
            Session::flash('success' , 'Клиент успешно добавлен!');
            return redirect()->back();
        }
    }


    public function delete($id){
        $client = Client::find($id);
        if($client){
            $client->delete();
            Session::flash('success' , 'Клиент успешно удлен!');
        }else{
            Session::flash('error' , 'Такого клиента не существует!');
        }
        return redirect()->back();
    }

    public function edit($id){
        $client = Client::find($id);
        if(!$client){
            Session::flash('error' , 'Такого клиента не существует!');
            return redirect()->back();
        }

        return view('admin.clients.edit', compact('category'));
    }

    public function update(Request $request, $id){
        $category = Category::find($id);
        if(!$category){
            Session::flash('error' , 'Такого клиента не существует!');
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
