<?php

namespace App\Console\Commands;

use App\Models\Clinet;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
      $clients =Clinet::get();
      foreach($clients as $userr)

        if(Carbon::now() > $userr->expire_date ){
            $userr->is_trial =0;
            if($userr->type_of_subscribe == 'TRIAL'){
                $userr->type_of_subscribe ='FREE';     
            }elseif($userr->type_of_subscribe == 'PREMIUM'){
                $userr->type_of_subscribe ='Expir_premium'; 
            }
            $userr->credit = null;
            $userr->remain = null;
            $userr->is_unlimited = 0;
            $userr->save();
        }
    }
    }
    

