<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountryCollection;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResourses;
use App\Http\Resources\CityCollection;
use App\Http\Resources\HomeSLiderCollection;
use App\Http\Resources\SliderCollection;
use App\Http\Resources\StoresCollection;
use App\Http\Resources\SupportResourses;
use App\Http\Resources\VendorBranchesNewCollection;
use App\Http\Resources\VendorDetiesResourses;
use App\Http\Resources\VendorForOfferCollection;
use App\Http\Resources\VendorForOfferResourses;
use App\Http\Resources\VendorOfferCollection;
use App\Http\Resources\VendorOfferDeCollection;
use App\Http\Resources\VendorReviewResourses;
use App\Http\Resources\VendorReviewsNewCollection;
use App\Models\Branch;
use App\Models\City;
use App\Models\ContactUs;
use App\Models\Enterprise;
use App\Models\Homeslider;
use App\Models\Offer;
use App\Models\Slider;
use App\Models\Support;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorReview;

class HomeController extends BaseController
{
    public function country(){
        $res['status']= $this->sendResponse200('OK');
        $res['data'] = new CountryCollection(Country::get());
        return $res;
    }
    public function city(Request $request){
        // dd($request);
        $uuid = request()->header('uuid') ? request()->header('uuid'): 'jooy';
        $country_id = Enterprise::where('uuid',$uuid)->first()->counteire->first()->id;
      
        $res['status']= $this->sendResponse('OK');
        $res['data'] = new CityCollection(City::where('country_id',$country_id)->where('status',1)->get());
        return $res;
    }
    public function home(Request $request){
        // dd($request->uuid);
        $enterprice= Enterprise::with('categorys')->where('uuid',request()->header('uuid'))->first();
        // dd($enterprice);
        if(!$enterprice){
          $res['status']=$this->sendError();
          $res['meessage'] = 'Enterprise not found';
          return  $res;
        }
        $res['status']= $this->sendResponse('OK');
        $res['data']['slider']= new SliderCollection(Slider::where('city_id',$request->city_id)->get());
        $res['data']['categories'] = new CategoryCollection(@$enterprice->categorys);
        $res['data']['recent_offers']['metadata']['max_no']=15;
        $res['data']['recent_offers']['metadata']['color']='#bcbcbc';
        $res['data']['recent_offers']['data']=[];
        $res['data']['home_sliders'] = new HomeSLiderCollection(HomeSlider::where('city_id',$request->city_id)->get());
        return $res;
        
    }
    public  function vendor_list(Request $request)
    {

        $filtter = $request->filter;
        
        if($filtter == 'offer'){
            $offer = Offer::with('vendor')->whereHas('vendor', function ($q) use ($request) {
              $q->with('enterprise')->whereHas('enterprise', function ($q) use ($request) {
                $q->where('enterprise',get_enterprose_uuid($request()->header('uuid')));
              });
                $q->with('cities')->whereHas('cities', function ($q) use ($request) {
                       $q->where('city_id', $request->city_id);
                     });
                     $q->with('counteire')->whereHas('counteire', function ($q) use ($request) {
                        $q->where('country_id', $request->country_id);
                      });
                      $q->with('categorys')->whereHas('categorys', function ($q) use ($request) {
                        $q->where('category_id', $request->category_id);
                      });
            })->paginate($request->paginate);
            $res['status']= $this->sendResponse('OK'); 
            $res['data']=new VendorOfferCollection($offer);
            return $res;
            
   
        }
        elseif($filtter == 'flash_deal'){
            $offer = Offer::with('vendor')->whereHas('vendor', function ($q) use ($request) {
                $q->with('cities')->whereHas('cities', function ($q) use ($request) {
                       $q->where('city_id', $request->city_id);
                     });
                     $q->with('counteire')->whereHas('counteire', function ($q) use ($request) {
                        $q->where('country_id', $request->country_id);
                      });
                      $q->with('categorys')->whereHas('categorys', function ($q) use ($request) {
                        $q->where('category_id', $request->category_id);
                      });
            })->Where('is_flashdeal',1)->paginate($request->paginate);
            $res['status']= $this->sendResponse('OK'); 
            $res['data']=new VendorOfferCollection($offer);
            return $res;
        }elseif($filtter == 'voucher'){
            $offer = Offer::with('vendor')->whereHas('vendor', function ($q) use ($request) {
                $q->with('cities')->whereHas('cities', function ($q) use ($request) {
                       $q->where('city_id', $request->city_id);
                     });
                     $q->with('counteire')->whereHas('counteire', function ($q) use ($request) {
                        $q->where('country_id', $request->country_id);
                      });
                      $q->with('categorys')->whereHas('categorys', function ($q) use ($request) {
                        $q->where('category_id', $request->category_id);
                      });
            })->Where('is_voucher',1)->paginate($request->paginate);
            $res['status']= $this->sendResponse('OK'); 
            $res['data']=new VendorOfferCollection($offer);
            return $res;
        }elseif($filtter == 'vendor'){
            $vendors = Vendor::with('counteire')->whereHas('counteire', function ($q) use ($request) {
                $q->where('country_id', $request->country_id);
              })->with('cities')->whereHas('cities', function ($q) use ($request) {
                $q->where('city_id', $request->city_id);
              })->paginate($request->paginate);
              $res['status']= $this->sendResponse('OK'); 

              $res['data']=new VendorForOfferCollection($vendors);
              return $res;
        }
        
    }
    public  function vendor_detels(Request $request)
    {
      $vendor = Vendor::find($request->store_id);
      if($vendor){
        $res['status']= $this->sendResponse('OK'); 

        $res['data']['store']=new VendorDetiesResourses($vendor);
        return $res;
      }
    }
    public function vendor_branches(Request $request)
    {
      $stores = Branch::where('vendor_id',$request->store_id)->paginate($request->paginate);
      $res['status']= $this->sendResponse('OK'); 
      $res['data']['branches']=new VendorBranchesNewCollection($stores);
      return $res;  
    }
    public function vendor_offers(Request $request)
    {
      $stores = Offer::where('vendor_id',$request->store_id)->paginate($request->paginate);
      $res['status']= $this->sendResponse('OK'); 
      $res['data']=new VendorOfferDeCollection($stores);
      return $res;  
    }
    public function vendor_reviews(Request $request){
      $reive =VendorReview::where('vendor_id',$request->store_id)->paginate($request->paginate);
      $res['status']= $this->sendResponse('OK'); 
      $res['data']=new VendorReviewsNewCollection($reive);
      return $res;  
    }
    public function nearby_partners(Request $request)
    {
      $vendors = Vendor::with('counteire')->whereHas('counteire', function ($q) use ($request) {
        $q->where('country_id', $request->country_id);
      })->with('cities')->whereHas('cities', function ($q) use ($request) {
        $q->where('city_id', $request->city_id);
      })->paginate($request->paginate);
    //  $collction = get_sort(new StoresCollection($vendors));
     $collection =  VendorForOfferResourses::collection($vendors);
     $datad = [];
     foreach(collect($collection)->sortBy('distance') as $data){
      array_push($datad,$data);
     }
     
     $res['status']= $this->sendResponse('OK'); 
     $res['data']['stores']=$datad ;

        return $res;

        

    }
    public function get_support(Request $request){
      $suport = Support::where('user_id',auth()->id())->get();
      $res['status']= $this->sendResponse('OK'); 
      $res['data']=SupportResourses::collection($suport) ;
      return $res;
    }
    public function post_support(Request $request){
      $suport = new Support();
      $suport->user_id = auth()->id();
      $suport->title = $request->title;
      $suport->message = $request->message;
      $suport->type = $request->type;
      $suport->save();
      $res['status']= $this->sendResponse('OK'); 
      $res['data']=[
        ''=>''
      ];
      return $res;
    }
    public function contact_us(Request $request){
      $contact = new ContactUs();
      if($request->city_id == 'null'){
        $contact->city_id = null;
      }else{
        $contact->city_id =$request->city_id;
      }
      if($request->country_id == 'null'){
        $contact->country_id = null;
      }else{
        $contact->country_id =$request->country_id;
      }
      $contact->first_name = $request->first_name;
      $contact->last_name = $request->last_name;
      $contact->message = $request->message;
      // dd($contact);
      $contact->save();
      $res['status']= $this->sendResponse('OK'); 
      $res['data']=[
        ''=>''
      ];
      return $res;
    }
    public function profile(){
      $user = User::find(auth()->id());
      $res['status']= $this->sendResponse('OK'); 
      $res['data']=[
        'name'=>$user->name,
        'email'=>$user->email,
        'phone'=>$user->phone,
        'last_login'=>$user->last_login
      ];
      return $res;
    }
   
}
