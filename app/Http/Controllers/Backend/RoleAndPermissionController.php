<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Flash;
use Response;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;

class RoleAndPermissionController extends Controller
{

    public function createNew()
    {
        // $role = Role::create(['name' => 'employee']);
        // $role = Role::findByName('employee');
        // $role = Role::where('name','moderator')->first();
        // dd($role);
        // dd($role);
        // $permissions = Permission::create(['name' => 'send_request']);
        // $permission = Permission::create(['name' => 'edit']);
        // $permission = Permission::create(['name' => 'delete']);
        // $permissions = Permission::all();
        // dd($permissions);
        // $role->syncPermissions($permissions);
        // $role->givePermissionTo($permissions);
        // $role->givePermissionTo($permissions);

        // foreach ($permissions as $key => $permission) {
        //     $permission->assignRole($role->name);
        // }
        // $permission->assignRole($role->name);
        // $permissions->syncRoles($role);
        // auth()->user()->givePermissionTo('access_control_panel');
        // auth()->user()->revokePermissionTo('show_widgets');
        // auth()->user()->givePermissionTo('show_widgets');
        // auth()->user()->revokePermissionTo('show_widgets');
        // auth()->user()->assignRole('admin');

        return response()->json([
            'message' =>  "Success"
        ]);
    }
    /**
     * Display a listing of the RoleAndPermmison.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        return view('backend.role_and_permmisons.index');
    }
    protected function datatable(){
        $roles = Role::get();
        $route = 'role';
        return Datatables::of($roles)->addColumn('action', function ($data) use($route) {
            return view('backend.datatables.actions',compact('data','route'));
        })->rawColumns(['action'])
        ->make(true);
     }
    /**
     * Show the form for creating a new RoleAndPermmison.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::get();
        $permissions = Permission::get();

        return view('backend.role_and_permmisons.create')->with(['permissions' => $permissions]);
    }

    /**
     * Store a newly created RoleAndPermmison in storage.
     *
     * @param CreateRoleAndPermmisonRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input =request()->all();
        $role = Role::create(['name'=>$input['role']]);
        $role->syncPermissions($input['permission']);
        // Flash::success('Role And Permmison saved successfully.');
        return redirect(route('admin.role.index'));
    }

    public function getPermissions()
    {

        if(request()->ajax()){
            $role = Role::find(request()->id);
            $permissions = Permission::get();
            if($role){
                return response()->json([
                    $role->permissions,
                    $permissions
                    ]);
            }else{
                return response()->json([]);
            }
           
        }
    }

    /**
     * Display the specified RoleAndPermmison.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $roleAndPermmison = Role::findOrFail($id);

        return view('backend.role_and_permmisons.show')->with('roleAndPermmison', $roleAndPermmison);
    }

    /**
     * Show the form for editing the specified RoleAndPermmison.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::get();
        return view('backend.role_and_permmisons.edit')->with(['role'=> $role,'permissions'=>$permissions]);
    }

    /**
     * Update the specified RoleAndPermmison in storage.
     *
     * @param int $id
     * @param UpdateRoleAndPermmisonRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        request()->validate([
            'role'=>'required|integer',
            'permission'=>'required',
        ]);
        $input =request()->all();

        $role = Role::findOrFail($input['role']);

        $role->syncPermissions($input['permission']);
        // Flash::success('Role And Permmison updated successfully.');

        return redirect(route('admin.role.index'));
    }

    /**
     * Remove the specified RoleAndPermmison from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $roleAndPermmison = Role::findOrFail($id);

        Role::delete($id);

        // Flash::success('Role deleted successfully.');

        return redirect(route('admin.role.index'));
    }
}
