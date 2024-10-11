<?php

namespace App\Http\Controllers\Api;

use App\Models\Page;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;

class Pagecontroller extends BaseController
{
    public function index(){
        $data=Page::get();
        return $this->sendResponse($data,"Page data");
    }

    public function store(Request $request){
        $data=Page::create($request->all());
        return $this->sendResponse($data,"Page created successfully");
    }
    public function show(Page $page){
        return $this->sendResponse($page,"Page created successfully");
    }

    public function update(Request $request,$id){

        $data=Page::where('id',$id)->update($request->all());
        return $this->sendResponse($id,"Page updated successfully");
    }

    public function destroy(Page $page)
    {
        $page=$page->delete();
        return $this->sendResponse($page,"Page deleted successfully");
    }
}
