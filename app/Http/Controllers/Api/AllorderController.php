<?php

namespace App\Http\Controllers\Api;

use App\Models\Allorder;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;

class AllorderController extends BaseController
{
    public function index(){
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
}
