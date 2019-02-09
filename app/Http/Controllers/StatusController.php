<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;
use Validator;
use Session;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
            echo "error";
            return redirect()->back();
        }else{
            $status =  new Status();
            $status->name = $request->name;
            $status->save();
            Session::flash('success' , 'Статус успешно добавлен!');
            return redirect()->back();
        }
    }
}
