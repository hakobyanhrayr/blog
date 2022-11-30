<?php

namespace App\Http\Controllers\Admin;

use App\Models\admin\Admin;
use App\Models\admin\Role;
use App\Models\user\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
    public function index()
    {
        $users = Admin::all();
        return view('admin.user.show', compact('users'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $roles = Role::all();


        return view('admin.user.create', compact('roles'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {

          Admin::query()->create(([
              'name'=>$request->name,
              'email'=>$request->email,
              'status'=>$request->status,
              'password'=>Hash::make($request->password),
              'password_confirmation'=>Hash::make($request->password_confirmation)
          ]));

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $user = Admin::query()->findOrFail($id);

        $roles = Role::all();

        return view('admin.user.edit', compact('user', 'roles'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        dd(777777);

        $user = User::query()->findOrFail($id);

        $user->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
