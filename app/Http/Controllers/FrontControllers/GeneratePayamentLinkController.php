<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\BookingInvoice;
use App\Models\AcountsPayment;
use App\Models\GeneralLedger;
use App\Models\ManageBookings;
use App\Models\Organisation;
use App\Models\ReserveFleet;
use App\Models\Fleet; 
use App\Models\AmountTransaction;
use App\Models\Notifications;
use App\Models\CompanyActivity;

use Ixudra\Curl\Facades\Curl;

class GeneratePayamentLinkController extends Controller
{
	public function return_callback($string, Request $request)
	{
		// $bi_id = $string;
		$bi_id = base64_decode($string);
	
		$bi = BookingInvoice::find($bi_id);
 
		$created_user = getUser();
		if (!$bi) {
			return view('errors.404');
		}

		$at = AmountTransaction::where('invoice_id', $bi->id)
			->first();

	  $server_key="S6JN9LRWWG-JB2ZZHJDK6-JB2DLTZHTL";

      if($bi->organisation_id){

			$org_details=org_branded_logo($bi->organisation_id);
            $paytabs_info=$org_details->moreInfo;

             if($paytabs_info->profile_id && $paytabs_info->server_key){

					$data = array(
						'profile_id' => $paytabs_info->profile_id ,
						"tran_ref" => $at->transaction_ref
					);

				$server_key=$paytabs_info->server_key;		
					
			 }else{

                   $data = array(
							'profile_id' => "58348",
							"tran_ref" => $at->transaction_ref
						); 
                }
				

	  }else{

			 $data = array(
				'profile_id' => "58348",
				"tran_ref" => $at->transaction_ref
			); 
	  }
	  

		$response = Curl::to('https://secure.paytabs.com/payment/query')
			->withData($data)
			->withHeader('Authorization:'.$server_key.'')
			->asJson()
			->post();
     
		$mb = ManageBookings::where('id', $bi->booking_id)->first();
        
		if (is_object($response->customer_details)) {
			//TODO: Checking if the payment is successfull or not
			if (is_object($response->payment_result)) {
				$payment_status = $response->payment_result->response_status;
				if ($payment_status == 'A' || $payment_status == 'H') {
					
					$payment_info = $response->payment_info;
					$bi->short_link = NULL;
					$bi->is_adjust_invoice ='1';
					$bi->trans_ref =$response->tran_ref;
					$bi->save();
					
					if ($mb) {
						$mb->payment_status = $payment_status;
						$mb->save();
					}
                   
					//* Code By Akash */
					general_ledger($at->amount,$bi->id,$bi->booking_id,'invoice_payment',$payment_info);
					
					if ($mb->id && ($mb->dispatch_type=='1')) {
						Fleet::where('id', $mb->vehicle_id)
						    ->update([
						        'is_reserved' => '1',
						    ]);
							if ($bi->document_type=='account') { 
								if($bi->extend_date != null){

									$Booking =  ManageBookings::find($bi->booking_id); 
									$reversed = ReserveFleet::where('booking_id',$bi->booking_id)->first(); 
									$reversed->to_date                      = $Booking->extend_date;
									$reversed->save();
								}
								
							}else{
								$reversed = new ReserveFleet;
								$reversed->from_date                    = $mb->pickup_date_time;
								$reversed->to_date                      = $mb->dropoff_date_time;
						  
								$reversed->fleet_id                     = $mb->vehicle_id;
								$reversed->brand_id                     = $mb->brand_id;
								$reversed->model_id                     = $mb->model_id;
								$reversed->car_SKU                      = $mb->merchant_sku;
							 
								$reversed->booking_id                   = $mb->id;
								$reversed->created_user                 = $created_user->id;
								$reversed->save();
						}
					}
					//*End  Code By Akash */

					$notifications = new Notifications;
					$notifications->messages          = $bi->name."'s payment has been successful"; 
					$notifications->read              = '0';
					$notifications->unread            = '1';
					$notifications->user_id           = getUser()->id;
					$notifications->organisation_id   = getUser()->organisation_id;
					$notifications->save();

					$adminactivity = new CompanyActivity;
					$adminactivity->messages          = $bi->name."'s payment has been successful";
					$adminactivity->created_user      = getUser()->id;
					$adminactivity->organisation_id   = getUser()->organisation_id;
					$adminactivity->save();

					$this->saveTransation($response, $bi->id, ($mb) ? $mb : null);
					
					return view('payments.success');
				} else {

					$notifications = new Notifications;
					$notifications->messages          = $bi->name."'s payment has been declined"; 
					$notifications->read              = '0';
					$notifications->unread            = '1';
					$notifications->user_id           = getUser()->id;
					$notifications->organisation_id   = getUser()->organisation_id;
					$notifications->save();

					$adminactivity = new CompanyActivity;
					$adminactivity->messages          = $bi->name."'s payment has been declined";
					$adminactivity->created_user      = getUser()->id;
					$adminactivity->organisation_id   = getUser()->organisation_id;
					$adminactivity->save();

					//TODO: Showing error message if payment not successfully done
					$message = ($response->payment_result) ? 'Payment not successful due to : ' . $response->payment_result->response_message : "Payment not successful due to : Declined";
					if ($mb) {
						$mb->payment_status = $payment_status;
						$mb->save();
					}
					// pre($response);
					$this->saveTransation($response, $bi->id, ($mb) ? $mb : null);
					return view('errors.414', compact('message'));
				}
			}
		} else {
			//TODO: Showing error message if payment parameters not found
			return view('errors.404');
		}
	}

