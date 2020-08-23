<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRequsetReqest;
use App\Logs;
use App\Requests;
use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class RequsettoseekpermissionController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.seekpermission.index');
    }

    protected function datatable(){
        // dd('asd');
       $requests = Requests::where('user_id',auth()->user()->id)->get();
       $route = 'request';
       return Datatables::of($requests)->addColumn('action', function ($data) use($route) {
           return view('backend.datatables.actions',compact('data','route'));
       })->rawColumns(['action'])
       ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.seekpermission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Requests\CreateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequsetReqest $request)
    {
        $input = $request->all();
        Requests::create([
            'user_id'=>auth()->user()->id,
            'note'=>$input['note'],
        ]);
        return redirect()->route('admin.request.index')->with('success','The request has been added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request = Requests::findOrFail($id);
        $user = $request->logs->first();
        // dd($user);
        $user = User::findOrFail($user->admin_id);

        // dd($user);
       return response()->json([
           'modal'=>'
           <!-- Button trigger modal -->
           <button type="button" id="chickToshowModal" class="btn btn-primary d-none" data-toggle="modal" data-target="#exampleModal">
            </button>

               <!-- Modal -->
               <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                   <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel"></h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <div class="modal-body">
                   <p>  admin : '.$user->name.'</p>
                   <p> status : '.$request->status.'</p>
                    
                     
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                   </div>
                   </div>
               </div>
               </div>
              
              ',
       ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return back();
        // $id = (int) $id;
        // $request = Requests::findOrFail($id);
        // return view('backend.seekpermission.edit',compact('request'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  app\Http\rRequests\UpdateUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(UpdateUserRequest $request, $id)
    // {
    //     $input = $request->except(['_token','_method']);
    //     $user = User::findOrFail($id);
    //     if (request()->hasfile('image')) {
    //         $input['image'] = $imageService->upload($input['image'],'profile');
    //     }
    //     User::where('id',$id)->update($input);
    //     return redirect()->route('admin.users.index')->with('success','The user has been updated successfully');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $log = Logs::findOrFail($id);
        if ($log) {
            abort(403,'unauthorized');
        }
        Requests::findOrFail($id);
        Requests::destroy($id);
        return redirect()->back()->with('success','The Request has been deleted successfully');
    }



   
}
