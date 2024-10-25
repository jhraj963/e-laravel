<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Http\Controllers\Api\BaseController;

class DiscountController extends BaseController
{
    public function index(){
        $data=Discount::with('salesevent')->get();
        return $this->sendResponse($data,"Discount data");
    }

    public function store(Request $request){

        $input=$request->all();
        $data=Discount::create($request->all());
        return $this->sendResponse($data,"Discount created successfully");
    }

    public function show(Discount $discount){
        return $this->sendResponse($discount,"Discount created successfully");
    }

    public function update(Request $request,$id){

        $input=$request->all();

        $data=Discount::where('id',$id)->update($request->all());
        return $this->sendResponse($id,"Discount updated successfully");
    }

    public function destroy(Discount $discount)
    {
        $discount=$discount->delete();
        return $this->sendResponse($discount,"Discount deleted successfully");
    }
}
