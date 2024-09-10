<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function testajax(){
        return view('ajax.index');
    }
    public function testajax_show(){
        return view('ajax.testajax');
    }


    
}
