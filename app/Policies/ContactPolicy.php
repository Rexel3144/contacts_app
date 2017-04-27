<?php

namespace App\Policies;

use App\User;
Use App\Contact;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPolicy {

    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    public function update(User $user, Contact $contact) {
            return $user->id == $contact->user_id;
    }
    
    public function delete(User $user, Contact $contact) {
            return $user->id == $contact->user_id;
    }

}
