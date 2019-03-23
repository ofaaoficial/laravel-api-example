<?php

namespace App\Http\Controllers;

use App\Department;
use Validator;
use Illuminate\Http\Request;

class DepartmentController extends Controller
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
        return $this->success(Department::all());
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
            'name' => 'required|unique:departments'
        ]);

        if ($v->fails()) return $this->bad($v->errors());

        Department::create($request->all());

        return $this->successRegister();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = Department::find($id);

        if($department) return $this->success($department);

        return $this->bad();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $department = Department::find($id);

        if (!count($request->all()) || !$department) return $this->bad();

        $department->update($request->all());
        return $this->success();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::find($id);

        if (! $department) return $this->bad();

        $department->delete();
        return $this->success();
    }
}
