<?php

namespace App\Http\Controllers\Api;

use App\Models\Allcustomer;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;

class AllcustomerController extends BaseController
{
    public function index(){
        $data=Allcustomer::get();
        return $this->sendResponse($data,"Allcustomer data");
    }

    public function store(Request $request){
        $data=Allcustomer::create($request->all());
        return $this->sendResponse($data,"Allcustomer created successfully");
    }
    public function show(Allcustomer $allcustomer){
        return $this->sendResponse($allcustomer,"Allcustomer created successfully");
    }

    public function update(Request $request,$id){

        $data=Allcustomer::where('id',$id)->update($request->all());
        return $this->sendResponse($id,"Allcustomer updated successfully");
    }

    public function destroy(Allcustomer $allcustomer)
    {
        $allcustomer=$allcustomer->delete();
        return $this->sendResponse($allcustomer,"Allcustomer deleted successfully");
    }
}
