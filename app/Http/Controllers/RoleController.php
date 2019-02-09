<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Validator;
use Session;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index' , compact("roles"));
    }

    public function create()
    {
        return view('admin.roles.create');
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
            $role =  new Role();
            $role->name = $request->name;
            $role->save();
            Session::flash('success' , 'Роль успешно добавлена!');
            return redirect()->back();
        }
    }
}
