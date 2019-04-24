<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Silber\Bouncer\Bouncer;

class UserController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::query()->orderBy('id', 'desc')->paginate(20);
        return view('admin.user.user',['users'=>$users]);
    }

    public function create(){
        return view('admin.user.user-create');
    }

    public function store(Request $request, User $user){
        //表单验证，不通过会自动返回提交页面
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users|email|max:255|string',
            'password' => 'required|string|min:6',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        //验证通过，存入数据库
        $user::create($validatedData);

        session()->flash('success','添加用户成功');
        return redirect()->route('admin_user');
    }

    public function role(User $user, Bouncer $bouncer, $id){
        $currentUser = $user::find($id);
        //当前用户拥有的角色
        $currentRoles = $currentUser->getRoles()->toArray();
        //所有角色
        $roles = $bouncer->role()::where('name','<>','DEVELOPER')->get();
        return view('admin.user.user-role',compact('currentRoles','roles', 'id'));
    }

    public function storeRole(User $user, Request $request, $id){
        $newRoles = $request->input('roles');
        $currentUser = $user::find($id);

        $roles = $currentUser->getRoles()->toArray();

        if(!empty($newRoles)){

            //需移除
            $removeRoles = array_diff($roles,$newRoles);
            if($removeRoles){
                $currentUser->retract($removeRoles);
            }

            $currentUser->assign($newRoles);

        }else{
            $currentUser->retract($roles);
        }
        session()->flash('success','分配角色成功');
        return redirect()->route('admin_user');
    }
}
