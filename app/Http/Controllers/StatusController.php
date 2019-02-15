<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;
use Validator;
use Session;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::all();
        return view('admin.statuses.index' , compact("statuses"));
    }

    public function create()
    {
        return view('admin.statuses.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{
            $status =  new Status();
            $status->name = $request->name;
            $status->save();
            Session::flash('success' , 'Статус успешно добавлен!');
            return redirect()->back();
        }
    }


    public function delete($id){
        $status = Status::find($id);
        if($status){
            $status->delete();
            Session::flash('success' , 'Статус успешно удален!');
        }else{
            Session::flash('error' , 'Статус не существует!');
        }
        return redirect()->back();
    }

    public function edit($id){
        $status = Status::find($id);
        if(!$status){
            Session::flash('error' , 'Статус не существует!');
            return redirect()->back();
        }

        return view('admin.statuses.edit', compact('status'));
    }

    public function update(Request $request, $id){
        $status = Status::find($id);
        if(!$status){
            Session::flash('error' , 'Статус не существует!');
            return redirect()->back();
        }

        $validator = Validator::make($request->all(), [
            'name' =>'required'
        ]);

        if ($validator->fails()) {
            Session::flash('error' , 'Ошибка!');
            return redirect()->back()->withErrors($validator);
        }else{
            $status->name = $request->name;
            $status->save();
            Session::flash('success' , 'Статус успешно обновлен!');
            return redirect()->back();
        }
    }
}
