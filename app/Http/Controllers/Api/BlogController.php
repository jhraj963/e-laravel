<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;

class BlogController extends BaseController
{
    public function index(){
        $data=Blog::get();
        return $this->sendResponse($data,"Blog data");
    }

    public function store(Request $request){
        $data=Blog::create($request->all());
        return $this->sendResponse($data,"Blog created successfully");
    }
    public function show(Blog $blog){
        return $this->sendResponse($blog,"Blog created successfully");
    }

    public function update(Request $request,$id){

        $data=Blog::where('id',$id)->update($request->all());
        return $this->sendResponse($id,"Blog updated successfully");
    }

    public function destroy(Blog $blog)
    {
        $blog=$blog->delete();
        return $this->sendResponse($blog,"Blog deleted successfully");
    }
}
