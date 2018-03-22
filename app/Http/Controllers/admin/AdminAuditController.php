<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UploadRequest;
use App\Pztable;
use Illuminate\Support\Facades\Storage;

class AdminAuditController extends Controller
{
    public function index() {

        $phone = DB::table('jubao_phones')->where('status','=',0)->simplePaginate(5);
        $pianzis = DB::table('pz_table')->where('status','=',0)->simplePaginate(5);
        return view('admin/phone/index', ['phones' => $phone,'pianzis'=>$pianzis,'active'=>'audit']);
    }

    public function aduit($id){
        if(!$id){
            return false;
        }
        $result = qq::where('id', $id)->update(array('status'=>1));
        if($result){
            return redirect()->route('aduit')
                ->with('success','QQ updated successfully');
        }else{
            return redirect()->route('aduit')
                ->with('success','QQ updated failed');
        }

    }

    /**
     * @param $id
     * @return bool|\Illuminate\Http\RedirectResponse
     * status 0:审核中，1：审核通过,2审核不过
     */
    public function notaduit($id){
        if(!$id){
            return false;
        }
        $result = qq::where('id', $id)->update(array('status'=>2));
        if($result){
            return redirect()->route('aduit')
                ->with('success','QQ updated successfully');
        }else{
            return redirect()->route('aduit')
                ->with('success','QQ updated failed');
        }
    }
}