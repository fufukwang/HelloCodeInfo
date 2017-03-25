<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Model\HelloCode\Contact;

class HelloCodeController extends Controller
{
    //

    public function __construct(){


    }

    public function ContactUs(Request $request){
    	try{
    		Contact::create([
	    		'name'   => $request->name,
	    		'email'  => $request->email,
	    		'note'   => $request->note,
	    		'status' => 0,
	    	]);
	    	$message = array('payload' => json_encode(array('text' => "有個叫 {$request->name} 的人留言喔")));
			$c = curl_init(env('SLACK_HOOK'));
			curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($c, CURLOPT_POST, true);
			curl_setopt($c, CURLOPT_POSTFIELDS, $message);
			$var = curl_exec($c);
			curl_close($c);
	    	return Response::json(['status'=> 1], 200);
    	} catch(Exception $e) {
    		return Response::json(['status'=> 0], 200);
    	}
    	
    }
}
