<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\SalesEvent;

class salesEventController extends BaseController
{
    public function index(){
        $data=SalesEvent::get();
        return $this->sendResponse($data,"SalesEvent data");
    }

    public function store(Request $request){
        $data=SalesEvent::create($request->all());
        return $this->sendResponse($data,"SalesEvent created successfully");
    }
    public function show(SalesEvent $salesevent){
        return $this->sendResponse($salesevent,"SalesEvent created successfully");
    }

    public function update(Request $request,$id){

        $data=SalesEvent::where('id',$id)->update($request->all());
        return $this->sendResponse($id,"SalesEvent updated successfully");
    }

    public function destroy(SalesEvent $salesevent)
    {
        $salesevent=$salesevent->delete();
        return $this->sendResponse($salesevent,"SalesEvent deleted successfully");
    }
}
