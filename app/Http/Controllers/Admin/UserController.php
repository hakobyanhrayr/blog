<?php

namespace App\Http\Controllers\Admin;

use App\Models\admin\Admin;
use App\Models\admin\Role;
use App\Models\user\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): View
    {
        $users = Admin::get();

        $roles = Role::get();

        return view('admin.user.show', compact('users', 'roles'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): View
    {
        $roles = Role::get();


        return view('admin.user.create', compact('roles'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
        ]);

        $user = Admin::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
            'password' => Hash::make($request->password)
        ]);

        $user->roles()->sync($request->role);

        //  $user->save();
        //  $user = Admin::create($request->all());
        //  $user->roles()->sync($request->role);

        return redirect()->route('user.index')->with('message', 'Admin Create SuccessFully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id): View
    {
        $user = Admin::query()->findOrFail($id);

        $roles = Role::get();

        return view('admin.user.edit', compact('user', 'roles'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        Admin::query()->findOrFail($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
            'password' => Hash::make($request->password)
        ]);

        Admin::query()->find($id)->roles()->sync($request->role);

        return redirect()->route('user.index');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(int $id): RedirectResponse
    {
        $user = Admin::query()->findOrFail($id);

        $user->delete();

        return redirect()->route('user.index');
    }
}
