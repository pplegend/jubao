<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Email;
use DB;

class EmailController extends Controller
{
    public function index(){
        $records = DB::table('pz_email')
            ->select('id','title','body')
            ->where('status','=',1)
            ->where('body','!=','')
            ->orderBy('count','desc')
            ->limit(5)
            ->get();
        return view('list', ['results'=>$records,'action'=>'search/email','placeholder'=>'搜索email']);
    }

    public function show($id)
    {
        $qq = Email::find($id);
        return view('qqshow', ['qq'=>$qq]);
    }
}
