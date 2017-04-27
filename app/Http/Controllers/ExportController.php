<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use JeroenDesloovere\VCard\VCard;

class ExportController extends Controller {

    /**
     * Export a contact in vCard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function vCard(Contact $contact) {
        $vCard = new VCard();
        $vCard->addName($contact->name);
        $vCard->addPhoneNumber($contact->phone,'Personal');
        $vCard->addEmail($contact->email?$contact->email:'');
        $vCard->addAddress($contact->address?$contact->address:'');
        $vCard->addCompany($contact->company?$contact->company->name:'');
        $vCard->addBirthday($contact->birthday?$contact->birthday:'');
        return $vCard->download();
    }

}
