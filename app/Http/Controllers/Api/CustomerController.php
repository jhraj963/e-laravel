<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\JsonResponse;
use Validator;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Log;

class CustomerController extends BaseController
{
    // Register customer
    public function registerCustomer(Request $r): JsonResponse
    {
        // Validate the incoming request
        $validate = Validator::make($r->all(), [
            'full_name' => 'required|string',             // Required
            'email' => 'required|email|unique:customers,email', // Required
            'password' => 'required',
            'c_password' => 'required|same:password',
            'phone' => 'nullable|string',                 // Optional
            'address' => 'nullable|string',               // Optional
            'state' => 'nullable|string',                 // Optional
            'country' => 'nullable|string',               // Optional
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional
        ]);

        // If validation fails, return a customized error response
        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'data' => $validate->errors(),
                'message' => 'Validation Error'
            ], 203);
        }

        // Get input data from the request
        $input = $r->all();

        // Handle photo upload if present
        if ($r->hasFile('photo')) {
            $photo = $r->file('photo');
            $photoName = time() . '_' . rand(1111, 9999) . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('/customers'), $photoName);
            $input['photo'] = $photoName;
        }

        // Hash the password before saving
        $input['password'] = bcrypt($input['password']);

        // Try to create the customer and generate the token
        try {
            $customer = Customer::create($input);

            // Generate API token for the newly created customer
            $data['token'] = $customer->createToken('hosp')->plainTextToken;
            $data['data'] = $customer;

            // Return success response with customer data and token
            return $this->sendResponse($data, "Customer registered successfully");

        } catch (Exception $e) {
            // Log the exception for debugging purposes
            Log::error('Customer registration failed: ' . $e->getMessage());

            // Return error response if there was an issue during registration
            return $this->sendError(['error' => 'Failed to create customer'], "Internal Error", 500);
        }
    }

    // Login customer
    public function loginCustomer(Request $request): JsonResponse
    {
        try {
            // Find customer by email
            $customer = Customer::where('email', $request->email)->first();

            if ($customer) {
                // Check if password matches
                if (Hash::check($request->password, $customer->password)) {
                    $data['token'] = $customer->createToken('hosp')->plainTextToken;
                    $data['data'] = $customer;
                    return $this->sendResponse($data, "Customer login successfully");
                } else {
                    return $this->sendError(['error' => 'Email or password is incorrect'], "Unauthorized", 400);
                }
            } else {
                return $this->sendError(['error' => 'Email or password is incorrect'], "Unauthorized", 400);
            }
        } catch (Exception $e) {
            return $this->sendError(['error' => 'An error occurred while processing your request'], "Unauthorized", 400);
        }
    }

    // Fetch all customers
    public function index(): JsonResponse
    {
        try {
            // Fetch all customers
            $customers = Customer::all();

            // Add full URL path for each customer's photo if exists
            foreach ($customers as $customer) {
                if ($customer->photo) {
                    $customer->photo = url('customers/' . $customer->photo);
                }
            }

            return $this->sendResponse($customers, "Customers fetched successfully");

        } catch (Exception $e) {
            return $this->sendError(['error' => 'An error occurred while fetching customers'], "Error", 500);
        }
    }

    // Fetch a specific customer by ID
    public function show($id): JsonResponse
    {
        try {
            // Find the customer by ID
            $customer = Customer::find($id);

            // If customer is not found, return error
            if (!$customer) {
                return $this->sendError(['error' => 'Customer not found'], "Not Found", 404);
            }

            // Add full URL path for the customer's photo if it exists
            if ($customer->photo) {
                $customer->photo = url('customers/' . $customer->photo);
            }

            return $this->sendResponse($customer, "Customer fetched successfully");

        } catch (Exception $e) {
            return $this->sendError(['error' => 'An error occurred while fetching the customer'], "Error", 500);
        }
    }
}
