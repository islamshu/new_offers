<?php

use App\Models\Clinet;
use App\Models\Enterprise;
use App\Models\GeneralInfo;
use App\Models\Offer;
use App\Models\OfferUser;
use App\Models\Social;
use App\Models\Transaction;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Container\Container;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

function openJSONFile($code){
    $jsonString = [];
    if(File::exists(base_path('resources/lang/'.$code.'.json'))){
        $jsonString = file_get_contents(base_path('resources/lang/'.$code.'.json'));
        $jsonString = json_decode($jsonString, true);
    }
    return $jsonString;
}
function saveJSONFile($code, $data){
    ksort($data);
    $jsonData = json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    file_put_contents(base_path('resources/lang/'.$code.'.json'), stripslashes($jsonData));
}
function check_offer($item){

    if($item->end_time >= Carbon::now()){
        return 1;
    }else{
        return 0;
    }
}
function saving_offer($user){
    $offeruser = OfferUser::where('client_id',$user)->get();
    $count = [];
    foreach($offeruser as $of){
       $offer = Offer::find($of->offer_id);
       if($offer->offertype->offer_type == 'special_discount'){
           $c = $offer->offertype->price_befor_discount - $offer->offertype->price_after_discount;
           array_push($count,$c);
       }elseif($offer->offertype->offer_type == 'buyOneGetOne'){
        array_push($count,$offer->offertype->price);
       }
    }
    return array_sum($count);
}
function offer_saving($id)
{
    $offer = Offer::find($id);
    $count = [];
    if($offer->offertype->offer_type == 'special_discount'){
      $c= $offer->offertype->price_befor_discount - $offer->offertype->price_after_discount;
       array_push($count,$c);
    }elseif($offer->offertype->offer_type == 'buyOneGetOne'){
         array_push($count,$offer->offertype->price);
    }
    return array_sum($count);

}
 function sort_vendor($data)
 {
    $datad = [];
    $data_array = collect($data);
    foreach (collect($data)->sortBy('distance') as $s) {
      array_push($datad, $s);
    }
    return $datad;

 }
 function sort_offer($data)
 {
    $datad = [];
    $data_array = collect($data);
    foreach (collect($data)->sortBy('distance') as $s) {
      array_push($datad, $s);
    }
    return $datad;

 }
 function get_dinstance($lat1,$lon1,$lat2,$lon2){
    $theta = $lon1 - $lon2; 
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)); 
    $dist = acos($dist); 
    $dist = rad2deg($dist); 
    $miles = $dist * 60 * 1.1515;
    return $miles;
}
if ( ! function_exists('get_social'))
{
    function get_social($key)
    {
       $general = Social::where('type', $key)->first();
       if($general){
           return $general->value;
       }

       return '';
    }

}
function get_count_client($id){
    $trans = Transaction::where('offer_id',$id)->get()->unique('client_id')->count();
    return $trans;
    

}
function get_lang(){
    return app()->getLocale();
}
function get_sort($data)
{
   $ss = collect($data);
   $sorted = $ss->sortBy([
    ['distance', 'desc'],
]);
   $sorted->values()->all();
dd($sorted);
 return ; 
}
function get_enterprose_uuid($uuid){
    $enterprise = Enterprise::where('uuid',$uuid)->first();
 
    if($enterprise){
       
        return $enterprise->id;
    }else{
        return false;
    }
}
function userdefult(){
    if(request()->header('uuid') == null){
        return 'jooy';
    }else{
        return request()->header('uuid');
    }
}
 function is_date($date){
    if (DateTime::createFromFormat('Y-m-d', $date) !== false) {
       return $date;
      }else{
          return null;
      }
}
function offer_type($type){
    
    
    if($type == 'buyOneGetOne'){
   
        return 'Buy 1 Get 1';
    }elseif($type =='general_offer'){
        return 'General Discount';
    }elseif($type =='special_discount'){
        return 'Special Discount';
    }
}
function paginate($items, $limit, $page , $options = [])
{
    $array = [];
    foreach($items->forPage($page, $limit) as $it){
    array_push($array,$it);  
    }
    // $items =coll $items 
    // return new LengthAwarePaginator($items->forPage($page, $limit), $items->count(), $limit, $page, $options);

    return $array;
}
function send_message($phone,$message)
{
    $token = get_general('sms_token');
    $sender = get_general('sender_id') ;
    
    
  $url = 'https://api.oursms.com/api-a/msgs?token='.$token.'&src='.$sender.'&dests='.$phone.'&body='.$message;
  $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:97.0) Gecko/20100101 Firefox/97.0';

  $response = Http::withHeaders(['User-Agent' => $userAgent])->get($url);
  return true;

//   966548102240
 

   
}
function get_nationalities(){
    $clients = Clinet::get();
    $natonalty =[];
    foreach($clients as $c){
        array_push($natonalty,$c->nationality);
    }
   return ( count(array_unique($natonalty, SORT_REGULAR)));


}
function best_offer(){
    $trans = Transaction::where('enterprise_id',auth()->user()->ent_id)->get();
    $offer =[];
    foreach($trans as $tr){
     array_push($offer,$tr->offer_id) ;  
    }
    if($offer != null){
        $counts = array_count_values($offer);
        arsort($counts);
    }else{
        $counts = 0;
    }
    if($counts == 0){
        $most_offer_use = 0; 
    }else{
        $most_offer_use = key($counts);
    }
    return $most_offer_use;
}
function best_branch(){
    $trans = Transaction::where('enterprise_id',auth()->user()->ent_id)->get();
    $branch =[];
    foreach($trans as $tr){
     array_push($branch,$tr->branch_id) ;  
    }
    if($branch != null){
        $counts = array_count_values($branch);
        arsort($counts);
    }else{
        $counts = 0;
    }
    if($counts == 0){
        $most_branch_use = 0; 
    }else{
        $most_branch_use = key($counts);
    }
    return $most_branch_use;
}
function best_brand(){
    $trans = Transaction::where('enterprise_id',auth()->user()->ent_id)->get();
    $branch =[];
    foreach($trans as $tr){
     array_push($branch,$tr->vendor_id) ;  
    }
    if($branch != null){
        $counts = array_count_values($branch);
        arsort($counts);
    }else{
        $counts = 0;
    }
    if($counts == 0){
        $most_branch_use = 0; 
    }else{
        $most_branch_use = key($counts);
    }
    return $most_branch_use;
}
function return_redirect($url){
   return new RedirectResponse($url); 

}
function get_general($key)
    {
       $general = GeneralInfo::where('key', $key)->first();
       if($general){
           return $general->value;
       }

       return '';
    }