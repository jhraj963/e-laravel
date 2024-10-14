<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AddProduct;
use App\Http\Controllers\Api\BaseController;

class AddProductController extends BaseController
{
     public function index(){
        $data=AddProduct::get();
        return $this->sendResponse($data,"AddProduct data");
    }

    public function store(Request $request){

    /* for files */
        $input=$request->all();
            $files=[];
            if($request->hasFile('files')){
                foreach($request->file('files') as $f){
                    $imagename=time().rand(1111,9999).".".$f->extension();
                    $imagePath=public_path().'/addproduct';
                    if($f->move($imagePath,$imagename)){
                        array_push($files,$imagename);
                    }
                }
            }
            $input['photo']=implode(',',$files);
            /* /for files */

        $data=AddProduct::create($input);
        return $this->sendResponse($data,"AddProduct created successfully");
    }

    public function show(AddProduct $addproduct){
        return $this->sendResponse($addproduct,"AddProduct created successfully");
    }

    public function update(Request $request,$id){

    $input=$request->all();
            /* for files */
            $files=[];
            if($request->hasFile('files')){
                foreach($request->file('files') as $f){
                    $imagename=time().rand(1111,9999).".".$f->extension();
                    $imagePath=public_path().'/addproduct';
                    if($f->move($imagePath,$imagename)){
                        array_push($files,$imagename);
                    }
                }
                $input['photo']=implode(',',$files);
            }
            unset($input['files']);

        $addproduct=AddProduct::where('id',$id)->update($input);
        return $this->sendResponse($addproduct,"AddProduct updated successfully");
    }

    public function destroy(AddProduct $addproduct)
    {
        $addproduct=$addproduct->delete();
        return $this->sendResponse($addproduct,"AddProduct deleted successfully");
    }
}
