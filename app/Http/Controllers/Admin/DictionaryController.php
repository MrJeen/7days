<?php

namespace App\Http\Controllers\Admin;

use App\Model\Dictionary;
use Illuminate\Http\Request;


class DictionaryController extends Controller
{
    public function index(){
        $data = Dictionary::query()->paginate(20);
        foreach($data as &$item){
            if($item['parentId']){
                $parent = Dictionary::where('id',$item['parentId'])->first();
                $item['parent'] = $parent;
            }
        }
        return view('admin.setting.dictionary',compact('data'));
    }

    public function create(){
        //查询顶级分类
        $allData = Dictionary::all();
        $data = Dictionary::where('parentId',0)->get();
        $zTreeData = array();
        foreach($data as $item){
            $subData = array(
                'id' => $item['id'],
                'name' => $item['name'],
                'open' => true
            );
            $children = $this->checkChildren($allData,$item['id']);
            if($children){
                $subData['children'] = $children;
            }
            $zTreeData[] = $subData;
        }
        $zTreeData = json_encode($zTreeData,JSON_UNESCAPED_UNICODE);
        return view('admin.setting.dictionary-create',compact('zTreeData'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|unique:dictionaries|string|max:255',
            'alias' => 'required|alpha_dash|unique:dictionaries|string|max:255',
            'parentId' => 'nullable|integer',
        ]);
        $validatedData['alias'] = strtoupper($validatedData['alias']);
        //验证通过，存入数据库
        Dictionary::create($validatedData);
        session()->flash('success','添加属性成功');
        return redirect()->route('admin_dictionary_create');
    }

    protected function checkChildren($data,$parentId){
        $result = array();
        foreach($data as $key=>$item){
            if($item['parentId'] == $parentId){
                $subData = array(
                    'id' => $item['id'],
                    'name' => $item['name'],
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