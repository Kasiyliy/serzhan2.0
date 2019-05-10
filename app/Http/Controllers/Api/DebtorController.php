<?php

namespace App\Http\Controllers\Api;

use App\Debtor;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class DebtorController extends Controller
{


    public function index(Request $request)
    {

        $user = null;
        $debtors = Debtor::query();
//        if (!empty($request->get('current_user_id')) and $request->get('current_user_id') != null) {
//            $user = User::findOrFail($request->get('current_user_id'));
//            if ($user->isVendor()) {
//                $debtors->where('user_id', $user->id);
//            }
//        }
//        if (!empty($request->get('client_id')) and $request->get('client_id') != null) {
//            $debtors->where('client_id', $request->get('client_id'));
//        }
//        if (!empty($request->get('user_id')) and $request->get('user_id') != null) {
//            $debtors->where('user_id', $request->get('user_id'));
//        }


        if (!empty($request->get('startDate')) and $request->get('startDate') != null
            and !empty($request->get('endDate')) and $request->get('endDate') != null) {

            $date_from = Carbon::parse($request->get('startDate'))->startOfDay();
            $date_to = Carbon::parse($request->get('endDate'))->endOfDay();
            $debtors->whereBetween('created_at', array($date_from, $date_to));
        }

        $dataTable = DataTables::of($debtors)
            ->editColumn('order_id', function ($debtor) {
                return $debtor->order->id;
            });

        $dataTable->addColumn('firstName', function ($debtor) {
            return $debtor->order->client->first_name;
        });
        $dataTable->addColumn('lastName', function ($debtor) {
            return $debtor->order->client->last_name;
        });

        $dataTable->addColumn('actions', function ($order) {
            return $this->getDeleteAction($order) . $this->getEditAction($order);
        });

        $dataTable->rawColumns(['actions', 'firstName', 'lastName']);


        return $dataTable->make(true);
    }


    public function delete($id)
    {
        $debtor = Debtor::find($id);
        if ($debtor) {
            $debtor->delete();
            return response()->json([
                'success' => true
            ], 200);
        } else {
            return response()->json([
                'success' => false
            ], 200);
        }
    }

    public function getDeleteAction($debtor)
    {
        return "<a type=\"button\"  class=\"btn btn-danger btn-xs mr-1\" onclick='deleteItem(" . $debtor->id . ")'>Удалить</a>";
    }

    public function getEditAction($debtor)
    {
        return "<a type=\"button\"  class=\"btn btn-info btn-xs mr-1\" href='" . route('debtor.edit', ['id' => $debtor->id]) . "'>Изменить</a>";
    }
}
