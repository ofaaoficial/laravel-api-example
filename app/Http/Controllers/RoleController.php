<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Validator;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAuthenticated');
        $this->middleware('isAdmin')->only(['destroy', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->success(Role::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|unique:roles'
        ]);

        if ($v->fails()) return $this->bad($v->errors());

        Role::create($request->all());

        return $this->successRegister();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);

        if($role) return $this->success($role);

        return $this->bad();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        if (!count($request->all()) || !$role) return $this->bad();

        $role->update($request->all());
        return $this->success();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);

        if (! $role) return $this->bad();

        $role->delete();
        return $this->success();
    }
}
