<?php

namespace App\Http\Controllers\Api;

use App\Debtor;
use App\Order;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {

        $user = null;
        $orders = Order::query();
        if (!empty($request->get('current_user_id')) and $request->get('current_user_id') != null) {
            $user = User::findOrFail($request->get('current_user_id'));
            if ($user->isVendor()) {
                $orders->where('user_id', $user->id);
            }
        }
        if (!empty($request->get('client_id')) and $request->get('client_id') != null) {
            $orders->where('client_id', $request->get('client_id'));
        }
        if (!empty($request->get('user_id')) and $request->get('user_id') != null) {
            $orders->where('user_id', $request->get('user_id'));
        }

        if ($request->get('accepted') !== null) {
            $orders->where('accepted', $request->get('accepted'));
        }

        if (!empty($request->get('startDate')) and $request->get('startDate') != null
            and !empty($request->get('endDate')) and $request->get('endDate') != null) {

            $date_from = Carbon::parse($request->get('startDate'))->startOfDay();
            $date_to = Carbon::parse($request->get('endDate'))->endOfDay();
            $orders->whereBetween('created_at', array($date_from, $date_to));
        }

        $dataTable = DataTables::of($orders)
            ->editColumn('user_id', function ($order) {
                return $order->user->name;
            })
            ->editColumn('client_id', function ($order) {
                return $order->client->first_name . ' ' . $order->client->last_name;
            })
            ->editColumn('accepted', function ($order) {
                return $order->accepted ? "<span class='text-success'>принят</span>" : "<span class='text-danger'>не принят</span>";
            });
        if ($user->isAdmin()) {
            $dataTable->addColumn('actions', function ($order) {
                return $this->getPrintAction($order) . $this->getDeleteAction($order)
                    . $this->getAcceptAction($order) . $this->getEditAction($order);
            });
        } else if ($user->isVendor()) {
            $dataTable->addColumn('actions', function ($order) {
                $res = $this->getPrintAction($order);
                if(!$order->accepted){
                    $res .= $this->getEditAction($order) . $this->getDeleteAction($order);
                }
                return $res;
            });
        } else if($user->isSuperviewer()){
            $dataTable->addColumn('actions', function ($order) {
                return $this->getPrintAction($order) ;
            });
        }
        $dataTable->rawColumns(['actions','accepted']);


        return $dataTable->make(true);
    }

    public function delete($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            return response()->json([
                'success' => true
            ], 200);
        } else {
            return response()->json([
                'success' => false
            ], 200);
        }
    }

    public function accept($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->accepted = true;
            foreach ($order->orderItems as $orderItem) {
                $item = $orderItem->item;
                $item->quantity -= $orderItem->quantity;
                $item->save();
            }
            $order->save();
            return response()->json([
                'success' => true
            ], 200);
        } else {
            return response()->json([
                'success' => false
            ], 200);
        }
    }

    public function getDebtSum(Request $request){
        $debtors = Debtor::whereIn('order_id', $request->data)->get();

        $sum = 0;
        foreach ($debtors as $debtor){
            $sum+=$debtor->price;
        }

        return response()->json([
            'success' => true,
            'sum' => $sum
        ], 200);
    }

    public function getPrintAction($order)
    {
        return "<a href=\"" . route('order.show', ['id' => $order->id]) . "\" class=\"btn fa fa-print btn-xs mr-1\"></a>";
    }

    public function getDeleteAction($order)
    {
        return "<a type=\"button\"  class=\"btn btn-danger btn-xs mr-1\" onclick='deleteItem(" . $order->id . ")'>Удалить</a>";
    }

    public function getEditAction($order)
    {
        return "<a type=\"button\"  class=\"btn btn-info btn-xs mr-1\" href='".route('order.edit',['id' => $order->id])."'>Изменить</a>";
    }

    public function getAcceptAction($order)
    {
        if (!$order->accepted) {
            return "<a type=\"button\"  class=\"btn btn-warning btn-xs mr-1\" onclick='acceptItem(" . $order->id . ")'>Принять</a>";
        } else {
            return "<a disabled='true' class=\"btn btn-success btn-xs mr-1\">Уже принят</a>";
        }
    }
}
