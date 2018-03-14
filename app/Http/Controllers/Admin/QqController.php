<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UploadRequest;
use App\qq;
use Illuminate\Support\Facades\Storage;

class QqController extends Controller
{
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
    
    public function update(UploadRequest $request,$id){
        $this->validate($request, [
            'body' => 'required',
            'qq' => 'required',
        ]);
        $url = array();
        if($request->hasFile('file')){
            foreach ($request->file('file') as $file){
                //文件是否上传成功
                if($file->isValid()){	//判断文件是否上传成功
                    $originalName = $file->getClientOriginalName(); //源文件名

                    $ext = $file->getClientOriginalExtension();    //文件拓展名

                    $type = $file->getClientMimeType(); //文件类型

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
        $qq = qq::find($id);
        $qq->qq = request('qq');
        $qq->body = request('body');
        $qq->url = $url;
        $qq->save();
        return redirect()->route('phones.index')
            ->with('success','QQ updated successfully');
    }

    public function edit(qq $qq)
    {
        //
        $qq = qq::find($qq->id);

        return view('admin.qq.edit', ['qq'=>$qq]);
    }

    public function create(){
        return view('admin/qq/create');
    }

    public function store(UploadRequest $request){

        $this->validate($request, [
            'qq' => 'required',
            'body' => 'required',
        ]);

        $url = array();
        if($request->hasFile('file')){
            foreach ($request->file('file') as $file){
                //文件是否上传成功
                if($file->isValid()){	//判断文件是否上传成功
                    $originalName = $file->getClientOriginalName(); //源文件名

                    $ext = $file->getClientOriginalExtension();    //文件拓展名

                    $type = $file->getClientMimeType(); //文件类型

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

        $qq = new qq();
        $qq->qq = request('qq');
        $qq->body = request('body');
        $qq->url = $url;
        $qq->author = 'admin';
        $qq->save();
        return redirect('/admin/phones');


    }
}