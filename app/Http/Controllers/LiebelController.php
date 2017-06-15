<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Model\HelloCode\Contact;

class LiebelController extends Controller
{
    //

    public function __construct(){


    }

    public function grXml(Request $request){
    	return "<?xml version='1.0' encoding='UTF-8'?>";
    	
    }
}
