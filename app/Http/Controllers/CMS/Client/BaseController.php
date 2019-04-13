<?php

namespace App\Http\Controllers\Cms\Client;

use App\User;
use App\Client;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Middleware\CheckPermission;
use App\Http\Middleware\ClientRole;



class BaseController extends Controller
{
   
    
    public function __construct()
        
    {
       $this->middleware('auth');
       // $this->middleware('ClientRole');
        //$this->middleware('CheckPermission');
       
    }
}