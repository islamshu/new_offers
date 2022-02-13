<?php

use App\Models\Enterprise;

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
 function sort_vendor($data)
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
