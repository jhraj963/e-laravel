<?php

namespace App\Http\Controllers\Api;

use App\Models\Allorder;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;

class AllorderController extends BaseController
{
    public function index()
    {
        // Retrieving all orders with their associated customer data
        $data = Allorder::with('customer')->get();
        return $this->sendResponse($data, "All orders data retrieved successfully");
    }

    public function store(Request $request)
    {
        // Validate the incoming request if needed
        $validated = $request->validate([
            'customer_id' => 'required|integer|exists:customers,id', // assuming you have a 'customers' table
            'order_date' => 'required|date',
            'status' => 'required|string',
            'total' => 'required|numeric',
        ]);

        // Creating the order
        $data = Allorder::create($validated);
        return $this->sendResponse($data, "Allorder created successfully");
    }

    public function show($id)
    {
        // Finding the specific order by ID
        $order = Allorder::with('customer')->findOrFail($id);
        return $this->sendResponse($order, "Order details retrieved successfully");
    }

    public function update(Request $request, $id)
    {
        // Validate incoming request
        $validated = $request->validate([
            'status' => 'required|string',
            'total' => 'required|numeric',
        ]);

        // Updating the order with the provided ID
        $order = Allorder::findOrFail($id);
        $order->update($validated);

        return $this->sendResponse($order, "Allorder updated successfully");
    }

    public function destroy($id)
    {
        // Deleting the specific order
        $order = Allorder::findOrFail($id);
        $order->delete();

        return $this->sendResponse(null, "Allorder deleted successfully");
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
