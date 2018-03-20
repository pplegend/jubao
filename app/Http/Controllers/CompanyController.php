<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use DB;

class CompanyController extends Controller
{
    public function index(){
        $records = DB::table('pz_gs')
            ->select('id','title','body')
            ->where('status','=',1)
            ->where('body','!=','')
            ->orderBy('count','desc')
            ->limit(5)
            ->get();
        return view('list', ['results'=>$records,'action'=>'search/gs','placeholder'=>'搜索公司名']);
    }

    public function show($id)
    {
        $qq = Email::find($id);
        return view('qqshow', ['qq'=>$qq]);
    }
}
