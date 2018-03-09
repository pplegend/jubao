<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\JubaoPhones;

class AdminPhoneController extends Controller
{
    public function index() {
        /*        $users = DB::table('users')
                    ->select(DB::raw('count(*) as user_count, status'))
                    ->where('status', '<>', 1)
                    ->groupBy('status')
                    ->get();*/
        $phone = DB::table('jubao_phones')->where('status','=',1)->simplePaginate(5);
        return view('admin/phone/index', ['phones' => $phone,'active'=>'noaudit']);
    }

    public function create()
    {
        return view('admin/phone/create');
    }

    public function store(Request $request)
    {
        request()->validate($request, [
            'phone' => 'required',
            'description' => 'required',
        ]);
        $phone = new JubaoPhones();
        $phone->phone = request('phone');
        $phone->description = request('description');
        $phone->save();
        return redirect('/admin/phones');
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'phone' => 'required|max:15',
            'description' => 'required',
        ]);

        JubaoPhones::find($id)->update($request->all());
        return redirect()->route('phones.index')
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
            return redirect()->route('phones.index')
                ->with('success','Phone updated successfully');
        }else{
            return redirect()->route('phones.index')
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
            return redirect()->route('phones.index')
                ->with('success','Phone updated successfully');
        }else{
            return redirect()->route('phones.index')
                ->with('success','Phone updated failed');
        }
    }
}