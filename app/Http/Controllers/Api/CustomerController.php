<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\JsonResponse;
use Validator;
use Illuminate\Support\Facades\Auth;

class CustomerController extends BaseController
{
    public function registerCustomer(Request $r): JsonResponse
    {
        $validate=Validator::make($r->all(),[
            'full_name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
            'c_password'=>'required|same:password'
        ]);

        if($validate->fails()){
            return $this->sendError($validate->errors(),"Validation Error",203);
        }

        $input= $r->all();
        $input['password']=bcrypt($input['password']);
        $customer=Customer::create($input);
        $data['token']=$customer->createToken('hosp')->plainTextToken;
        $data['data']=$customer;
        return $this->sendResponse($data,"Customer register successfully");

    }

    public function loginCustomer(Request $r):JsonResponse
    {
        if(Auth::attempt(['email' => $r->email, 'password' => $r->password])){
            $customer=Auth::customer();
            $data['token']=$customer->createToken('hosp')->plainTextToken;
            $data['data']=$customer;
            return $this->sendResponse($data,"Customer login successfully");
        }else{
            return $this->sendError(['error'=>'email or password is not correct'],"Unauthorized",400);
        }
    }



}
