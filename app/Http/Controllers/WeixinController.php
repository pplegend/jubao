<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Weixin;
use DB;

class WeixinController extends Controller
{
    public function index(){
        $records = DB::table('pz_weixin')
            ->select('id','title','body')
            ->where('status','=',1)
            ->where('body','!=','')
            ->orderBy('count','desc')
            ->limit(5)
            ->get();
        return view('list', ['results'=>$records,'action'=>'search/weixin','placeholder'=>'搜索微信']);
    }

    public function show($id)
    {
        $qq = Weixin::find($id);
        return view('qqshow', ['qq'=>$qq]);
    }
}
