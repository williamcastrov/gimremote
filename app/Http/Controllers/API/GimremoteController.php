<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GimremoteController extends Controller
{
    //
    public function index(){
        return view("bc-gimremote");
    }
}