	public function return_short_callback($string, Request $request)
	{
		// $bi_id = $string;
		$bi_id = base64_decode($string);
		$bi = AcountsPayment::find($bi_id);
		$created_user = getUser();
		if (!$bi) {
			return view('errors.404');
		}

		$at = AmountTransaction::where('acounts_payment_id', $bi->id)
			->first();

			$server_key="S6JN9LRWWG-JB2ZZHJDK6-JB2DLTZHTL";

			if($bi->organisation_id){
	  
				  $org_details=org_branded_logo($bi->organisation_id);
				  $paytabs_info=$org_details->moreInfo;
	  
				   if($paytabs_info->profile_id && $paytabs_info->server_key){
	  
						  $data = array(
							  'profile_id' => $paytabs_info->profile_id ,
							  "tran_ref" => $at->transaction_ref
						  );
	  
					  $server_key=$paytabs_info->server_key;		
						  
				   }else{
	  
						 $data = array(
								  'profile_id' => "58348",
								  "tran_ref" => $at->transaction_ref
							  ); 
					  }
					  
	  
			}else{
	  
				   $data = array(
					  'profile_id' => "58348",
					  "tran_ref" => $at->transaction_ref
				  ); 
			}
			
		$response = Curl::to('https://secure.paytabs.com/payment/query')
			->withData($data)
			->withHeader('Authorization:'.$server_key.'')
			->asJson()
			->post();

		if (is_object($response->customer_details)) {
			//TODO: Checking if the payment is successfull or not
			if (is_object($response->payment_result)) {
				$payment_status = $response->payment_result->response_status;
				if ($payment_status == 'A' || $payment_status == 'H') {
					$payment_info = $response->payment_info;
					$bi->short_link = NULL;
					$bi->payment_status = $payment_status;
					$bi->save();

					//* Code By Akash */
					$mb = ManageBookings::where('id', $bi->booking_id)->first();
					
					if ($mb) {
						$mb->payment_status = $payment_status;
					    $mb->save();
					}


					general_ledger($at->amount,$bi->id,($bi) ? $bi : null,'short_payment',$payment_info);
					if (isset($mb)) {
					$reversed = new ReserveFleet;
								$reversed->from_date                    = $mb->pickup_date_time;
								$reversed->to_date                      = $mb->dropoff_date_time;
							if ($mb->dispatch_type == '2') {
								$reversed->fleet_id                     = $mb->vehicle_id;
								$reversed->brand_id                     = $mb->brand_id;
								$reversed->model_id                     = $mb->model_id;
								$reversed->car_SKU                      = $mb->merchant_sku;
							} else {  
								$reversed->fleet_id                     = $mb->vehicle_id;
								$reversed->brand_id                     = $mb->brand_id;
								$reversed->model_id                     = $mb->model_id;
								$reversed->car_SKU                      = $mb->merchant_sku;
							}
								$reversed->booking_id                   = $mb->id;
								$reversed->created_user                 = $created_user->id;
								$reversed->save();
						}
					//*End  Code By Akash */
					$this->saveTransation($response, $bi->id, ($bi) ? $bi : null, "Short Payment");
					return view('payments.success');
				} else {
					//TODO: Showing error message if payment not successfully done
					$message = ($response->payment_result) ? 'Payment not successful due to : ' . $response->payment_result->response_message : "Payment not successful due to : Declined";
					if ($bi) {
						$bi->payment_status = $payment_status;
						$bi->save();
					}
					// pre($response);
					$this->saveTransation($response, $bi->id, ($bi) ? $bi : null);
					return view('errors.414', compact('message'));
				}
			}
		} else {
			//TODO: Showing error message if payment parameters not found
			return view('errors.404');
		}
	}

