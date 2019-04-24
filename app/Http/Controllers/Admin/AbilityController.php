<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Silber\Bouncer\Bouncer;

class AbilityController extends Controller
{
    public function index(Bouncer $bouncer){
        $data = $bouncer->ability()::query()->where('title','<>','All abilities')->paginate(20);
        foreach($data as &$item){
            if($item['parentId']){
                $parent = $bouncer->ability()::find($item['parentId']);
                $item['parent'] = $parent;
            }
        }
        return view('admin.setting.ability',compact('data'));
    }

    public function create(Bouncer $bouncer){
        //查询顶级分类
        $allData = $bouncer->ability()::where('title','<>','All abilities')->get();
        $data = $bouncer->ability()::where([
            ['parentId',0],
            ['title','<>','All abilities'],
        ])->get();
        $zTreeData = array();
        foreach($data as $item){
            $subData = array(
                'id' => $item['id'],
                'name' => $item['title'],
                'open' => true
            );
            $children = $this->checkChildren($allData,$item['id']);
            if($children){
                $subData['children'] = $children;
            }
            $zTreeData[] = $subData;
        }
        $zTreeData = json_encode($zTreeData,JSON_UNESCAPED_UNICODE);

        return view('admin.setting.ability-create',compact('zTreeData'));
    }

    public function store(Request $request,Bouncer $bouncer){
        $validatedData = $request->validate([
            'name' => 'required|alpha_dash|unique:abilities|string|max:255',
            'title' => 'required|unique:abilities|string|max:255',
            'parentId' => 'nullable|integer',
        ]);
        $validatedData['name'] = strtolower($validatedData['name']);
        $bouncer->ability()->firstOrCreate($validatedData);
        session()->flash('success','添加权限成功');
        return redirect()->route('admin_ability_create');
    }

    protected function checkChildren($data,$parentId){
        $result = array();
        foreach($data as $key=>$item){
            if($item['parentId'] == $parentId){
                $subData = array(
                    'id' => $item['id'],
                    'name' => $item['title'],
                );
                unset($data[$key]);
                $children = $this->checkChildren($data,$item['id']);
                if($children){
                    $subData['children'] = $children;
                }
                $result[] = $subData;
            }
        }
        return $result;
    }
}