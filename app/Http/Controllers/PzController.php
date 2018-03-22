<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pztable;
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

        return view('admin.qq.edit', ['pz'=>$pz]);
    }
}
