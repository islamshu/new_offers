<?php
namespace App\Http\Traits;
trait SendNotification
{
    public function notification($registration_ids,$title, $message, $page,$store_id,$offer_id)
    {
        $api_access_key = get_general('firebase');
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
		// $token='235zgagasd634sdgds46436';

	    $notification = [
            'title' => $title,
            'body' => $message
        ];

        $extraNotificationData = ["message" => $notification,"store_id" => $store_id];

        $fcmNotification = [
            'registration_ids' => $registration_ids,
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=' . $api_access_key,
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);

        
    }
}