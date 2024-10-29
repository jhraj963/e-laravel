<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;

class ContactController extends BaseController
{
    public function index(){
        $data=Contact::get();
        return $this->sendResponse($data,"Contact data");
    }

    public function store(Request $request){
        $data=Contact::create($request->all());
        return $this->sendResponse($data,"Contact created successfully");
    }
    public function show(Contact $contact){
        return $this->sendResponse($contact,"Contact created successfully");
    }

    public function update(Request $request,$id){

        $data=Contact::where('id',$id)->update($request->all());
        return $this->sendResponse($id,"Contact updated successfully");
    }

    public function destroy(Contact $contact)
    {
        $contact=$contact->delete();
        return $this->sendResponse($contact,"Contact deleted successfully");
    }
}
