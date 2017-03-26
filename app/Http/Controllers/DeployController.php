<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Http\Controllers\Controller;


class HelloCodeController extends Controller
{

   public function HelloCodeInfo(Request $request){
        if(substr($request->header('User-Agent'), 0,15)=='GitHub-Hookshot'){
            $data = array(
                'LOCAL_ROOT'      => '/home/web/HelloCodeInfo',
                'LOCAL_REPO_NAME' => 'HelloCodeInfo',
                'LOCAL_REPO'      => '/home/web/HelloCodeInfo',
                'REMOTE_REPO'     => 'git@github.com:fufukwang/HelloCodeInfo.git',
                'BRANCH'          => 'master'
            );

            $OK = $this->doexec($data);
            return response()->json(array('success'=>$OK));
        }
        else{
            return App::abort(404);
        }
    }




    private function doexec($data){
        if( file_exists($data['LOCAL_REPO']) ) {
            return shell_exec("cd {$data['LOCAL_REPO']} && git pull origin {$data['BRANCH']} && git submodule update");
        } else {
            return shell_exec("cd {$data['LOCAL_ROOT']} && git clone {$data['REMOTE_REPO']}");
        }
    }
}
