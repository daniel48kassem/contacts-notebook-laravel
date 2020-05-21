<?php

namespace App\Http\Controllers;

use App\Number;
use Illuminate\Http\Request;
use App\Contact;

class ContactsController extends Controller
{
    public function getContacts()
    {
        return Contact::where('user_id',auth('api')->user()->id)->orderBy('created_at', 'DESC')->get();
    }
    public function getNumbers($contact_id)
    {
        return Number::where('contact_id',$contact_id)->get();
    }
	public function editNumber(Request $request, Number $number)
	{
		$myNumber=Number::findOrFail($number->id);
		
		$data = $this->validate($request, [
			'number' => 'required',
			'contact_id' => 'required',
		]);
		$myNumber->update($request->all());
        return response($myNumber, 200);
    }
		
    public function postContact(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
        ]);
        $contact = new Contact();
        $contact->first_name = $request['first_name'];
        $contact->last_name = $request['last_name'];
        $contact->address = $request['address'];
        $contact->user_id = auth('api')->user()->id;
        $contact->save();
        return response($contact, 201);
    }
	 public function postNumber(Request $request)
    {
        $data = $request->validate([
            'contact_id' => 'required',
            'number' => 'required',
        ]);
        $number = new Number();
        $number->number = $request['number'];
        $number->contact_id = $request['contact_id'];
        $number->save();
        return response($number, 201);
    }
	
	    public function contactSearch(Request $request)
    {
		$first_name=$request->first_name;
		$last_name=$request->last_name;

        $data = Contact::where('user_id',auth()->user()->id)->where('first_name','like',$first_name.'%')->where('last_name','like',$last_name.'%')->orderBy('id')->paginate(10);
        return response()->json($data);

    }
    public function getUser(){
        return Auth()->user()->get();
    }
    public function editContact(Request $request, Contact $contact){
            $myContact=Contact::findOrFail($contact->id);

            $data = $this->validate($request, [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'address' => 'required|string',
            ]);
            $myContact->update($request->all());
            return response($myContact, 200);
    }
    public function deleteContact(Request $request, Contact $contact){
        $myContact=Contact::findOrFail($contact->id);
        $myContact->delete();
        return response("Successfully Deleted", 200);
    }
}
