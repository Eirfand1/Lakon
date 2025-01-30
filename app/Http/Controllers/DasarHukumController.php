<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DasarHukumController extends Controller
{
    //

    public function index(){
        return view("pages.admin.dasar-hukum.dasar-hukum");
    }
}
