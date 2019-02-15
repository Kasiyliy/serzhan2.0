<?php

namespace App\Http\Controllers\Api;

use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function index(){
        $items = Item::where('quantity', '>', 0)->get();
        return response()->json( $items );
    }
}
