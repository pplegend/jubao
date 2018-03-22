<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use sngrl\SphinxSearch\SphinxSearch;
use Validator;
use DB;
use App\Pztable;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = DB::table('jubao_phones')
            ->select('id','title','description as body')
            ->where('status','=',1)
            ->orderBy('counter','desc')
            ->simplePaginate(10);

        return view('home', ['results'=>$records,'action'=>'search/jubaophones','placeholder'=>'搜索号码/部门']);
    }

    /**
     * @param Request $request
     * @param $search 搜索类型
     */
    public function search(Request $request,$search){

        $validator = Validator::make($request->all(),[
            'context' => 'required|max:20|min:2',
        ]);
        if($validator->fails()){
            dd('invalidate params');
        }
        $searchRecords = array();
        switch ($search){
            case 'jubaophones':
                $sphinx = new SphinxSearch();
                $sphinx->setMatchMode(2);
                $searchWord = '*'.request('context').'*';
                $results = $sphinx->search($searchWord, 'jubao_phone_index')->query();
                if($results['total']>0){
                    $ids = array_keys($results['matches']);
                    $searchRecords = $this->getRecodeById($ids,'jubao_phones' );

                }
                $action = '/search/jubaophones';
                $placeholder = '搜索号码/部门';
                $view = 'home';
                break;
            case 'qqs':
                $searchRecords = $this->getRecordFromDb('pz_qq','title' , request('context'));
                $action = '/search/qqs';
                $placeholder = '搜索QQ';
                $view = 'searchresult';
                break;
            case 'shoujis':
                $searchRecords = $this->getRecordFromDb('pz_shouji','title' , request('context'));
                $action = '/search/shoujis';
                $placeholder = '搜索手机';
                $view = 'searchresult';
                break;
            case 'email':
                $searchRecords = $this->getRecordFromDb('pz_email','title' , request('context'));
                $action = '/search/email';
                $placeholder = '搜索email';
                $view = 'searchresult';
                break;
            case 'weixin':
                $searchRecords = $this->getRecordFromDb('pz_weixin','title' , request('context'));
                $action = '/search/weixin';
                $placeholder = '搜索微信号';
                $view = 'searchresult';
                break;
            case 'company':
                $searchRecords = $this->getRecordFromDb('pz_gs','title' , request('context'));
                $action = '/search/gs';
                $placeholder = '搜索公司名';
                $view = 'searchresult';
        }
        return view($view, ['results'=>$searchRecords,'action'=>$action,'placeholder'=>$placeholder]);
    }

    public function woyaojubao(Request $request){


        $code = $request->input('CaptchaCode');
        $isHuman = captcha_validate($code);

        if ($isHuman) {
            dd('human');
            // TODO: Captcha validation passed, perform protected  action
        } else {
            // TODO: Captcha validation failed, show error message
            dd('not human');
        }
        
        $validator = Validator::make($request->all(),[
            'jubaobody' => 'required|max:20|min:3',
        ]);
        if($validator->fails()){
            dd('举报详情不得少于三个字');
        }
        switch (request('type')){
            case 'phone':
                break;
            case 'QQ':
                break;
            case 'website':
                break;
            case 'wechat':
                break;
            case 'email':
                break;
            case 'company':
                break;
            default:
                break;

        }
        $phone = new JubaoPhones();
        $phone->phone = request('phone');
        $phone->description = request('description');
        $phone->save();
        return redirect('/admin/phones');
    }
    /**
     * @param $ids array
     */
    public function getRecodeById($ids,$table){

        $records = DB::table($table)
            ->select('id','title','description as body')
            ->whereIn('id',$ids)
            ->where('status','=',1)
            ->orderBy('counter','desc')
            ->get();

        return $records;
    }

    public function getRecordFromDb($table,$field,$value){
        $records = DB::table($table)
            ->select('id','title','body','url')
            ->where($field,'=',$value)
            ->where('status','=',1)
            ->first();

        return $records;
    }
}
