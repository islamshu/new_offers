<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Models\Subscription;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class PayemntController extends BaseController
{
public function myfatoorah(Request $request){
    $pakege = Subscription::find($request->package_id);
    if(!$pakege){
        $res['status'] = $this->SendError();
        $res['status']['message'] = 'Pakege Not Found';
        return $res;
    }
    
    $postFields = [
        //Fill required data
        'NotificationOption' => 'Lnk', //'SMS', 'EML', or 'ALL'
        'InvoiceValue'       => '50',
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
