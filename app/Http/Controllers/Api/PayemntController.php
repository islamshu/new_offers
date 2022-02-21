<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Models\DiscountSubscription;
use App\Models\Subscription;
use App\Models\Subscriptions_User;
use Carbon\Carbon;
use Facade\FlareClient\Time\Time;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class PayemntController extends BaseController
{
public function myfatoorah(Request $request){
    
    $code = Subscription::find($request->package_id);
    if(!$code){
        $res['status'] = $this->SendError();
        $res['status']['message'] = 'Pakege Not Found';
        return $res;
    }
    $price = $code->price;
//     $count = Subscriptions_User::where('clinet_id', auth('client_api')->id())->where('sub_id', $code->id)->count();
//     $user = new Subscriptions_User();
//         $user->payment_type = 'activition_code';
//         // dd(auth('client_api')->id());
//         $client = auth('client_api')->user();
//         $client->type_of_subscribe = $code->type_paid;

//         if ($code->type_balance == 'Limit') {
//             $client->is_unlimited = 0;
//             $client->credit = $code->balance;
//             $client->remain = $code->balance;
//         } elseif ($code->type_balance == 'UnLimit') {
//             $client->is_unlimited = 1;
//             $client->credit = null;
//             $client->remain = null;
//         }
//         $client->start_date = Carbon::now();
//         $data_type = $code->expire_date_type;
//         $data_type_number = $code->number_of_dayes;
//         if ($data_type == 'days') {
//             $client->expire_date = Carbon::now()->addDays($data_type_number);
//         } elseif ($data_type == 'months') {
//             $client->expire_date = Carbon::now()->addMonths($data_type_number);
//         } elseif ($data_type == 'years') {
//             $client->expire_date = Carbon::now()->addYears($data_type_number);
//         }
//         $client->save();

//         if ($data_type == 'days') {
//             $user->expire_date = Carbon::now()->addDays($data_type_number);
//         } elseif ($data_type == 'months') {
//             $user->expire_date = Carbon::now()->addMonths($data_type_number);
//         } elseif ($data_type == 'years') {
//             $user->expire_date = Carbon::now()->addYears($data_type_number);
//         }
//         $user->status = 'active';
//         $user->balnce = $code->balance;
//         $user->purchases_no =  $count + 1;
//         $user->sub_id  = $code->id;
//         $user->clinet_id  = auth('client_api')->id();
//         $user->save();

//     // if($request->promo_code != null){
//     //  $promo=   DiscountSubscription::where('code',$request->promo_code)->first();
//     //  if($promo){

//     //  }
//     // }
    
    $postFields = [
        //Fill required data
        'NotificationOption' => 'Lnk', //'SMS', 'EML', or 'ALL'
        'InvoiceValue'       => $price,
        'CustomerName'       => $request->customer_name,
            //Fill optional data
            'DisplayCurrencyIso' => $request->currency_iso_code != null ? $request->currency_iso_code : 'SAR',
            'MobileCountryCode'  => @$request->mobile_country_iso_code,
            'CustomerMobile'     => @$request->customer_phone,
            'CustomerEmail'      => @$request->customer_email,
            'PaymentMethod'=>$request->payment_method,
            //'CallBackUrl'        => 'https://example.com/callback.php',
            //'ErrorUrl'           => 'https://example.com/callback.php', //or 'https://example.com/error.php'
            //'Language'           => 'en', //or 'ar'
            //'CustomerReference'  => 'orderId',
            //'CustomerCivilId'    => 'CivilId',
            //'UserDefinedField'   => 'This could be string, number, or array',
            //'ExpiryDate'         => '', //The Invoice expires after 3 days by default. Use 'Y-m-d\TH:i:s' format in the 'Asia/Kuwait' time zone.
            //'SourceInfo'         => 'Pure PHP', //For example: (Laravel/Yii API Ver2.0 integration)
            //'CustomerAddress'    => $customerAddress,
            //'InvoiceItems'       => $invoiceItems,
    ];
    
    $curl = curl_init(get_general('base_url').'/v2/SendPayment');
   $test= curl_setopt_array($curl, array(
        CURLOPT_CUSTOMREQUEST  => 'POST',
        CURLOPT_POSTFIELDS     => json_encode($postFields),
        CURLOPT_HTTPHEADER     => array("Authorization: Bearer ".get_general('api_key'), 'Content-Type: application/json'),
        CURLOPT_RETURNTRANSFER => true,
    ));

    $response = curl_exec($curl);
    $json = json_decode($response);
    dd($json);
    
    $curlErr  = curl_error($curl);

    curl_close($curl);

    if ($curlErr) {
        //Curl is not working in your server
        die("Curl Error: $curlErr");
    }

    $error = $this->handleError($response);
    if ($error) {
        die("Error: $error");
    }

}
function handleError($response) {

    $json = json_decode($response);
    if (isset($json->IsSuccess) && $json->IsSuccess == true) {
        return null;
    }

    //Check for the errors
    if (isset($json->ValidationErrors) || isset($json->FieldsErrors)) {
        $errorsObj = isset($json->ValidationErrors) ? $json->ValidationErrors : $json->FieldsErrors;
        $blogDatas = array_column($errorsObj, 'Error', 'Name');

        $error = implode(', ', array_map(function ($k, $v) {
                    return "$k: $v";
                }, array_keys($blogDatas), array_values($blogDatas)));
    } else if (isset($json->Data->ErrorMessage)) {
        $error = $json->Data->ErrorMessage;
    }

    if (empty($error)) {
        $error = (isset($json->Message)) ? $json->Message : (!empty($response) ? $response : 'API key or API URL is not correct');
    }

    return $error;
}

}
