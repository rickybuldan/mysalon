<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index(){

        $javascriptFile = asset('action-js/index/index-action.js');
        return view('welcome')->with('javascriptFile', $javascriptFile);

    }
}
