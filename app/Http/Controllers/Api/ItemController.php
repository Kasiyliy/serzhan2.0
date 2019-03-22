<?php

namespace App\Http\Controllers\Api;

use App\Item;
use App\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function index(){
        $items = Item::where('quantity', '>', 0)->where('status_id', '=', Status::IN_STORAGE_ID)->get();
        return response()->json( $items );
    }
}
