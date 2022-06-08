<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
        $data = User::orderBy('id','DESC')->get();
        $newOrders = Order::where('status', Order::CONFIRMED)->get();
        return view('admin.users.index',compact('data', 'newOrders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::get();
        $newOrders = Order::where('status', Order::CONFIRMED)->get();
        return view('admin.users.formAdd',compact('roles','newOrders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $role = $request->role;

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'requird'
        ]);

        $saved = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password)
        ]);
        if($saved){
            $saved->assignRole($role);
            Alert::success('ok','ok');
            return redirect('admin/users');
        }else{
            Alert::failed('ok', 'ok');
            return redirect('admin/users');
        }
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
        $newOrders = Order::where('status', Order::CONFIRMED)->get();
        $user = User::findOrFail($id);
        $userRole = $user->roles->first();
        $roles = Role::get();
        return view('admin.users.formEdit',compact('user','userRole','roles', 'newOrders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::find($id);
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $role = $request->role;

        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users,email',
        //     'password' => 'required|same:confirm-password',
        //     'roles' => 'requird'
        // ]);

        $saved = $user->update([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password)
        ]);
        if ($saved) {
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $user->assignRole($role);
            Alert::success('Success', 'Update Data! ');
            return redirect('admin/users');
        } else {
            Alert::failed('ok', 'ok');
            return redirect('admin/users');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Alert::success('Success','Delete User!');
        return redirect('admin/users');
    }
}
