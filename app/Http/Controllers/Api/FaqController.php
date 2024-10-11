<?php

namespace App\Http\Controllers\Api;

use App\Models\Faq;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;

class FaqController extends BaseController
{
    public function index(){
        $data=Faq::get();
        return $this->sendResponse($data,"Faq data");
    }

    public function store(Request $request){
        $data=Faq::create($request->all());
        return $this->sendResponse($data,"Faq created successfully");
    }
    public function show(Faq $faq){
        return $this->sendResponse($faq,"Faq created successfully");
    }

    public function update(Request $request,$id){

        $data=Faq::where('id',$id)->update($request->all());
        return $this->sendResponse($id,"Faq updated successfully");
    }

    public function destroy(Faq $faq)
    {
        $faq=$faq->delete();
        return $this->sendResponse($faq,"Faq deleted successfully");
    }
}
