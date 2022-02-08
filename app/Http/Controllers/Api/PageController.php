<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\PageResoures;
use App\Models\SystemInfo;

class PageController extends BaseController
{
    public function privacy(){
        $res['status']= $this->sendResponse('OK');
        $res['data']['privacy_policy'] = new PageResoures(SystemInfo::find(1));
        return $res;  
    }
    public function terms(){
        $res['status']= $this->sendResponse('OK');
        $res['data']['term_and_condition'] = new PageResoures(SystemInfo::find(2));
        return $res;  
    }
    public function abouts(){
        $res['status']= $this->sendResponse('OK');
        $res['data']['about_us'] = new PageResoures(SystemInfo::find(3));
        return $res;  
    }
    public function faqs(){
        $res['status']= $this->sendResponse('OK');
        $res['data']['FAQS'] = new PageResoures(SystemInfo::find(4));
        return $res;  
    }
    public function works(){
        $res['status']= $this->sendResponse('OK');
        $res['data'] = new PageResoures(SystemInfo::find(5));
        return $res;  
    }
}
