<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pzphone;
use DB;

class PzphoneController extends Controller
{
    public function index(){
        $records = DB::table('pz_shouji')
            ->select('id','phone as title','body')
            ->where('status','=',1)
            ->where('body','!=','')
            ->orderBy('count','desc')
            ->limit(5)
            ->get();
        return view('list', ['results'=>$records,'action'=>'search/shoujis','placeholder'=>'搜索手机号码']);
    }

    public function show($id)
    {
        $qq = pzphone::find($id);
        return view('qqshow', ['qq'=>$qq]);
    }
}
