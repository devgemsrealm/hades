<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return RoleResource::collection(Role::latest()->paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        $role = new Role();

        $role->id = $request->id;
        $role->name = $request->name;
        $role->description = $request->description;
        $role->save();

        return new RoleResource($role);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */

    public function show(Role $role)
    {
        return new RoleResource($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        $role->update($request->only(['title', 'body']));
        return new RoleResource($role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(null, 204);
    }

    public function all()
    {
        // $posts = Role::latest()->paginate(5);
        // return $posts->toArray();

    }

    public function single(Role $role)
    {
        return view('single', compact('role'));
    }
}