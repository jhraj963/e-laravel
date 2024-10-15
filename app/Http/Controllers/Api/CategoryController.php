<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function index(){
        $data=Category::get();
        return $this->sendResponse($data,"Category data");
    }

    public function store(Request $request){
        $data=Category::create($request->all());
        return $this->sendResponse($data,"Category created successfully");
    }
    public function show(Category $category){
        return $this->sendResponse($category,"Category created successfully");
    }

    public function update(Request $request,$id){

        $data=Category::where('id',$id)->update($request->all());
        return $this->sendResponse($id,"Category updated successfully");
    }

    public function destroy(Category $category)
    {
        $category=$category->delete();
        return $this->sendResponse($category,"Category deleted successfully");
    }
}
