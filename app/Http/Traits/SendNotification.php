<?php
namespace App\Http\Traits;
trait SendNotification
{
    public function notification($to,$title, $body, $page,$vendor_id,$offer_id)
    {
        $firebase_key = get_general('firebase');
        $dataArr = ['status'=>"done",
        'screen'=>$page,
        'store_id'=>$vendor_id];
        $notification = array(
            'title' =>$title,
            'body' => $body,
            'store_id' =>$vendor_id,
            'offer_id' => $offer_id,
            'sound' => 'default',
            'badge' => '1',
            );
        $arrayToSend = array(
            'to' => $to,
            'notification' => $notification,
            'data' => $dataArr,
            'priority'=>'high'
        );
        $dataString = json_encode ($arrayToSend);
        $headers = [
            'Authorization: key=' . $firebase_key,
            'Content-Type:application/json',
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $response = curl_exec($ch);
        // dd($response);

        
    }
}