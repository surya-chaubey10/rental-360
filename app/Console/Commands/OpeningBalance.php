<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Organisation;
use App\Models\GeneralLedger;
use Carbon\Carbon;

class OpeningBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'closing:balance';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now();
        $date=date_create($now);
        date_sub($date,date_interval_create_from_date_string("1 days"));
        $yesterday= date_format($date,"Y-m-d");
       
        $gl= Organisation::get();
        foreach($gl as $gl_details){
             
            $general_ledger  = GeneralLedger::select('id', 'debit', 'credit')->where('organisation_id', $gl_details->id)->whereDate('created_at', $yesterday)->get(); 
              $total_credit=0;
              $total_debit=0;
            
              $opening_balance1=OpeningBalance::select('amount','account_type')
              ->whereDate('created_at',$yesterday) 
              ->where('organisation_id',$gl_details->id)->first();
             if($opening_balance1!=''){
                $opening_balance=$opening_balance1->nu_open_amount;
                $accounttype=$opening_balance1->ch_open_type;
              }else{
                  $opening_balance=0;
                  $accounttype='Cr';
              }
  
              foreach($general_ledger as $jv_details){
                  if($jv_details->debit){
                      if($accounttype=='Cr'){
                         $clb = $opening_balance-$jv_details->debit;
                         $accounttype=($clb>0 ? 'Cr':'Dr');
                      }else{
                         $clb = $opening_balance+$jv_details->debit;
                         
                      }
                  }
                  else{
                        if($accounttype=='Cr'){
                          $clb = $opening_balance+$jv_details->credit;
                         
                     }else{
                           $clb = $opening_balance-$jv_details->credit;
                           $accounttype=($clb>0 ? 'Dr':'Cr');
  
                        }
  
                  }
                  
              
                  $opening_balance=abs($clb);
              }
            
                    $data = new OpeningBalance;	
                    $data->organisation_id = $gl_details->id;
                    $data->start_date = $now;
                    $data->created_user = 1;
                    $data->amount = $opening_balance;
                    $data->account_type = $accounttype;
                    $data->save();

                   
           } 
        
      }
}
