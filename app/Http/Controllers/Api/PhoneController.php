<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\JubaoPhones;
use Validator;

class PhoneController extends Controller
{
    //TODO 1. 添加提交用户ip,2 必须登陆后才能提交

    public function index(){
        $phone = DB::table('jubao_phones')
                    ->select('phone', 'description')
                    ->where('status','=',1)
                    ->orderBy('counter','desc')
                    ->simplePaginate(5);
        return response()->json($phone);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function addPhone(Request $request){

        $validator = Validator::make($request->all(),[
            'time' => 'required|max:15|min:10',
            'phone' => 'required|max:15|min:3',
            'description' => 'required|min:3',
        ]);

        if($validator->fails()){
            $result = array(
                'error'=>10000,
                'httpCode'=>443,
                'message' =>'字段验证错误'
            );
            return response()->json($result);
        }else{
            $user = request('user');
            if(!$user){
                $user = $request->getClientIp();
            }
            //判断请求是否在1分钟内
            $time = request('time');
            if(time() - $time > 3600){
                $result = array(
                    'error'=>10000,
                    'httpCode'=>442,
                    'message' =>'字段验证错误'
                );
                return response()->json($result);
            }
            $phone = new JubaoPhones();
            $phone->phone = request('phone');
            $phone->description = request('description');
            $phone->createUser = $user;
            $result = $phone->save();
            if($result){
                $result = array(
                    'error'=>0,
                    'message'=>'success'
                );
                return response()->json($result);

            }
        }

    }

}