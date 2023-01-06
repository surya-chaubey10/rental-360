<?php
use App\Models\Organisation;
use App\Models\Notifications;
use App\Models\CompanyActivity;
use App\Models\GeneralLedger;
use App\Models\OrganisationMenu;
use App\Models\OrganisationSubMenu;
use App\Models\RoleMenu;
use Carbon\Carbon;
use App\Models\User;

function pre($array, $exit = true)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';

    if ($exit) {
        exit();
    }
}

function prepareResult($status, $data, $errors, $msg, $status_code, $pagination = array())
{
    return response()->json(['status' => $status, 'data' => $data, 'message' => $msg, 'errors' => $errors, 'pagination' => $pagination], $status_code);
}

function ajax_response($status, $data, $errors, $msg, $status_code)
{
    return response(['status' => $status, 'data' => $data, 'message' => $msg, 'errors' => $errors, 'status_code' => $status_code]);
}

/**
 * output value if found in object or array
 * @param  [object/array] $model             Eloquent model, object or array
 * @param  [string] $key
 * @param  [boolean] $alternative_value
 * @return [type]
 */
function model($model, $key, $alternative_value = null, $type = 'object', $pluck = false)
{
    if ($pluck) {
        $count = $model;
        $array = array();
        if ($count && count($count)) {
            $array = $count->pluck($key)->toArray();
        }

        if (count($array)) {
            return implode(',', $array);
        }

        return $alternative_value;
    }

    if ($type == 'object') {
        if (isset($model->$key)) {
            return $model->$key;
        }
    }

    if ($type == 'array') {
        if (isset($model[$key]) && $model[$key]) {
            return $model[$key];
        }
    }

    return $alternative_value;
}

//FOR Refund Payment
if(!function_exists('refund_payment')){
    function refund_payment($payload, $server_key)
    {
        $curl = curl_init('https://secure.paytabs.com/payment/request');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        $headers = [
            'Authorization: '.$server_key.'',
            ];
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
        $curl_response = curl_exec($curl);

        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error occured during curl exec. Additional info: ' . var_export($info));
        }
        curl_close($curl);
        $result = json_decode($curl_response, true, 512, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_FORCE_OBJECT);
        return $result;
    }
}

//FOR GENERATING LINK
if(!function_exists('generate_link')){
    function generate_link($payload, $server_key)
    {
        $curl = curl_init('https://secure.paytabs.com/payment/request');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        $headers = [
            'Authorization: '.$server_key.'',
            ];
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
        $curl_response = curl_exec($curl);

        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error occured during curl exec. Additional info: ' . var_export($info));
        }
        curl_close($curl);
        $result = json_decode($curl_response, true, 512, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_FORCE_OBJECT);
        return $result;
    }
}

function general_ledger($amount,$invoice_id,$booking_id,$type,$payment_info)
{
    /* dd($payment_info->payment_method); */
                    $commissionCharges=0;
					$vat=5;
					$note=NULL;
                    $fixed_price=1;
					$fcredit=$amount;
					$org= org_details();
					$subription=$org->subscription;
                     if(isset($subription)){
						 
						$credit=$amount;
                        if($payment_info->payment_method=="Visa"){
                            $payment_getway=1;
                        }else if($payment_info->payment_method=="Amex"){
                            $payment_getway=2;
                        }else if($payment_info->payment_method=="Binance Pay"){
                            $payment_getway=3;
                        }else if($payment_info->payment_method=="Spotii"){
                            $payment_getway=4;
                        }else if($payment_info->payment_method=="Tabby"){
                            $payment_getway==5;
                        }else{
                            $payment_getway==1;
                        }
						
						$getwayName= explode(",",$subription->payment_gateway);
						$getwayAmount= explode(",",$subription->payement_gateway_amount);
			
						$key = array_search($payment_getway,$getwayName);
						$getwayCharge= isset($getwayAmount[$key]) ? $getwayAmount[$key] : 0;
			
						$PGcharges=$credit*(float)$getwayCharge/100;
						if($subription->commission_type==1){
			
							$commissionCharges=$subription->commission_amount;
			
						}else if($subription->commission_type==2){
			
							$commissionCharges=$credit*$subription->commission_amount/100;
			
						}else{
			
							$commissionCharges=0;
			
						}
                        
						$fees=$PGcharges+$commissionCharges;
						$total_vat= ($commissionCharges+$PGcharges)*$vat/100;
						$fcredit=$credit-($PGcharges+$commissionCharges+$total_vat+$fixed_price);
						$note='Credit '.$amount.', Fixed Fee - 1, PG Fees = '.$PGcharges.', Comission Fees - '.$commissionCharges.',  Vat - '.$total_vat.', Net '.$fcredit;
						

					 }


						
					$general_ledger = new GeneralLedger;
					$general_ledger->organisation_id         = getUser()->organisation_id ;
					$general_ledger->credit                  = $fcredit;
					$general_ledger->amount                  = $amount;
                   
                    if($type=='invoice_payment'){

                        $general_ledger->invoice_id              = $invoice_id;
                        $general_ledger->booking_id              = $booking_id;
                        $general_ledger->document_type           = "from_invoice";

                    }else{
                        $general_ledger->account_payment_id      = $invoice_id;
                        $general_ledger->booking_id              = $booking_id->id;
                        $general_ledger->document_type           = "from_quick_payment";

                    }
                    
                    $general_ledger->pgcharges               = $PGcharges;
                    $general_ledger->vat                     = $total_vat;
                    $general_ledger->commision               = $commissionCharges;
                  

					  /* Need to add calculation from company */
					
					$general = GeneralLedger::select('Balance')->orderBy('id', 'DESC') ->where('organisation_id', getUser()->organisation_id) ->first();
					
					if (is_object($general)) {
						  $general_ledger->Balance = $general->Balance + $fcredit;
						
					} else {
						  $general_ledger->Balance  = $fcredit;
					}
					$general_ledger->note           = $note;
					
					$general_ledger->save();
    
}
  
