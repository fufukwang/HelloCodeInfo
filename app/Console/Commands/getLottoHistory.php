<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Model\Lotto\LPower;
use App\Model\Lotto\LBig;
use App\Model\Lotto\LSix;
use App\Model\Lotto\L539;

class getLottoHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getHistory:lotto {type=schedule}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get history';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        switch ($this->argument('type')) {

            case 539: $this->getHistory539(); break;
            case 6: $this->getHistory6(); break;
            case 649: $this->getHistory649(); break;
            case 648: $this->getHistory648(); break;
            default: $this->getNowStatus(); break;
        }
    }

    // 539
    public function getHistory539($page = 1){
        $client = new Client();
        $response = $client->get('http://tw-lotto.com/api/lotto/lotto539?page='.$page);
        if($response->getStatusCode() == 200 ){
            $body = json_decode($response->getBody(),true);
            $data = [];
            foreach($body['data'] as $row){
                $tmp = [
                    'day'    => $row['date'],
                    'tr_day' => $row['date_id'],
                    'num1'   => $row['num1'],
                    'num2'   => $row['num2'],
                    'num3'   => $row['num3'],
                    'num4'   => $row['num4'],
                    'num5'   => $row['num5'],
                ];
                array_push($data,$tmp);
            }
            L539::insert($data);
            if($body['last_page'] > $page){
                $page++;
                $this->getHistory539($page);
            }
        }
    }
    // 六合彩
    public function getHistory6($page = 1){
        $client = new Client();
        $response = $client->get('http://tw-lotto.com/api/lotto/lotto6?page='.$page);
        if($response->getStatusCode() == 200 ){
            $body = json_decode($response->getBody(),true);
            $data = [];
            foreach($body['data'] as $row){
                $tmp = [
                    'day'    => $row['date'],
                    'tr_day' => $row['date_id'],
                    'num1'   => $row['num1'],
                    'num2'   => $row['num2'],
                    'num3'   => $row['num3'],
                    'num4'   => $row['num4'],
                    'num5'   => $row['num5'],
                    'num6'   => $row['num6'],
                    'num_sp' => $row['numspec'],
                ];
                array_push($data,$tmp);
            }
            LSix::insert($data);
            if($body['last_page'] > $page){
                $page++;
                $this->getHistory6($page);
            }
        }
    }
    // 大樂透
    public function getHistory649($page = 1){
        $client = new Client();
        $response = $client->get('http://tw-lotto.com/api/lotto/lotto649?page='.$page);
        if($response->getStatusCode() == 200 ){
            $body = json_decode($response->getBody(),true);
            $data = [];
            foreach($body['data'] as $row){
                $tmp = [
                    'day'    => $row['date'],
                    'tr_day' => $row['date_id'],
                    'num1'   => $row['num1'],
                    'num2'   => $row['num2'],
                    'num3'   => $row['num3'],
                    'num4'   => $row['num4'],
                    'num5'   => $row['num5'],
                    'num6'   => $row['num6'],
                    'num_sp' => $row['numspec'],
                ];
                array_push($data,$tmp);
            }
            LBig::insert($data);
            if($body['last_page'] > $page){
                $page++;
                $this->getHistory649($page);
            }
        }
    }
    // 威力彩
    public function getHistory648($page = 1){
        $client = new Client();
        $response = $client->get('http://tw-lotto.com/api/lotto/lotto638?page='.$page);
        if($response->getStatusCode() == 200 ){
            $body = json_decode($response->getBody(),true);
            $data = [];
            foreach($body['data'] as $row){
                $tmp = [
                    'day'    => $row['date'],
                    'tr_day' => $row['date_id'],
                    'num1'   => $row['num1'],
                    'num2'   => $row['num2'],
                    'num3'   => $row['num3'],
                    'num4'   => $row['num4'],
                    'num5'   => $row['num5'],
                    'num6'   => $row['num6'],
                    'num_sp' => $row['numspec'],
                ];
                array_push($data,$tmp);
            }
            LPower::insert($data);
            if($body['last_page'] > $page){
                $page++;
                $this->getHistory648($page);
            }
        }
    }










    public function getNowStatus(){
        $client = new Client();
        $r539 = $client->get('http://tw-lotto.com/api/lotto/lotto539');
        if($r539->getStatusCode() == 200 ){
            $body = json_decode($r539->getBody(),true);
            $data = [];
            if(L539::where('day',$body['data'][0]['date'])->where('tr_day',$body['data'][0]['date_id'])->count('id')==0){
                $row = $body['data'][0];
                L539::insert([
                    'day'    => $row['date'],
                    'tr_day' => $row['date_id'],
                    'num1'   => $row['num1'],
                    'num2'   => $row['num2'],
                    'num3'   => $row['num3'],
                    'num4'   => $row['num4'],
                    'num5'   => $row['num5'],
                ]);
            }
        }

        $r6 = $client->get('http://tw-lotto.com/api/lotto/lotto6');
        if($r6->getStatusCode() == 200 ){
            $body = json_decode($r6->getBody(),true);
            $data = [];
            if(LSix::where('day',$body['data'][0]['date'])->where('tr_day',$body['data'][0]['date_id'])->count('id')==0){
                $row = $body['data'][0];
                LSix::insert([
                    'day'    => $row['date'],
                    'tr_day' => $row['date_id'],
                    'num1'   => $row['num1'],
                    'num2'   => $row['num2'],
                    'num3'   => $row['num3'],
                    'num4'   => $row['num4'],
                    'num5'   => $row['num5'],
                    'num6'   => $row['num6'],
                    'num_sp' => $row['numspec'],
                ]);
            }
        }

        $r649 = $client->get('http://tw-lotto.com/api/lotto/lotto649');
        if($r649->getStatusCode() == 200 ){
            $body = json_decode($r649->getBody(),true);
            $data = [];
            if(LBig::where('day',$body['data'][0]['date'])->where('tr_day',$body['data'][0]['date_id'])->count('id')==0){
                $row = $body['data'][0];
                LBig::insert([
                    'day'    => $row['date'],
                    'tr_day' => $row['date_id'],
                    'num1'   => $row['num1'],
                    'num2'   => $row['num2'],
                    'num3'   => $row['num3'],
                    'num4'   => $row['num4'],
                    'num5'   => $row['num5'],
                    'num6'   => $row['num6'],
                    'num_sp' => $row['numspec'],
                ]);
            }
        }

        $r638 = $client->get('http://tw-lotto.com/api/lotto/lotto638');
        if($r638->getStatusCode() == 200 ){
            $body = json_decode($r638->getBody(),true);
            $data = [];
            if(LPower::where('day',$body['data'][0]['date'])->where('tr_day',$body['data'][0]['date_id'])->count('id')==0){
                $row = $body['data'][0];
                LPower::insert([
                    'day'    => $row['date'],
                    'tr_day' => $row['date_id'],
                    'num1'   => $row['num1'],
                    'num2'   => $row['num2'],
                    'num3'   => $row['num3'],
                    'num4'   => $row['num4'],
                    'num5'   => $row['num5'],
                    'num6'   => $row['num6'],
                    'num_sp' => $row['numspec'],
                ]);
            }
        }







    }


}

/*
http://tw-lotto.com/api/lotto/lotto539?page=1&gameType=lotto539&sort=
http://tw-lotto.com/api/lotto/lotto6?page=1&gameType=lotto6&sort=
http://tw-lotto.com/api/lotto/lotto649?page=1&gameType=lotto649&sort=
http://tw-lotto.com/api/lotto/lotto638?page=1&gameType=lotto638&sort=

*/