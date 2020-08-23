<?php

namespace App\Http\Controllers\Backend;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeReqest;
use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.employee.index');
    }
    protected function datatable()
    {
        $employee = User::get();
        $route = 'employee';
        return Datatables::of($employee)->addColumn('action', function ($data) use ($route) {
            return view('backend.datatables.actions', compact('data', 'route'));
        })->addColumn('roles', function ($data) {
            return view('backend.datatables.roles', compact('data'));
        })->rawColumns(['roles', 'action'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('backend.employee.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEmployeeRequest $request)
    {
        $input = $request->all();
        $user =  User::create($input);
        $user->syncRoles(request('role'));
        return redirect()->route('admin.employee.index')->with('success', 'The employee has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = (int) $id;
        $employee = User::findOrFail($id);
        $roles = Role::all();
        return view('backend.employee.edit', compact('employee', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeReqest $request, $id)
    {
        $input = $request->except(['_token', '_method','role']);
        $user= User::findOrFail($id);
        User::where('id', $id)->update($input);
        $user->syncRoles(request('role'));
        return redirect()->route('admin.employee.index')->with('success', 'The empolyee has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id);
        User::destroy($id);
        return redirect()->back()->with('success', 'The Employee has been deleted successfully');
    }
}