function org_details()
{
    return Organisation::with('subscription','countrymaster')->orderBy('id', 'DESC') ->where('id', getUser()->organisation_id) ->first();
}




function org_branded_logo($org_id)
{ 
    return Organisation::with('subscription','moreInfo')->orderBy('id', 'DESC')->where('id', $org_id) ->first();
}
function getNotifications()
{
    $startdate = Carbon::now()->toDateTimeString();
    $lastdate = now()->subDays(5)->setTime(0, 0, 0)->toDateTimeString();
    return Notifications::select('notifications.*')
          ->where('read', '0')
          ->where('organisation_id', getUser()->organisation_id)
          ->where('user_id', getUser()->id)
          ->whereDate('created_at', '<=', $startdate)
          ->whereDate('created_at', '>=', $lastdate)
          ->orderBy('id', 'DESC')
          ->get();
}
function getallNotifications()
{
    $startdate = Carbon::now()->toDateTimeString();
    $lastdate = now()->subDays(5)->setTime(0, 0, 0)->toDateTimeString();
    return Notifications::select('notifications.*')
        ->where('notifications.user_id', getUser()->id) 
        ->where('notifications.organisation_id', getUser()->organisation_id) 
        ->whereDate('notifications.created_at', '<=', $startdate)
        ->whereDate('notifications.created_at', '>=', $lastdate)
        ->orderBy('notifications.id', 'DESC') 
        ->get();
        
}

function getallCompanyactiity()
{
    $startdate = Carbon::now()->toDateTimeString();
    $lastdate = now()->subDays(5)->setTime(0, 0, 0)->toDateTimeString();
    return CompanyActivity::select('company_activities.*')
        ->whereDate('created_at', '<=', $startdate)
        ->whereDate('created_at', '>=', $lastdate)
        ->where('organisation_id', getUser()->organisation_id) 
        ->orderBy('id', 'DESC') 
        ->get();
        
}

function superadminNotifications()
{
    $startdate = Carbon::now()->toDateTimeString();
    $lastdate = now()->subDays(5)->setTime(0, 0, 0)->toDateTimeString();
    return Notifications::select('notifications.*')
        ->where('superadmin_read', '0') 
        ->where('superadmin_notification', '1') 
        ->whereDate('created_at', '<=', $startdate)
        ->whereDate('created_at', '>=', $lastdate)
        ->orderBy('id', 'DESC') 
        ->get();
        
}
function superadminallNotifications()
{
    $startdate = Carbon::now()->toDateTimeString();
    $lastdate = now()->subDays(5)->setTime(0, 0, 0)->toDateTimeString();
    return Notifications::select('notifications.*')
        ->where('superadmin_notification', '1') 
        ->whereDate('created_at', '<=', $startdate)
        ->whereDate('created_at', '>=', $lastdate)
        ->orderBy('id', 'DESC') 
        ->get();
        
}
function sr($data)
{
    $data = str_replace('[', ' ', $data);
    $data = str_replace(']', '', $data);
    return $data;
}

function getUser()
{
    $allSessions = session()->all();
    return auth('sanctum')->user();
    dd($user);
    // return auth('api')->user() ?? ;
}


function checkPermission($permissionName)
{
    if (!auth('web')->user()->can($permissionName)) {
        return false;
    }
    return true;
}

function setJs($filename)
{
    return asset('public/');
}

function setCss($filename)
{
    return asset('public/');
}

	//TODO: For Creating Callback Link
	if(!function_exists('CallbackLink'))
	{
    }
    function CallbackLink($id)
    {
      return url('/payment-callback') .'/'. base64_encode($id);
    }

	//TODO: For Creating Return Callback Link
	if(!function_exists('ReturnCallbackLink'))
	{
    }
    function ReturnCallbackLink($id)
    {
      return url('/callback') .'/'.  base64_encode($id);
    }

    function MasterPassword()
    {
        $master_password="rent@90al$#?";

        return $master_password;
    }


    function user_sidebar()
    {
        
    return RoleMenu::select(
        'role_menus.id',
        'role_menus.organisation_id',
        'role_menus.admin_menu_id'
        )
        ->with(
            'admin_menu:id,name,class,badge,icon,url,position,status',
            'role_sub_menu:id,organisation_id,role_menu_id,admin_sub_menu_id',
            'role_sub_menu.admin_sub_menu:id,name,url,icon,position,status'

            )
        ->where('role_menus.organisation_id', getUser()->organisation_id)
        ->where('role_menus.role_id', getUser()->role_id)->get();
    }


    
    function org_sidebar()
    {
        
    return OrganisationMenu::select(
        'organisation_menus.id',
        'organisation_menus.organisation_id',
        'organisation_menus.admin_menu_id'
        )
        ->with(
            'admin_menu:id,name,class,badge,icon,url,position,status',
            'org_sub_menu:id,organisation_id,organisation_menu_id,admin_sub_menu_id',
            'org_sub_menu.admin_sub_menu:id,name,url,icon,position,status'

            )
        ->where('organisation_menus.organisation_id', getUser()->organisation_id)->get();
    }





