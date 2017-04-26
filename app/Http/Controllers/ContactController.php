<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Carbon\Carbon;
class ContactController extends Controller
{
    
    /**
     * Using middleware auth,
     * which provides access
     * to methods for only
     * a autorized user
     */
    public function __construct() {
        Auth::loginUsingId(47,true);
        $this->middleware('auth');
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Auth::user()->contacts;
        for($i = 0; $i<count($contacts);$i++){
            //need remake by using carbon
            $contacts[$i]->age = date('Y') - date('Y', strtotime($contacts[$i]->birthday));
        }
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $contact = $request->all();
        if (isset($contact['company'])){
            $contact['company_id']= Company::findIdByNameOrCreate($contact['company']);
        }
        
        Auth::user()->contacts()->create($contact);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editPart(Request $request,Contact $contact)
    {   
        $id = $contact->id;
        $source = $request->source;
        $value = $request->value;
        return view("contacts.parts.{$source}", compact('value','source','id'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $source = $request->source;
        $contact->$source = $request->newValue;
        $contact->save();
        return response('Success',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
       $contact->delete();
    }
}
