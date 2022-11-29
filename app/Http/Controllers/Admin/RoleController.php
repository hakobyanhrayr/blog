<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoleRequest;
use App\Models\admin\Role;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RoleController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
//        dd('show');
        $roles = Role::all();

        return  view('admin.role.show',compact('roles'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
//        dd('create');
        return view('admin.role.create');
    }

    /**
     * @param RoleRequest $request
     * @return RedirectResponse
     */
    public function store(RoleRequest $request)
    {
//        $this->validate($request,['name'=>'required|string|unique:role']);

        Role::query()->create($request->validated());

        return redirect()->route('role.index');
    }

    /**
     * @param $id
     * @return void
     */
    public function show($id)
    {
       //
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $role = Role::query()->findOrFail($id);

        return view('admin.role.edit',compact('role'));
    }

    /**
     * @param RoleRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(RoleRequest $request, $id): RedirectResponse
    {
        $role = Role::query()->findOrFail($id);

        $role->update($request->validated());

        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        Role::where('id',$id)->delete();

        return redirect()->route('role.index');
    }
}
