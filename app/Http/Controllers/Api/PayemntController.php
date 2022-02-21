<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class PayemntController extends BaseController
{
public function myfatoorah(Request $request){
    $postFields = [
        //Fill required data
        'NotificationOption' => 'Lnk', //'SMS', 'EML', or 'ALL'
        'InvoiceValue'       => '50',
        'CustomerName'       => 'fname lname',
            //Fill optional data
            //'DisplayCurrencyIso' => 'KWD',
            //'MobileCountryCode'  => '+965',
            //'CustomerMobile'     => '1234567890',
            //'CustomerEmail'      => 'email@example.com',
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
    
    $curl = curl_init(get_general('base_url'));
    curl_setopt_array($curl, array(
        CURLOPT_CUSTOMREQUEST  => 'POST',
        CURLOPT_POSTFIELDS     => json_encode($postFields),
        CURLOPT_HTTPHEADER     => array("Authorization: Bearer ".get_general('api_key'), 'Content-Type: application/json'),
        CURLOPT_RETURNTRANSFER => true,
    ));

    $response = curl_exec($curl);
    dd($response);
    $curlErr  = curl_error($curl);

    curl_close($curl);

    if ($curlErr) {
        //Curl is not working in your server
        die("Curl Error: $curlErr");
    }

    // $error = handleError($response);
    // if ($error) {
    //     die("Error: $error");
    // }

}
}
