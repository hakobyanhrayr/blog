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
        $users = Admin::get();


        return view('admin.user.show', compact('users'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $roles = Role::get();


        return view('admin.user.create', compact('roles'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
//        dd($request->toArray());
//        $this->validate($request, [
//            'name' => 'required',
//            'email' => 'required',
//            'status' => 'required',
//            'password' => 'required',
//            'password_confirmation' => 'required'
//        ]);

//        $user = Admin::query()->create(([
//            'name' => $request->name,
//            'email' => $request->email,
//            'status' => $request->status,
//            'password' => Hash::make($request->password),
//            'password_confirmation' => Hash::make($request->password_confirmation)
//        ]));
////        dd($request->role);
//        $user->roles()->sync($request->role);

        $user = Admin::create($request->all());

        $user->roles()->sync($request->role);

        return redirect()->route('user.index')->with('message', 'Admin Create SuccessFully');
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
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'status' => 'required',
            'password' => 'required',
        ]);

        Admin::query()->findOrFail($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
            'password' => Hash::make($request->password),
            'password_confirmation' => Hash::make($request->password_confirmation)
        ]);
        // Admin::where('id',$id)->update($request->except('_token','method'));

        Admin::query()->find($id)->roles()->sync($request->role);

        return redirect()->route('user.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy($id)
    {
        $user = Admin::query()->findOrFail($id);

        $user->delete();

        return redirect()->route('user.index');
    }
}
