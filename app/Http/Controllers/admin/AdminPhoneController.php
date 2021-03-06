<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\JubaoPhones;

class AdminPhoneController extends Controller
{


    public function create()
    {
        return view('admin/phone/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:15|min:3',
            'description' => 'required|min:3',
        ]);
        $phone = new JubaoPhones();
        $phone->title = request('title');
        $phone->description = request('description');
        $phone->save();
        return redirect('admin/audit');
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'title' => 'required|max:15',
            'description' => 'required',
        ]);

        JubaoPhones::find($id)->update($request->all());
        return redirect()->route('aduit')
            ->with('success','Phone updated successfully');
    //    return response($phone)->header('Content-Type','application/json' );
    }

    public function edit(JubaoPhones $phone)
    {
        //
        $phone = JubaoPhones::find($phone->id);

        return view('admin.phone.edit', ['phone'=>$phone]);
    }

    public function aduit($id){
        if(!$id){
            return false;
        }
        $result = JubaoPhones::where('id', $id)->update(array('status'=>1));
        if($result){
            return redirect()->route('aduit')
                ->with('success','Phone updated successfully');
        }else{
            return redirect()->route('aduit')
                ->with('success','Phone updated failed');
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
        $result = JubaoPhones::where('id', $id)->update(array('status'=>2));
        if($result){
            return redirect()->route('notaduit')
                ->with('success','Phone updated successfully');
        }else{
            return redirect()->route('notaduit')
                ->with('success','Phone updated failed');
        }
    }
}