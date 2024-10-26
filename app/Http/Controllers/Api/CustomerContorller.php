<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;

class CustomerContorller extends BaseController
{
    public function index(){
        $data=Customer::get();
        return $this->sendResponse($data,"Customer data");
    }

    public function store(Request $request){
        $data=Customer::create($request->all());
        return $this->sendResponse($data,"Customer created successfully");
    }
    public function show(Customer $customer){
        return $this->sendResponse($customer,"Customer created successfully");
    }

    public function update(Request $request,$id){

        $data=Customer::where('id',$id)->update($request->all());
        return $this->sendResponse($id,"Customer updated successfully");
    }

    public function destroy(Customer $customer)
    {
        $customer=$customer->delete();
        return $this->sendResponse($customer,"Customer deleted successfully");
    }
}
