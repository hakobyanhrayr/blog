<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PermissionRequest;
use App\Models\admin\Permission;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PermissionController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $permissions = Permission::all();

        return view('admin.permission.show',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.permission.create');
    }

    /**
     * @param PermissionRequest $request
     * @return RedirectResponse
     */
    public function store(PermissionRequest $request): RedirectResponse
    {
//        dd($request->validated());
        Permission::create($request->validated());

        return redirect()->route('permission.index')->with('message','Permission Create SuccessFully');
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
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $permission = Permission::query()->findOrFail($id);

        return view('admin.permission.edit',compact('permission'));
    }

    /**
     * @param PermissionRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(PermissionRequest $request, $id)
    {
        $permission = Permission::query()->findOrFail($id);

        $permission->update($request->validated());

        return redirect()->route('permission.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy($id): RedirectResponse
    {
        $permission = Permission::query()->findOrFail($id);

        $permission->delete();

        return redirect()->route('permission.index');
    }
}
