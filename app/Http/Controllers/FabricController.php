<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Model\HelloCode\Contact;

class FabricController extends Controller
{
    //

    public function __construct(){


    }

    public function home(Request $request){
    	return view('Fabric.home');
    	
    }
}
