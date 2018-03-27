<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pztable;
use DB;

class PzController extends Controller
{
    public function index($type){
        if(!$type){
            dd("非法请求1");
        }elseif (!in_array($type,['phone','qq','email','wechat','company','others'])){
            dd("非法请求2");
        }else{
            switch ($type){
                case 'phone':
                    $type =  1;
                    break;
                case 'qq':
                    $type = 2;
                    break;
                case 'email':
                    $type = 5;
                    break;
                case 'wechat':
                    $type = 6;
                    break;
                case 'company':
                    $type = 4;
                    break;
                default:
                    $type = 8;
                    break;
            }
            $records = DB::table('pz_table')
                ->select('id','title','body')
                ->where('status','=',1)
                ->where('type','=',$type)
                ->orderBy('count','desc')
                ->limit(12)
                ->get();
            return view('list', ['results'=>$records,'action'=>'search/shoujis','placeholder'=>'搜索手机号码']);
        }

    }

    public function show($id)
    {
        $pz = Pztable::find($id);
        return view('pzshow', ['pz'=>$pz]);
    }
}
