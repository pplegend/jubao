<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\qq;
class QqController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $qq = qq::find($id);
        return view('qqshow', ['qq'=>$qq]);
    }
}
