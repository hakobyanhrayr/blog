<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoleRequest;
use App\Models\admin\Permission;
use App\Models\admin\Role;
use App\Models\user\Post;
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
    public function index(): View
    {
        $roles = Role::query()->get();

        return view('admin.role.show', compact('roles'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): View
    {
        $permissions = Permission::query()->get();

        return view('admin.role.create', compact('permissions'));
    }

    /**
     * @param RoleRequest $request
     * @return RedirectResponse
     */
    public function store(RoleRequest $request): RedirectResponse
    {

        $role = Role::query()->create($request->only(['name']));

        $role->permissions()->sync($request->permission);

        $role->save();

        return redirect()->route('role.index')->with('message', 'Role update SuccessFully');
    }

    /**
     * @param int $id
     * @return void
     */
    public function show(int $id)
    {
        //
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id): View
    {
        $role = Role::query()->findOrFail($id);

        $permissions = Permission::query()->get();

        return view('admin.role.edit', compact('role', 'permissions'));
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

        $role->permissions()->sync($request->permission);

        $role->save();

        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        Role::where('id', $id)->delete();

        return redirect()->route('role.index');
    }
}
