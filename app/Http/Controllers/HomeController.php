<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use sngrl\SphinxSearch\SphinxSearch;

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
        $sphinx = new SphinxSearch();
        $sphinx->setMatchMode(2);
        $results = $sphinx->search('*味词*', 'jubao_phone_index')->query();
//        dd($sphinx->getErrorMessage());
        return view('home', ['results'=>$results]);
    }
}
