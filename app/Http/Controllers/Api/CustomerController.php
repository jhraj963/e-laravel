<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\JsonResponse;
use Validator;
use Illuminate\Support\Facades\Hash;
use Exception;

class CustomerController extends BaseController
{
    // Register customer
    public function registerCustomer(Request $r): JsonResponse
    {
        $validate = Validator::make($r->all(), [
            'full_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if ($validate->fails()) {
            return $this->sendError($validate->errors(), "Validation Error", 203);
        }

        $input = $r->all();
        $input['password'] = bcrypt($input['password']);
        $customer = Customer::create($input);

        $data['token'] = $customer->createToken('hosp')->plainTextToken;
        $data['data'] = $customer;

        return $this->sendResponse($data, "Customer registered successfully");
    }

    // Login customer
    public function loginCustomer(Request $request): JsonResponse
    {
        try {
            $customer = Customer::where('email', $request->email)->first();

            if ($customer) {
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
            $customers = Customer::all();  // Fetch all customers
            return $this->sendResponse($customers, "Customers fetched successfully");
        } catch (Exception $e) {
            return $this->sendError(['error' => 'An error occurred while fetching customers'], "Error", 500);
        }
    }
}
