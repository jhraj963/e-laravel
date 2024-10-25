<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends BaseController
{
    public function index(){
        $data=Inventory::with('abc')->get();
        return $this->sendResponse($data,"Inventory data");
    }

    public function store(Request $request){


        $data=Inventory::create($request->all());
        return $this->sendResponse($data,"Inventory created successfully");
    }
    public function show(Inventory $inventory){
        return $this->sendResponse($inventory,"Inventory created successfully");
    }

    public function update(Request $request,$id){



        $data=Inventory::where('id',$id)->update($request->all());
        return $this->sendResponse($id,"Inventory updated successfully");
    }

    public function destroy(Inventory $inventory)
    {
        $inventory=$inventory->delete();
        return $this->sendResponse($inventory,"Inventory deleted successfully");
    }
}
