<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use sngrl\SphinxSearch\SphinxSearch;
use Validator;
use DB;
use App\Pztable;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UploadRequest;

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

    public function woyaojubao(UploadRequest $request){
        $ip = \Request::ip();

        //判断用户是否登陆
        if($user = Auth::user())
        {
            $user_id = $user->id;
        }else{
            $user_id = -1;
        }

        $code = $request->input('CaptchaCode');
        if($user_id == 1){
            $isHuman = true;
        }else{
            $isHuman = captcha_validate($code);
        }
        $validator = Validator::make($request->all(),[
            'jubaobody' => 'required|max:20|min:3',
        ]);
        if($validator->fails()){
            dd('举报详情不得少于三个字');
        }

        if ($isHuman) {
            $url = array();
            if($request->hasFile('file')){
                foreach ($request->file('file') as $file){
                    //文件是否上传成功
                    if($file->isValid()){	//判断文件是否上传成功
                      //  $originalName = $file->getClientOriginalName(); //源文件名

                        $ext = $file->getClientOriginalExtension();    //文件拓展名

                      //  $type = $file->getClientMimeType(); //文件类型

                        $realPath = $file->getRealPath();   //临时文件的绝对路径

                        $fileName = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;  //新文件名

                        $bool = Storage::disk('public')->put($fileName,file_get_contents($realPath));   //传成功返回bool值
                        if($bool){
                            $url[] = $fileName;
                        }
                    }
                }

            }
            $url = json_encode($url);

            switch (request('type')){
                case 'phone':
                    $type = 1;
                    break;
                case 'QQ':
                    $type = 2;
                    break;
                case 'website':
                    $type = 3;
                    break;
                case 'wechat':
                    $type = 6;
                    break;
                case 'email':
                    $type = 5;
                    break;
                case 'company':
                    $type = 4;
                    break;
                default:
                    $type = 8;
                    break;

            }
            $phone = new Pztable();
            $phone->body = request('jubaobody');
            $phone->title = request('title');
            $phone->author = $user_id;
            $phone->type = $type;
            $phone->visitor = $ip;
            $phone->url = $url;
            $phone->save();
            return redirect()->route('woyaojubao')
                ->with('success','举报成功，我们将尽快审核，审核成功后会在网站显示');
        } else {
            // TODO: Captcha validation failed, show error message
            return redirect()->route('woyaojubao')
                ->with('fail','验证码错误');
        }
        


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
