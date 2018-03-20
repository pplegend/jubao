<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\qq;
use DB;

class QqController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $qq = qq::find($id);
        return view('qqshow', ['qq'=>$qq]);
    }

    public function index(){
        $records = DB::table('pz_qq')
            ->select('id','title','body')
            ->where('status','=',1)
            ->where('body','!=','')
            ->orderBy('count','desc')
            ->limit(5)
            ->get();

        return view('list', ['results'=>$records,'action'=>'search/qqs','placeholder'=>'搜索QQ号码']);
    }
}
