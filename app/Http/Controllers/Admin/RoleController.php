<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Silber\Bouncer\Bouncer;

class RoleController extends Controller
{
    public function index(Bouncer $bouncer){
        $data = $bouncer->role()::query()->where('name', '<>', 'DEVELOPER')->paginate(20);
        return view('admin.setting.role',compact('data'));
    }

    public function create(){
        return view('admin.setting.role-create');
    }

    public function store(Request $request,Bouncer $bouncer){
        $validatedData = $request->validate([
            'name' => 'required|unique:roles|string|max:255',
            'title' => 'required|alpha_dash|unique:roles|string|max:255',
        ]);
        $validatedData['title'] = strtoupper($validatedData['title']);
        $bouncer->role()->firstOrCreate($validatedData);
        session()->flash('success','添加角色成功');
        return redirect()->route('admin_role_create');
    }

    public function ability(Bouncer $bouncer, $id){
        //查询顶级分类
        $allData = $bouncer->ability()::where('title','<>','All abilities')->get();
        $data = $bouncer->ability()::where([
            ['parentId',0],
            ['title','<>','All abilities'],
        ])->get();
        $role = $bouncer->role()::find($id);
        $abilities = $role->getAbilities()->toArray();
        $abilityIds = array_map(function($value){
            return $value['id'];
        },$abilities);
        $zTreeData = array();
        foreach($data as $item){
            $subData = array(
                'id' => $item['id'],
                'name' => $item['title'],
                'open' => true
            );
            if(in_array($item['id'],$abilityIds)){
                $subData['checked'] = true;
            }
            $children = $this->checkChildren($allData,$item['id'],$abilityIds);
            if($children){
                $subData['children'] = $children;
            }
            $zTreeData[] = $subData;
        }
        $zTreeData = json_encode($zTreeData,JSON_UNESCAPED_UNICODE);
        return view('admin.setting.role-abilities',['abilities'=>$zTreeData,'roleId'=>$id]);
    }

    public function storeAbility(Bouncer $bouncer, Request $request, $id){
        $data = $request->input();
        //查询角色
        $role = $bouncer->role()::find($id);
        if(empty($role)){
            throw new \Exception('该角色不存在 #'.$id);
        }
        //移除所有权限
        $abilities = $role->getAbilities();
        $role->disallow($abilities);
        if(!empty($data['abilities'])){
            //添加权限
            $role->allow($data['abilities']);
        }
        session()->flash('success','权限分配成功');
        return 'true';
    }

    protected function checkChildren($data,$parentId,$abilityIds){
        $result = array();
        foreach($data as $key=>$item){
            if($item['parentId'] == $parentId){
                $subData = array(
                    'id' => $item['id'],
                    'name' => $item['title'],
                );
                if(in_array($item['id'],$abilityIds)){
                    $subData['checked'] = true;
                }
                unset($data[$key]);
                $children = $this->checkChildren($data,$item['id'],$abilityIds);
                if($children){
                    $subData['children'] = $children;
                }
                $result[] = $subData;
            }
        }
        return $result;
    }
}