<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuditController extends Controller
{
    public function index() {

        $phone = DB::table('jubao_phones')->where('status','=',0)->simplePaginate(5);
        $qq = DB::table('pz_qq')->where('status','=',0)->simplePaginate(5);
        return view('admin/phone/index', ['phones' => $phone,'qqs'=>$qq,'active'=>'audit']);
    }

}