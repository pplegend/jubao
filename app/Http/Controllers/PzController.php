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
                    $placeholder = '搜索手机号码';
                    $active ='phone';
                    break;
                case 'qq':
                    $type = 2;
                    $placeholder = '搜索QQ号';
                    $active ='qq';
                    break;
                case 'email':
                    $type = 5;
                    $placeholder = '搜索邮箱地址';
                    $active ='email';
                    break;
                case 'wechat':
                    $type = 6;
                    $placeholder = "搜索微信";
                    $active ='wechat';
                    break;
                case 'company':
                    $type = 4;
                    $placeholder = '搜索公司名';
                    $active ='company';
                    break;
                default:
                    $type = 8;
                    $placeholder = '输入关键字';
                    $active ='others';
                    break;
            }
            $records = DB::table('pz_table')
                ->select('id','title','body')
                ->where('status','=',1)
                ->where('type','=',$type)
                ->orderBy('count','desc')
                ->limit(12)
                ->get();
            return view('list', ['active'=>$active,'results'=>$records,'action'=>'/search/shoujis','placeholder'=>$placeholder,'type'=>$type]);
        }

    }

    public function show($id)
    {
        $pz = Pztable::find($id);
        return view('pzshow', ['pz'=>$pz]);
    }
}
