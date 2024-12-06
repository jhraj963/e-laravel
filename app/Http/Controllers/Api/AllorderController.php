<?php

namespace App\Http\Controllers\Api;

use App\Models\Allorder;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;

class AllorderController extends BaseController
{
    public function index(){
        $data=Allorder::get();
        $data=Allorder::with('customer')->get();
        return $this->sendResponse($data,"Allorder data");
    }

    public function store(Request $request){
        $data=Allorder::create($request->all());
        return $this->sendResponse($data,"Allorder created successfully");
    }
    public function show(Allorder $allorder){
        return $this->sendResponse($allorder,"Allorder created successfully");
    }

    public function update(Request $request,$id){

        $data=Allorder::where('id',$id)->update($request->all());
        return $this->sendResponse($id,"Allorder updated successfully");
    }

    public function destroy(Allorder $allorder)
    {
        $allorder=$allorder->delete();
        return $this->sendResponse($allorder,"Allorder deleted successfully");
    }

    public function getOrdersByCustomer($customer_id)
    {
        // Assuming 'customer_id' is a foreign key in your 'orders' table
        $orders = Allorder::where('customer_id', $customer_id)->get();

        // Check if orders exist for this customer
        if ($orders->isEmpty()) {
            return response()->json([
                'message' => 'No orders found for this customer.'
            ], 404);
        }

        // Return the orders for the specific customer
        return response()->json($orders);
    }
}
