<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Pztable;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\UploadRequest;
use Illuminate\Support\Facades\Storage;

class PzController extends Controller
{
    public function show($id){
        $pz = Pztable::find($id);
        return view('pzshow', ['pz'=>$pz]);
    }

    public function edit(Pztable $pz)
    {
        //
        $pz = Pztable::find($pz->id);

        return view('admin.edit', ['pz'=>$pz]);
    }

    /**
     * @param $id
     * @return bool|\Illuminate\Http\RedirectResponse
     * status 0:审核中，1：审核通过,2审核不过
     */
    public function notaudit($id){
        if(!$id){
            return false;
        }
        $result = Pztable::where('id', $id)->update(array('status'=>2));
        if($result){
            return redirect()->route('notaudit')
                ->with('success','updated successfully');
        }else{
            return redirect()->route('audit')
                ->with('fail','updated failed');
        }
    }
    
    public function audit($id){
        if(!$id){
            return false;
        }
        $result = Pztable::where('id', $id)->update(array('status'=>1));
        if($result){
            return redirect()->route('audit')
                ->with('success','updated successfully');
        }else{
            return redirect()->route('audit')
                ->with('fail','updated failed');
        }

    }

    public function update(UploadRequest $request,$id){

        $this->validate($request, [
            'body' => 'required',
            'title' => 'required',
        ]);
        $qq = Pztable::find($id);
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
            $url = json_encode($url);
            $qq->url = $url;
        }


        $qq->title = request('title');
        $qq->body = request('body');
        $qq->save();
        return redirect()->route('audit')
            ->with('success','updated successfully');
    }

}