	public function saveTransation($response, $invoice_id, $booking, $type = "Invoice")
	{
		$trans = new Transaction;
		if ($type == "Invoice") {
			$trans->booking_id			= ($booking) ? $booking->id : 0;
			$trans->invoice_id 			= $invoice_id;
			$trans->user_id				= ($booking) ? $booking->customer_id : 0;
		} else {
			$trans->acounts_payment_id 			= $booking->id;
			$trans->booking_id			= ($booking->booking_id) ? $booking->booking_id : null;
			$trans->user_id				= auth()->guard('web')->user()->id;
		}	
		$trans->tran_ref			= $response->tran_ref;
		$trans->tran_type			= $response->tran_type;
		$trans->cart_id				= $response->cart_id;
		$trans->cart_amount			= $response->cart_amount;
		$trans->cart_currency		= $response->cart_currency;
		$trans->payment_status		= ($response->payment_result) ? $response->payment_result->response_status : "D";
		$trans->payment_code		= ($response->payment_result) ? $response->payment_result->response_message : NULL;
		$trans->transaction_time 	= now();
		$trans->payment_method  	= ($response->payment_info) ? $response->payment_info->payment_method : NULL;
		$trans->card_type			= ($response->payment_info) ? $response->payment_info->card_type : NULL;
		$trans->payment_description = ($response->payment_info) ? $response->payment_info->payment_description : NULL;
		$trans->token				=  $response->token ?? NULL;
		$trans->response_message 	= ($response->payment_result) ? $response->payment_result->response_message : NULL;
		$trans->response_code 		= ($response->payment_result) ? $response->payment_result->response_code : NULL;
		$trans->refund_resp 		= NULL;
		$trans->organisation_id     = getUser()->organisation_id;
		$trans->conversion_rate 	= 0;
		$trans->conversion_amount 	= 0;
		$trans->transferable_amount = 0;
		$trans->account_type  		= 1;
		$trans->from_invoice  		= 1;
		$trans->expiry_month  		= ($response->payment_info) ? $response->payment_info->expiryMonth : 0;
		$trans->expiry_year  		= ($response->payment_info) ? $response->payment_info->expiryYear : 0;
		$trans->save();

		    	if ($type == "Invoice") {
								GeneralLedger::where('invoice_id', $invoice_id)
								->update([
									'trans_ref' => $response->tran_ref,
									'transaction_id' => $trans->id,
								]);
		    	   }else{
						GeneralLedger::where('account_payment_id', $invoice_id)
							->update([
								'trans_ref' => $response->tran_ref,
								'transaction_id' => $trans->id,
							]);

			         }	
	}


	public function callback($string, Request $request)
	{
		dd($request);
	}
}
