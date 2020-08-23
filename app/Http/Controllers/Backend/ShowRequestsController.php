<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Logs;
use App\Requests;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;

class ShowRequestsController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.show_requests.index');
    }
    protected function datatable(){
        $requests = Requests::get();
        $route = 'updaterequest';
        return Datatables::of($requests)->addColumn('action', function ($data) use($route) {
            if (auth()->user()->hasPermissionTo('edit_status')) {
                return view('backend.datatables.btnAcceptAndReject',compact('data','route'));
            }
            if($data->status == 'pendding'){
                return view('backend.datatables.btnAcceptAndReject',compact('data','route'));
            }elseif($data->status == 'accepted'){
               return `<a class="btn btn-success disabled" style="color: #fff"  data-target="#modal-danger">  <i class="fas fa-check"></i>  accepted </a>`;
            }else{
                return `<a class="btn btn-danger disabled" style="color: #fff"  data-target="#modal-danger">  <i class="fas fa-check"></i>  rejected </a>`;
            }
        })->addColumn('owner', function ($data) {
            return $data->employee->name;
        })->addColumn('email', function ($data) {
            return $data->employee->email;
        })
        ->rawColumns(['owner','action'])
        ->make(true);
     }

     public function update($user_id,$order_id,$status)
     {
        $status = (int) $status;
        $user_id = (int) $user_id;
        $order_id = (int) $order_id;
        User::findOrFail($user_id);
        Requests::findOrFail($order_id);
        
        if(!auth()->user()->hasPermissionTo('edit_status')){
            $order_edit = Logs::where(['request_id'=>$order_id])->first();
            if ($order_edit) {
                abort(403,'unauthorized');
            }
        }
       
        $request = Requests::where('id', $order_id)->update([
             'status' => $status
         ]);
        //  dd($status);
         Logs::create([
            'admin_id'=>auth()->user()->id,
            'request_id'=>$order_id,
            'status' => $status,
         ]);
       return back();
     }
     public function showLogs()
     {
        // $logs = Logs::with('request.employee','user')->get();
        // dd($logs[0]->request->employee);
        return view('backend.logs.index');


     }

     public function datatableLog()
     {
      
            $logs = Logs::get();
            return Datatables::of($logs)
            ->addColumn('owner_of_status', function ($data) {
                return $data->user->name;
            })->addColumn('owner_of_request', function ($data) {
                return $data->request->employee->name;
            })->addColumn('email', function ($data) {
                return $data->request->employee->email;
            })->addColumn('note', function ($data) {
                return $data->request->note;
            })->rawColumns(['owner_of_request','owner_of_status'])->make(true);
         
     }
}
