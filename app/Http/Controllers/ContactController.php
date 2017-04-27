<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Company;
//use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Auth;

//use Carbon\Carbon;
class ContactController extends Controller {

    /**
     * Using middleware auth,
     * which provides access
     * to methods for only
     * a autorized user
     */
    public function __construct() {
        Auth::loginUsingId(47, true);
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $contacts = Auth::user()->contacts;
        for ($i = 0; $i < count($contacts); $i++) {
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
    public function create() {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request) {
        $contact = $request->all();
        if (isset($contact['company_name'])) {
            $contact['company_id'] = Company::findIdByNameOrCreate($contact['company_name']);
        }

        Auth::user()->contacts()->create($contact);

        return redirect("/");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact) {
        //
    }

    /**
     * Show the form for editing part of the specified resource.
     *
     * @param  \App\Contact  $contact
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editPart(Request $request, Contact $contact) {
        if (!$this->authorize('update', $contact)) {
            return response('Sorry you cant do that.', 403);
        }
        $id = $contact->id;
        $source = $request->source;
        $value = $request->value;
        return view("contacts.parts.{$source}", compact('value', 'source', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request, Contact $contact) {
        $source = $request->source;
        $newValue = $request->newValue;
        if (!$this->authorize('update', $contact)) {
            return response('Sorry you cant do that.', 403);
        }
        //need remake this magic
        if ($source == 'company_name') {
            if (!is_null($newValue)) {
                $newValue = Company::findIdByNameOrCreate($newValue);
            }
            $source = 'company_id';
        }

        $contact->$source = $newValue;
        $contact->save();
        return response('Success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact) {
        if(!$this->authorize('delete',$contact)){
            return response('Sorry you cant do that.', 403);
        }
        $contact->delete();
        return response('Success', 200);
    }

}
